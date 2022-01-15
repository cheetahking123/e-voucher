<?php include_once('header.php');?>

<h2>Apply for the E-voucher</h2>
<p class="left">Please provide the following information for your application.</p>
    <form action="/applyEvoucher.php?op=checkImg" method="post" enctype="multipart/form-data">

    <label for="name">Full Name: </label>
    <input type="text" id="name" name="name" require></br>

    <label for="hkId">ID Number: </label>
    <input type="text" id="hkId" name="hkId" require></br></br>

    <div class="left">
    Please upload an image of your ID card.</br>
    <input type="file" name="fileToUpload" id="fileToUpload"></br>
    </div>
    <input  type="submit" value="Submit">
    </form>

    <p class="invalidInput">
        <?php
            if($_GET['op']=='checkImg')
            {
                applyEvoucher();
            }
        ?>
    </p>
<?php include_once('footer.php');?>