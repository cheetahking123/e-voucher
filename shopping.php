<?php include_once('header.php');
echo'
<h2>
    Balance: $'.$wallet['balance'].'</br>
    Your customer ID: '.$user['userId'].'


</h2>';
?>
<form action="functions.php?op=shopping" method="post">

    <label for="merchantId">Merchant ID: </label>
    <input type="text" id="merchantId" name="merchantId" require></br>

    <label for="orderAmount">Amount $: </label>
    <input type="text" id="orderAmount" name="orderAmount" require></br>

    <label for="orderSecret">Secret: </label>
    <input type="text" id="orderSecret" name="orderSecret" require></br>
            
    <input  type="submit" value="confirm">

</form>
<p class="invalidInput">
        <?php
            if($_GET['input']=='invalid')
            {
                echo 'Invalid input.</br>
                Please make sure you enter the correct merchant ID and secret.
                ';
            }
            if($_GET['balance']=='notEnough')
            {
                echo '
                Sorry, You do not have enough balance!
                ';
            }
        ?>
</p>
<?php include_once('footer.php');?>