<?php 
    session_start();
//error_reporting(0);
    include_once('dbConnect.php');
    include_once('functions.php');
    include_once('getUserInfo.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>E-voucher Scheme</title>
</head>
<body>
<h1>$~ &nbsp;E-voucher Scheme&nbsp; ~$</h1>
<nav>
<ul class= "clientMenu">
    <li><a href="/">Home</a></li>
    <li><a href="/about.php">About</a></li>
</ul>

<ul class= "userMenu">
    <?php 
        if($_SESSION['acType']=='customer')
        {
            echo'
            <li><a href="/wallet.php">Wallet</a></li>
            <li><a href="/profile.php">Profile</a></li>
            <li><a href="/functions.php?op=logout">Logout</a></li>
            ';
        }
        else if($_SESSION['acType']=='merchant')
        {
            echo'
            <li><a href="/cashier.php">Cashier</a></li>
            <li><a href="/profile.php">Profile</a></li>
            <li><a href="/functions.php?op=logout">Logout</a></li>
            ';
        }
        else
        {
            echo'
            <li><a  href="/chooseAccountType.php?op=login">Login</a></li>
            <li><a href="/chooseAccountType.php?op=reg">Sign Up</a></li>
            ';
        }

    ?>
    
</ul>
</nav>