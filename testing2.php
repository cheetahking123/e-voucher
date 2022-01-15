<html>
    <body> <!-- the body tag is required or the CAPTCHA may not show on some browsers -->
      <!-- your HTML content -->

      <form method="post" action="verify.php">
        <?php
          require_once('recaptchalib.php');
          $publickey = "6LfwzrYaAAAAALtDBM4L5VEnB0kcarqXPTAiCi3D"; // public key that you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
        <input type="submit" />
      </form>

      <!-- more of your HTML content -->
    </body>
  </html>