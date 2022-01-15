<?php
include('Crypt/RSA.php');
session_start();
$rsa = new Crypt_RSA();
 
//var_dump($rsa);
// $rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
// $rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);

// define('CRYPT_RSA_EXPONENT', 65537);
// define('CRYPT_RSA_SMALLEST_PRIME', 64); // makes it so multi-prime RSA is used
// extract($rsa->createKey(1024)); // == $rsa->createKey(1024) where 1024 is the key size

// echo'</br></br>';
// echo $privatekey;
// echo'</br></br>';
// echo $publickey;

// echo '<pre>';
// var_dump($rsa);
// echo '</pre>';

//$rsa->setPassword('password');
// $rsa->loadKey($privatekey); // private key

// $plaintext = 'abcde';

// $rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PSS);
// $signature = $rsa->sign($plaintext);
// $rsa->loadKey($publickey); // public key

// echo'</br></br>';
// echo $rsa->verify($plaintext, $signature) ? 'verified' : 'unverified';
?>