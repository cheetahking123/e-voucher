<?php include_once('header.php');?>
<h2>Change Password</h2>

<form action="functions.php?op=changePw" method="post">
        
    <label for="oldPw">Old password: </label>
    <input type="password" id="oldPw" name="oldPw" require></br>

    <label for="newPw1">New password: </label>
    <input type="password" id="newPw1" name="newPw1" min="5" max="20"></br>
    <label for="newPw2">Confirm again: </label>
    <input type="password" id="newPw2" name="newPw2" min="5" max="20"></br>
        
    <input class="changePw" type="submit" value="Change">

</form>
<p class="invalidInput">
    <?php
    // var_dump($user['password']);
        if($_GET['input']=='invalid')
        {
            echo 'Invalid Input.</br>
            Please enter the correct old password and</br>
            Make sure the blank of "confirm again" is filled with the same value as your new password.';
        }
    ?>
</p>

<?php include_once('footer.php');?>