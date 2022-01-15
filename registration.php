<?php include_once('header.php');?>
<h2>Sign Up</h2>

<?php   
    $acType=$_GET['acType'];
    if($acType=='customer')
    {
        echo'
        <label for="acType">Account Type: '.$acType.'</label>
        <form action="/functions.php?op=registerAccount" method="post">
        <input type="hidden" id="acType" name="acType" value="'.$acType.'">
    
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" require></br>
    
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" min="5" max="20"></br>
    
        <label for="email">Email address: </label>
        <input type="text" id="email" name="email" require></br>
        
        <input class="acRegBtn" type="submit" value="confirm">
    
        </form>
        ';
    }
    else if($acType=='merchant')
    {
        echo'
        <label for="acType">Account Type: '.$acType.'</label>
        <form action="/merchantReg.php" method="post">
        <input type="hidden" id="acType" name="acType" value="'.$acType.'">
    
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" require></br>
    
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" min="5" max="20"></br>
    
        <label for="email">Email address: </label>
        <input type="text" id="email" name="email" require></br>
        
        <input class="acRegBtn" type="submit" value="continue">
    
        </form>
        ';
    }
    else
    {
        header("Location: /chooseAccountType.php?op=reg");
    }
?>
<?php include_once('footer.php');?>