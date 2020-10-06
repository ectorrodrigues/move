<?php

  // INCLUDES
  include 'app/config/database.php';
  include 'app/config/config.php';
  include 'app/model/AppModel.php';

  // OPEN DATABASE CONNECTION
  $conn = db();

  // FORMAT PHONE
  function phoneformat($str){
    $phoneformated = array( ' '=>'', '.'=>'', '('=>'', ')'=>'', '-'=>'' );
    $phoneformated = strtr( $str, $phoneformated );
    return $phoneformated;
  }

  if(!empty($_GET['action'])){

    if($_GET['action'] == 'update'){
      // GET THE GETS
      $reference = $_GET['reference'];
      $plan = $_GET['plan'];
      //GET PLAN DATA
      foreach($conn->query("SELECT * FROM plans WHERE id = '$plan' ") as $row) {
        $title		= $row['title'];
        $price		= $row['price'];
    	}
      // GET USER DATA
      foreach($conn->query("SELECT * FROM users WHERE reference = '$reference' ") as $row) {
        $name		= $row['title'];
        $ddd		= $row['ddd'];
        $phone  = $row['phone'];
    	}
      $ddd   = phoneformat($ddd);
      $phone = phoneformat($phone);
    }

  } else {

    // GET THE POSTS
    $plan     = $_POST['plan'];
    $name     = $_POST['name'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $ddd      = $_POST['ddd'];
    $phone    = $_POST['phone'];
    $password = $_POST['password'];
    $ddd   = phoneformat($ddd);
    $phone = phoneformat($phone);

    // CREATE THE REFERENCE ID
    $reference = date("Ymdhms").uniqid();

    //GET PLAN DATA FROM DATABASE
    foreach($conn->query("SELECT * FROM plans WHERE id = '$plan' ") as $row) {
  		$title		= $row['title'];
      $price		= $row['price'];
  	}

    // GET DATE
    $created = date("Y-m-d");

    // HASH PASSWORD
    //generatekeys();
    $crypted_password = encrypting("encrypt", $password, $key_sk, $key_siv);
    $active = '0';

    // CREATE USER IN DATABASE

    $sql = "INSERT INTO users (username, title, email, ddd, phone, password, keypass, key_iv, key_tag, plan_id, created, updated, reference, active) VALUES (:username, :name, :email, :ddd, :phone, :crypted_password, :crypted_keypass, :key_siv, :key_sk, :plan, :created, :updated, :reference, :active)" ;
    $query = $conn->prepare($sql);
    $query->bindParam(':username', $username);
    $query->bindParam(':name', $name);
    $query->bindParam(':email', $email);
    $query->bindParam(':ddd', $ddd);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':crypted_password', $crypted_password);
    $query->bindParam(':crypted_keypass', $crypted_password);
    $query->bindParam(':key_siv', $key_siv);
    $query->bindParam(':key_sk', $key_sk);
    $query->bindParam(':plan', $plan);
    $query->bindParam(':created', $created);
    $query->bindParam(':updated', $created);
    $query->bindParam(':reference', $reference);
    $query->bindParam(':active', $active);
    $query->execute();

  }

  // GET THE PAGSEGURO CREDENTIALS
  $query	= $conn->prepare("SELECT content FROM config WHERE title = 'pagseguro_email'");
  $query->execute();
  $pagseguro_email = $query->fetchColumn();

  echo $pagseguro_email; die();

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
  //curl_setopt($ch, CURLOPT_FAILONERROR, true);
  $resultado = curl_exec($curl);

  curl_close($curl);
  $checkoutcode = simplexml_load_string($resultado)->code;

  $conn = null;

  //SEND TO PAGSEGURO CHECKOUT PAGE
  //header("Location:https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=$checkoutcode");

  //*/

?>
