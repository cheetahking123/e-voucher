<?php include_once('header.php');?> 
<h2>Home</h2>
<?php 
if(!isUser())
{
    echo'
    <p class="left">You can sign up for a <a class="embeddedlink" href="/registration.php?acType=customer">customer account</a> or
     a <a class="embeddedlink" href="/registration.php?acType=merchant">merchant account</a> depends on your situation.</br></br>
    If you want to apply the $5000 HKD e-voucher and use it, you can sign up as a <a class="embeddedlink" href="/registration.php?acType=customer">customer</a>.</br></br>
    If you would like to facilitate the e-voucher system for your shop, you can sign up as a <a class="embeddedlink" href="/registration.php?acType=merchant">merchant</a>.</p>
    ';
}

echo'<p>Hello <i class ="yellowText">'.$user['username'].'</i>. Welcome Back!</p>';
?>
<?php include_once('footer.php');?>