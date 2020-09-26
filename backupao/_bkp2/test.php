<?php

/*
$plaintext = "eE7pQPGa3SN1Yg==";
$cipher = "aes-128-gcm";
if (in_array($cipher, openssl_get_cipher_methods())){
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
    //store $cipher, $iv, and $tag for decryption later
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv, $tag);
}

echo $ciphertext.'<br>';
echo $original_plaintext.'<br>';
*/

/*
$key = hex2bin('5ae1b8a17bad4da4fdac796f64c16ecd');
$plaintext = "teste";
$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
$iv = openssl_random_pseudo_bytes($ivlen);
$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );

echo utf8_encode($ciphertext_raw);
*/



/*
// Create The First Key
$firstkey = base64_encode(openssl_random_pseudo_bytes(32));

// Create The Second Key
$secondkey = base64_encode(openssl_random_pseudo_bytes(64));

// Save The Keys In Your Configuration File
define('FIRSTKEY','FoinoasdaASDNASdnASODN09823hnuiASD');
define('SECONDKEY','jASDNDOINfbidksjn8932hrDASnd9iNJKo');

function secured_encrypt($data)
{
$first_key = base64_decode(FIRSTKEY);
$second_key = base64_decode(SECONDKEY);

$method = "aes-256-cbc";
$iv_length = openssl_cipher_iv_length($method);
$iv = openssl_random_pseudo_bytes($iv_length);

$first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);
$second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

$output = base64_encode($iv.$second_encrypted.$first_encrypted);
return $output;
}

function secured_decrypt($input)
{
$first_key = base64_decode(FIRSTKEY);
$second_key = base64_decode(SECONDKEY);
$mix = base64_decode($input);

$method = "aes-256-cbc";
$iv_length = openssl_cipher_iv_length($method);

$iv = substr($mix,0,$iv_length);
$second_encrypted = substr($mix,$iv_length,64);
$first_encrypted = substr($mix,$iv_length+64);

$data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
$second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

if (hash_equals($second_encrypted,$second_encrypted_new))
return $data;

return false;
}

$secpass = secured_encrypt('teste');
echo '<br>';
echo $secpass.'<br>';

//$secdec = secured_decrypt($secpass);
//echo $secpass.'<br>';
*/

/*
$password = 'testesenha';
$key = hex2bin('5ae1b8a17bad4da4fdac796f64c16ecd');
define ("SECRETKEY", $key);
$hash = openssl_encrypt($password, "AES-128-ECB", SECRETKEY);

echo $hash.'<br>';

$plain = openssl_decrypt($hash, "AES-128-ECB", SECRETKEY);
echo $plain.'<br>';
*/


/*
    $plaintext = utf8_encode('testesenha');
    $key = hex2bin('5ae1b8a17bad4da4fdac796f64c16ecd');
    $cipher = "aes-128-gcm";

    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
    //store $cipher, $iv, and $tag for decryption later

    $ciphertext2 = openssl_encrypt('NBjWhT8zYuMPtg==', $cipher, $key, $options=0, $iv, $tag);
    $original_plaintext = openssl_decrypt($ciphertext2, $cipher, $key, $options=0, $iv, $tag);


echo 'cipher: '.$ciphertext.'<br>';
echo 'original: '.$original_plaintext.'<br>';

*/



$plaintext = 'lrgQ2nRsrJPy2A==';
$key = hex2bin('5ae1b8a17bad4da4fdac796f64c16ecd');
$cipher = "aes-128-gcm";
$iv = 'oGqgI5zWtDmaJnL+';
$tag = 'tqjFo+ChP8UB2gHkG9F5Vw==';
//$ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
$original_plaintext = openssl_decrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv, $tag);
//echo $ciphertext.'<br>';
//echo $original_plaintext;

echo base64_encode($key);






?>
