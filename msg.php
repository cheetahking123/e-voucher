<?php 
    include_once('header.php');

?>

<?php

if($_GET['msg']=='regSuccess')
{
    regSuccess();
}

if($_GET['msg']=='tradeStarted')
{
    echo '
    <h2>
    Your merchant ID:'.$user['userId'].'</br>
    </h2>
    ';
    tradeStarted($_GET['sec']);
}
if($_GET['msg']=='evoucherApplyCompleted')
{
    evoucherApplyCompleted();
}
if($_GET['msg']=='pwChanged')
{
    pwChanged();
}
if($_GET['msg']=='tradeCompleted')
{
    tradeCompleted();
}
function tradeCompleted()
{
    echo'<p class="left">Your transaction is completed successfully.</p>';
}
function pwChanged()
{
    echo'<p class="left">Your password is changed successfully.</p>';
}
function tradeStarted($secret)
{
    echo'<p class="left">Your trading secret is <u class = "embeddedlink" >'.$secret.'</u>. Please wait the customer to confirm the trading.</p>';
}

function regSuccess()
{
    echo'<p class="left">Your registration is successful.</p>';
}
function evoucherApplyCompleted()
{
    echo'<p class="left">Your application is subitted successfully. The E-voucher will be delivered to your wallet once your provided information is verified.</p>';
}
?>
<form class="centeredBtn" action="/" method="post">
    <input class="okay" type="submit" value="ok">
</form>
<?php include_once('footer.php');?>