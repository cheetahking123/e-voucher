<?php include_once('header.php');?>
<h2>Profile</h2>
<?php
if(!isUser())
{
    header("Location: /");
}
// retricted page
echo'
    <div class="left">
        <label>Username: </label><i class ="yellowText">'.$user['username'].'</i></br>
        <label>Email: </label><i class ="yellowText">'.$user['email'].'</i></br>
        <label>Account Type: </label><i class ="yellowText">'.$user['accountType'].'</i></br>
    </div>
';
?>
<form class="centeredBtn" action="changePw.php" method="post">
    <input type="submit" id="choice" name="choice" value="Change Password">
</form>

<?php include_once('footer.php');?>