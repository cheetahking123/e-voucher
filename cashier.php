<?php 
    include_once('header.php');
    if(!isUser())
    {
        header("Location: /");
    }
    // retricted page
echo'
<h2>
    Cashier</br>
    Your merchant ID: '.$user['userId'].'</br>
    Your Balance: $'.$cashier['balance'].'

</h2>';
?>
<form action="functions.php?op=startTrade" method="post">

    <label for="customerId">Customer ID: </label>
    <input type="text" id="customerId" name="customerId" require></br>

    <input  type="submit" value="confirm">

</form>
<p class="invalidInput">
        <?php
            if($_GET['op']=='tryAgain')
            {
                echo 'Please try again!';

            }
        ?>
    </p>
<?php include_once('footer.php');?>