<?php
include_once('dbConnect.php');
include_once('functions.php');

//get user's Info
session_start();
$username = $_SESSION['username'];

$userQ = mysqli_query($dbConnection, "SELECT * FROM `usersAccount` WHERE `username` = '".$username."' ");
    $user = mysqli_fetch_assoc($userQ);
    // echo '<pre>';
    // var_dump($user);
    // echo '</pre></br>';
    // echo $user['userId'];
    if($user['accountType']=='customer')
    {
        // $userInfoQ = mysqli_query($dbConnection, "SELECT * FROM `customersInfo` WHERE `customerId` = '".$user['userId']."' ");
        //     $userInfo = mysqli_fetch_assoc($userInfoQ);

         $walletQ = mysqli_query($dbConnection, "SELECT * FROM `wallets` WHERE `customerId` = '".$user['userId']."' ");
             $wallet= mysqli_fetch_assoc($walletQ);
    }

    if($user['accountType']=='merchant')
    {
        // $userInfoQ = mysqli_query($dbConnection, "SELECT * FROM `merchantsInfo` WHERE `merchantId` = '".$user['userId']."' ");
        //     $userInfo = mysqli_fetch_assoc($userInfoQ);

        $cashierQ = mysqli_query($dbConnection, "SELECT * FROM `cashiers` WHERE `merchantId` = '".$user['userId']."' ");
            $cashier= mysqli_fetch_assoc($cashierQ);
    }


    // echo '<pre>';
    // var_dump($userInfo);
    // echo '</pre>';

    // echo '<pre>';
    // var_dump($wallet);
    // echo '</pre>';

    // echo '<pre>';
    // var_dump($cashier);
    // echo '</pre>';
    