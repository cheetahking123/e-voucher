<?php include_once('header.php');?>
<?php
if($_GET['op']=='login')
{
    echo'
    <h2>Log In</h2>
    <form class="centeredBtn" action="Login.php?acType=customer" method="post">
        <input type="submit" id="choice" name="choice" value="customer">
    </form>

    <form class="centeredBtn" action="Login.php?acType=merchant" method="post">
        <input type="submit" id="choice" name="choice" value="merchant">
    </form>
    ';
}

if($_GET['op']=='reg')
{
    echo'
    <h2>Sign Up</h2>
    <form class="centeredBtn" action="registration.php?acType=customer" method="post">
        <input type="submit" id="choice" name="choice" value="customer">
    </form>

    <form class="centeredBtn" action="registration.php?acType=merchant" method="post">
        <input type="submit" id="choice" name="choice" value="merchant">
    </form>
    ';
}






?>
<?php include_once('footer.php');?>