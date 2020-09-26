<?php

$key_sk = random_bytes(32);
$key_siv = random_bytes(32);
$key_sk = base64_encode($key_sk);
$key_siv = base64_encode($key_siv);
define("ENCRYPT_METHOD", "AES-256-CBC");
define("SECRET_KEY", $key_sk);
define("SECRET_IV", $key_siv);

function encriptar($action, $string, $key_sk, $key_siv){
  $output = false;
  $key    = hash("sha256", SECRET_KEY);
  $iv     = substr(hash("sha256", SECRET_IV), 0, 16);

  if ($action == "encrypt"){
    $output = openssl_encrypt($string, ENCRYPT_METHOD, $key, 0, $iv);
    $output = base64_encode($output);

    include 'app/config/database.php';
    $conn = db();
    $sql = "INSERT INTO users (title, email, password, keypass, key_iv, key_tag, plan_id, created, updated, reference, active) VALUES('$name', '$email', '$output', '$output', '$key_sk', '$key_siv', '$plan', '$created', '$created', '$reference' ,'0')" ;
    $query = $conn->prepare($sql);
    $query->execute();
  }
  else if($action == "decrypt"){
        $output = base64_decode($string);
        $output = openssl_decrypt($output, ENCRYPT_METHOD, $key, 0, $iv);
    }
  return $output;
}


$action = 'encrypt';
$string = 'Avantemova2017';
$encriptado = encriptar($action, $string, $key_sk, $key_siv);


?>
