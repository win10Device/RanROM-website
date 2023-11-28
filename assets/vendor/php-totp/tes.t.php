<?php

//use lfkeitel\phptotp\{Base32,Totp};
require_once 'totp.php';
# Generate a new secret key
# Note: GenerateSecret returns a string of random bytes. It must be base32 encoded before displaying to the user. You should store the unencoded string for later use.
$secret = Base32::decode('4fgskvdofzxieog4wpjgx5ux5q'); //Totp::GenerateSecret(16);

# Display new key to user so they can enter it in Google Authenticator or Authy
echo Base32::encode($secret);

# Generate the current TOTP key
# Note: GenerateToken takes a base32 decoded string of bytes.
$key = (new Totp())->GenerateToken($secret, time());
echo "<br>{$key}";
