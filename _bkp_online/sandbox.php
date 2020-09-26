<?php

  // GET THE POSTS
  $plan     = $_POST['plan'];
  $name     = $_POST['name'];
  $email    = $_POST['email'];
  $ddd      = $_POST['ddd'];
  $phone    = $_POST['phone'];
  $password = $_POST['password'];



  // FORMAT PHONE
  function phoneformat($str){
  	$phoneformated = array( ' '=>'', '.'=>'', '('=>'', ')'=>'', '-'=>'' );
    $phoneformated = strtr( $str, $phoneformated );
  	return $phoneformated;
  }
  $ddd   = phoneformat($ddd);
  $phone = phoneformat($phone);



  // CREATE THE REFERENCE ID
  $reference = date("Ymdhms").uniqid();

  //GET PLAN DATA FROM DATABASE
  include 'app/config/database.php';
  $conn = db();
  foreach($conn->query("SELECT * FROM plans WHERE id = '$plan' ") as $row) {
		$title		= $row['title'];
    $price		= $row['price'];
	}

  // HASH PASSWORD
  $plaintext = $password;
  $cipher = "aes-128-gcm";
  if (in_array($cipher, openssl_get_cipher_methods())){
      $ivlen = openssl_cipher_iv_length($cipher);
      $iv = openssl_random_pseudo_bytes($ivlen);
      $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
      //store $cipher, $iv, and $tag for decryption later
      $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv, $tag);
  }
  $password = $ciphertext;

  // GET DATE
  $created = date("Y-m-d");



  // CREATE USER IN DATABASE
  $sql = "INSERT INTO users (title, email, password, keypass, plan_id, created, updated, reference, active) VALUES ('$name', '$email', '$password', '$password', '$plan', '$created', '$created', '$reference' ,'0')" ;
  $query = $conn->prepare($sql);
  $query->execute();



  //GET THE PAGSEGURO CREDENTIALS
  $query	= $conn->prepare("SELECT content FROM config WHERE title = 'pagseguro_email'");
  $query->execute();
  $pagseguro_email = $query->fetchColumn();

  $query	= $conn->prepare("SELECT content FROM config WHERE title = 'pagseguro_token'");
  $query->execute();
  $pagseguro_token = $query->fetchColumn();

  // GET THE PAGSEGURO CHECKOUT TRANSACTION CODE
  $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout";
  $credenciais = array(
        "email" => "$pagseguro_email",
        "token" => "$pagseguro_token",
        "currency" => "BRL",
        "itemId1" => "$plan",
        "itemDescription1" => "$title",
        "itemAmount1" => "$price",
        "itemQuantity1" => "1",
        "reference" => "$reference",
        "senderName" => "$name",
        "senderAreaCode" => "$ddd",
        "senderPhone" => "$phone",
        "senderEmail" => "c26281648080944450330@sandbox.pagseguro.com.br",
        "shippingAddressRequired" => "false",
        "extraAmount" => "0.00"
  );
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($credenciais));
  $resultado = curl_exec($curl);
  curl_close($curl);
  $checkoutcode = simplexml_load_string($resultado)->code;

  $conn = null;

  //SEND TO PAGSEGURO CHECKOUT PAGE
  header("Location:https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=$checkoutcode");

  //*/

?>
