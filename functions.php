<?php
//error_reporting(0);
session_start();
ob_start();
include_once('dbConnect.php');
include_once('getUserInfo.php');
include_once('rsaKeyGen.php');


if($_GET['op']=='checkLogin')
{
    checkLogin($_POST['username'],$_POST['password']);

}
if($_GET['op']=='logout')
{
    logout();

}
if($_GET['op']=='registerAccount')
{
    registerAccount();

}
if($_GET['op']=='startTrade')
{
    startTrade($_POST['customerId']);
}
if($_GET['op']=='applyEvoucher')
{
    applyEvoucher();
}
if($_GET['op']=='changePw')
{
    changePw();
}
if($_GET['op']=='shopping')
{
    shopping($_POST['merchantId'],$_POST['orderAmount'],$_POST['orderSecret']);
    // echo $_POST['merchantId'];
    // echo $_POST['orderAmount'];
    // echo $_POST['orderSecret'];
}

function isUser()
{
    return isset($_SESSION['username']);
}
function logout()
{
    session_start();
    session_destroy();
    header("Location: /");
    ob_end_flush();
}
function checkLogin($username, $password)
{
    global $dbConnection; 
    global $dbName;
    $acType = $_POST['acType'];
    // session_start();
    // $_SESSION['username'] = $username;
    // $_SESSION['acType'] = $_POST['acType'];
    // header("Location: /index.php");
    $userQ = mysqli_query($dbConnection, "SELECT * FROM `usersAccount` WHERE `username` = '".$username."' ");
    $user = mysqli_fetch_assoc($userQ);
    if($username==$user['username'] && password_verify($password,$user['password']))
    {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['acType'] = $_POST['acType'];
        header("Location: /index.php");
        
    }
    else
    {
        header("Location: /login.php?acType=$acType&&input=invalid");
    }
}
function changePw()
{
    global $dbConnection; 
    global $dbName;
    global $user;
    $oldPw=$_POST['oldPw'];
    $newPw1=$_POST['newPw1'];
    $newPw2=$_POST['newPw2'];
    
    if(password_verify($oldPw,$user['password']) && $newPw1==$newPw2)
    {
        //echo 'verified'.'</br>';
        $hashedPassword = password_hash($newPw1,PASSWORD_BCRYPT);
        $sql = "UPDATE `$dbName`.`usersAccount` 
                SET 
                    `password` = '{$hashedPassword}'
                    WHERE `userId` = '{$user['userId']}'
                    ";
        //echo $sql;
        if(mysqli_query($dbConnection, $sql))
        {
            //echo 'successful';
            header("Location: /msg.php?msg=pwChanged");
        }
    }
    else
    {
        header("Location: /changePw.php?input=invalid");
    }
    
}
function registerAccount()
{
    global $dbConnection; 
    global $dbName;

    $acType = $_POST['acType'];
    $userId = userIdGen($acType);
    //echo $userId;
    $username = $_POST['username'];
    $hashedPassword = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $email = $_POST['email'];
    
    //echo $hashedPassword;
    $sql = "INSERT INTO `$dbName`.`usersAccount` (
        `userId`, 
        `username`,
        `password`,
        `email`,
        `accountType` 
         ) VALUES (
         '{$userId}',
         '{$username}', 
         '{$hashedPassword}',
         '{$email}',
         '{$acType}')";
        //echo $sql;
    if(mysqli_query($dbConnection, $sql))
    {
        //echo 'store successfully';
        if($acType=='customer')
        {
            $sql = "INSERT INTO `$dbName`.`customersInfo` (
                `customerId`
                 ) VALUES (
                 '{$userId}')";
            //echo $sql;
            mysqli_query($dbConnection, $sql);

            $sql = "INSERT INTO `$dbName`.`wallets` (
                `customerId`
                 ) VALUES (
                 '{$userId}')";
            //echo $sql;
            mysqli_query($dbConnection, $sql);
        }
        if($acType=='merchant')
        {
            $merchantId = $userId;
            $merchantName = $_POST['merchantName'];
            $merchantType = $_POST['merchantType'];
            $shopAddress = $_POST['shopAddress'];
            $telephoneNum = $_POST['teleNum'];
            $sql = "INSERT INTO `$dbName`.`merchantsInfo` (
                `merchantId`, 
                `merchantName`,
                `merchantType`,
                `shopAddress`,
                `telephoneNum` 
                 ) VALUES (
                 '{$merchantId}',
                 '{$merchantName}', 
                 '{$merchantType}',
                 '{$shopAddress}',
                 '{$telephoneNum}')";
            mysqli_query($dbConnection, $sql);

            $sql = "INSERT INTO `$dbName`.`cashiers` (
                `merchantId`
                 ) VALUES (
                 '{$userId}')";
            //echo $sql;
            mysqli_query($dbConnection, $sql);
        }

         header("Location: /msg.php?msg=regSuccess");
    }
}
function userIdGen($userType)
{
    global $dbConnection;
    $query = "SELECT COUNT(*) FROM `usersAccount`";
    $result = mysqli_query($dbConnection, $query);
    //echo $result;
    $NumOfUser = mysqli_fetch_assoc($result)['COUNT(*)'];
    //echo $NumOfUser;    
    $userId = date('y').sprintf("%03d",$NumOfUser+1);
    if($userType=='customer')
    {
        $userId='C'.$userId;
    }
    if($userType=='merchant')
    {
        $userId='M'.$userId;
    }
    return $userId;
}

