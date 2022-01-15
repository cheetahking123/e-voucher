<?php include_once('header.php');?>
    <h2>Log In</h2>
    <?php
    if($_GET['acType']=='customer' ||$_GET['acType']=='merchant')
    {
        $acType=$_GET['acType'];
        echo'
        <label for="acType">Account Type: '.$acType.'</label>
        <form action="functions.php?op=checkLogin" method="post">

            <input type="hidden" id="acType" name="acType" value="'.$acType.'">

            <label for="username">Username: </label>
            <input type="text" id="username" name="username" require></br>

            <label for="password">Password: </label>
            <input type="password" id="password" name="password" min="5" max="20"></br>

            
            <input class="login" type="submit" value="log In">

        </form>
    ';
    }
    else
    {
        header("Location: /chooseAccountType.php?op=login");
    }
    
    ?>
    <p class="invalidInput">
        <?php
            if($_GET['input']=='invalid')
            {
                echo 'Invalid user ID or password';

            }
        ?>
    </p>
<?php include_once('footer.php');?>