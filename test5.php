<?php

include 'app/config/database.php';
$conn = db();

$sql = "SELECT key_tag FROM users ORDER BY id DESC LIMIT 1" ;
$query = $conn->prepare($sql);
$query->execute();
$key_sk = $query->fetchColumn();

$sql = "SELECT key_iv FROM users ORDER BY id DESC LIMIT 1" ;
$query = $conn->prepare($sql);
$query->execute();
$key_siv = $query->fetchColumn();


define("ENCRYPT_METHOD", "AES-256-CBC");
define("SECRET_KEY", $key_sk);
define("SECRET_IV", $key_siv);

function encriptar($action, $string){
  $output = false;
  $key    = hash("sha256", SECRET_KEY);
  $iv     = substr(hash("sha256", SECRET_IV), 0, 16);

  if ($action == "encrypt"){
    $output = openssl_encrypt($string, ENCRYPT_METHOD, $key, 0, $iv);
    $output = base64_encode($output);

  }
  else if($action == "decrypt"){
        $output = base64_decode($string);
        $output = openssl_decrypt($output, ENCRYPT_METHOD, $key, 0, $iv);
    }
  return $output;
}


$sql = "SELECT password FROM users ORDER BY id DESC LIMIT 1" ;
$query = $conn->prepare($sql);
$query->execute();
$pass = $query->fetchColumn();


$action = 'decrypt';
$string = $pass;
$encriptado = encriptar($action, $string);

echo $encriptado;
echo 'test5';



?>
