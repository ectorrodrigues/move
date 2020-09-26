<?php


require_once "app/vendors/sodium_compat/autoload.php";


$password = 'testpassword';


$storeInDatabase = sodium_crypto_pwhash_str(
    $password,
    SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
    SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
);

/* Once that's stored, you can just test against the hash like so: */
if (sodium_crypto_pwhash_str_verify($storeInDatabase, $password)) {
  include 'app/config/database.php';
  $conn   = db();
  $query  = $conn->prepare("INSERT INTO test (title) VALUES ('$storeInDatabase') ");
  $query->execute();
} else {
    echo 'erro';
}



?>
