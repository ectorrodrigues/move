<?php

  // INCLUDES
  include 'app/config/database.php';
  include 'app/config/config.php';
  include 'app/model/AppModel.php';

  // GET THE POSTS
  $plan     = $_POST['plan'];
  $name     = $_POST['name'];
  $username = $_POST['username'];
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
  $conn = db();
  foreach($conn->query("SELECT * FROM plans WHERE id = '$plan' ") as $row) {
		$title		= $row['title'];
    $price		= $row['price'];
	}

  // GET DATE
  $created = date("Y-m-d");

  // HASH PASSWORD
  //generatekeys();
  $crypted_password = encrypting("encrypt", $password, $key_sk, $key_siv);

  // CREATE USER IN DATABASE
  $conn = db();
  $sql = "INSERT INTO users (username, title, email, password, keypass, key_iv, key_tag, plan_id, created, updated, reference, active) VALUES('$username', '$name', '$email', '$crypted_password', '$crypted_password', '$key_siv', '$key_sk', '$plan', '$created', '$created', '$reference' ,'0')" ;
  $query = $conn->prepare($sql);
  $query->execute();

  // echo "new<br>$crypted_password<br>$key_sk"; die();

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
