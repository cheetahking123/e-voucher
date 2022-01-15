<?php 
    include_once('header.php')


;?>

<h2>Fill in Your Shop Information</h2>
<?php

    // echo $_POST['acType'].'</br>';
    // echo $_POST['username'].'</br>';
    // echo $_POST['password'].'</br>';
    // echo $_POST['email'].'</br>';
    $acType = $_POST['acType'];
    $userId = userIdGen($acType);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    if($acType ==NULL)
    {
        header("Location: /");
    }

        echo'
        <form action="/functions.php?op=registerAccount" method="post">
        <input type="hidden" id="acType" name="acType" value="'.$acType.'">
        <input type="hidden" id="username" name="username" value="'.$username.'">
        <input type="hidden" id="password" name="password" value="'.$password.'">
        <input type="hidden" id="email" name="email" value="'.$email.'">

        <label for="merchantName">Merchant Name:</label>
        <input type="text" id="merchantName" name="merchantName" require></br>

        <label for="merchantType">Merchant Type:</label>
        <input type="text" id="merchantType" name="merchantType" require></br>
        
        <label for="shopAddress">Shop Address:</label>
        <input type="text" id="shopAddress" name="shopAddress" require></br>

        <label for="teleNum">Telephone No.:</label>
        <input type="text" id="teleNum" name="teleNum" require></br>

        <input class="acRegBtn" type="submit" value="confirm">
        </form>
        ';

?>
<?php include_once('footer.php');?>