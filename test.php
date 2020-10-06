<?php

$pagseguro_email = 'movedeeplink@gmail.com';
$pagseguro_token = 'DB01CE92BEBF4455A0CE1ABDD9FCF901';

$url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/$code?email=$pagseguro_email&token=$pagseguro_token";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$resultado2 = curl_exec($curl);
curl_close($curl);
$full = simplexml_load_string($resultado2);
$status = simplexml_load_string($resultado2)->status;
$reference = simplexml_load_string($resultado2)->reference;
$id_item = simplexml_load_string($resultado2)->id;

var_dump($full);

?>
