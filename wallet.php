<?php include_once('header.php');?>

<h2>Wallet</h2>
<?php
if(!isUser())
{
    header("Location: /");
}
// retricted page
if($wallet['balance']==NULL)
{
    echo'
        <form class="centeredBtn" action="/applyEvoucher.php" method="post">
            <input type="submit" value="Apply E-voucher">
        </form>
    ';
}
else
{   echo'
    <h2>Your Balance: $'.$wallet['balance'].'</h2>';
    if($wallet['balance']>0)
    {
    echo'
        <form class="centeredBtn" action="/shopping.php" method="post">
            <input type="submit" value="Use E-voucher">
        </form>
    ';
    }
}



?>
<?php include_once('footer.php');?>