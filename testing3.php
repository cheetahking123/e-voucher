<?php
include_once('functions.php');
include_once('dbConnect.php');
// $userId= userIdGen('merchant');
// echo $userId;
// $hashedPassword = password_hash('78765',PASSWORD_BCRYPT);
// echo $hashedPassword;

// echo(rand(10000,100000)); // generate a randow 5-digit number

// $trade=getTradingInfo('M21001','C21002','78765');
// echo '<pre>';
// echo $trade['orderSecret'];
// echo '</pre>';

$cashier = getCashierInfo('M21002');
echo '<pre>';
var_dump($cashier);
echo '</pre>';