function startTrade($cusId)
{
    global $dbConnection; 
    global $dbName;
    global $user;
    //echo $cusId;
    global $rsa;
    //var_dump($rsa);
    $secret = (rand(10000,100000));
    $rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
    $rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);

    define('CRYPT_RSA_EXPONENT', 65537);
    define('CRYPT_RSA_SMALLEST_PRIME', 64); // makes it so multi-prime RSA is used
    extract($rsa->createKey(1024)); // == $rsa->createKey(1024) where 1024 is the key size


    $rsa->loadKey($privatekey); // private key

    $plaintext = $secret;
    $hash = password_hash($plaintext,PASSWORD_BCRYPT);

    $rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PSS);
    $signature = $rsa->sign($plaintext);
    //var_dump($signature);
    $rsa->loadKey($publickey); // public key
    $bool=$rsa->verify($plaintext, $signature);//? 'verified' : 'unverified';
    // echo $bool;
    // echo $user['userId'];
    if($bool)
    {
        //echo 'Can go to the next step.';
        $sql = "INSERT INTO `$dbName`.`orders` (
            `orderTime`, 
            `customerId`,
            `merchantId`,
            `orderSecret`
             ) VALUES (
             '".date('Y-m-d H:i:s')."',
             '{$_POST['customerId']}',
             '{$user['userId']}',
             '{$hash}')";
        //echo $sql;
        if(mysqli_query($dbConnection, $sql))
        {
            header("Location: /msg.php?msg=tradeStarted&&sec=$secret");
        }
        else
        {
            echo'OMG';
            //header("Location: /cashier.php?op=tryAgain");
        }
    }
    else
    {
        header("Location: /cashier.php?op=tryAgain");
    }
   
    
    //header("Location: /msg.php?msg=tradeStarted&&sec=$secret");
}
function shopping($merchantId,$orderAmount,$orderSecret)
{
    global $dbConnection; 
    global $dbName;
    global $user;
    global $wallet;
    // echo $_POST['merchantId'];
    // echo $_POST['orderAmount'];
    // echo $_POST['orderSecret'];

    $trade=getTradingInfo($merchantId,$user['userId'],$orderSecret);
    $cashier = getCashierInfo($merchantId);

    $Cbalance = $wallet['balance']-$orderAmount;
    $Mbalance = $cashier['balance']+$orderAmount;
    // echo $balance;
    if($Cbalance <0)
    {
        header("Location: /shopping.php?balance=notEnough");
        exit;
    }
    else
    {
        if($trade)
        {
            // echo'have trade';
            $sql = "UPDATE `$dbName`.`orders` 
                SET 
                    `orderAmount`= '{$orderAmount}',
                    `orderTime`= '".date('Y-m-d H:i:s')."',
                    `orderSecret` = '".NULL."'
                    WHERE 
                    `customerId` = '{$user['userId']}' AND
                    `merchantId` = '{$merchantId}' AND
                    `orderSecret` = '{$trade['orderSecret']}'
                    ";
            // `orderSecret` = '".NULL."' // invalidate the secret.
            // echo $sql;
            if(mysqli_query($dbConnection, $sql))
            {
                //Deduct balance of customer's wallet
                $sql = "UPDATE `$dbName`.`wallets` 
                SET 
                    `balance`= '{$Cbalance}'
                    WHERE 
                    `customerId` = '{$user['userId']}'
                    ";
                mysqli_query($dbConnection, $sql);
                // echo $sql;
                //ADD balance of merchant's wallet
                $sql = "UPDATE `$dbName`.`cashiers` 
                SET 
                    `balance`= '{$Mbalance}'
                    WHERE 
                    `merchantId` = '{$merchantId}'
                    ";
                if(mysqli_query($dbConnection, $sql)) 
                {
                    header("Location: /msg.php?msg=tradeCompleted");
                }
                else
                {
                    echo 'error</br>';
                    echo $sql;
                }
            }
        }
        else
        {
            header("Location: /shopping.php?input=invalid");
        }
    }
    
    
    // header("Location: /msg.php?msg=tradeCompleted");
}
function applyEvoucher()
{
    global $dbConnection; 
    global $dbName;
    global $user;

    $target_dir = "idCardImg/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) 
    {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) 
            {
                $msg = "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } 
            else 
            {
                $msg = " File is not an image.";
                $uploadOk = 0;
            }
    }

// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"  && $imageFileType != "gif" ) 
    {
        $msg = $msg." Sorry, only JPG, JPEG, PNG & GIF files are allowed.".'</br>';
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0)  
    {
        $msg = $msg." Your file was not uploaded.";
        echo $msg;
    } 
    else 
    { // if everything is ok, try to upload file
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
             //echo 'upload successful';
            $sql = "UPDATE `$dbName`.`customersInfo` 
            SET 
                `customerId` = '{$user['userId']}',
                `hkId` = '{$_POST['hkId']}',
                `Name`= '{$_POST['name']}',
                `idCardImg`= '{$target_file}',
                `applyTime`= '".date('Y-m-d H:i:s')."'
                WHERE `customerId` = '{$user['userId']}'
                ";
            //echo $sql;
            if(mysqli_query($dbConnection, $sql))
            {
                $sql = "UPDATE `$dbName`.`wallets` 
                SET 
                    `balance` = '0'
                    WHERE `customerId` = '{$user['userId']}'
                    ";
                mysqli_query($dbConnection, $sql);
                // echo $sql;
                header("Location: /msg.php?msg=evoucherApplyCompleted");
            }
        } 
        else 
        {
            $msg = $msg." Sorry, there was an error uploading your file.";
            echo $msg;
        }
    }
}

function getTradingInfo($merchantId,$customerId,$secret)
{
    global $dbConnection; 
    global $dbName;
    // echo $merchantId;
    $tradesQ = mysqli_query($dbConnection, "SELECT * FROM `orders` WHERE `merchantId` = '".$merchantId."' AND `customerId` = '".$customerId."'");

    $n=1;
    while($trade  = mysqli_fetch_assoc($tradesQ))
    {
        $trades[$n] = $trade;
        $n++;
    }

    for($i=1;$i<=count($trades);$i++)
    {
        //var_dump( $trades[$i]['orderSecret']);
        if(password_verify($secret,$trades[$i]['orderSecret']))
        {
            $trade = $trades[$i];
        }
    }
    // echo '<pre>';
    // var_dump($trade);
    // echo '</pre></br>';
    return $trade;
}

function getCashierInfo($merchantId)
{
    global $dbConnection; 
    global $dbName;
    $cashierQ = mysqli_query($dbConnection, "SELECT * FROM `cashiers` WHERE `merchantId` = '".$merchantId."' ");
        $cashier= mysqli_fetch_assoc($cashierQ);
    return $cashier;
}