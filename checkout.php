<?php

// GET THE NOTIFICATION CODE
$code = $_POST['notificationCode'];

// INCLUDES
include 'app/config/database.php';
include 'app/config/config.php';
include 'app/model/AppModel.php';

$conn = db();

// GET THE PAGSEGURO CREDENTIALS
$query	= $conn->prepare("SELECT content FROM config WHERE title = 'pagseguro_email'");
$query->execute();
$pagseguro_email = $query->fetchColumn();

$query	= $conn->prepare("SELECT content FROM config WHERE title = 'pagseguro_token'");
$query->execute();
$pagseguro_token = $query->fetchColumn();

// CURL THE PAGSEGURO NOTIFICATION DATA
$url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/$code?email=$pagseguro_email&token=$pagseguro_token";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$resultado2 = curl_exec($curl);
curl_close($curl);
$status = simplexml_load_string($resultado2)->status;
$reference = simplexml_load_string($resultado2)->reference;
$id_item = simplexml_load_string($resultado2)->items->item->id;

// GET USER DATA
foreach($conn->query("SELECT * FROM users WHERE reference = '$reference' ") as $row) {
  $emailuser  = $row['email'];
  $password		= $row['password'];
  $iv         = $row['key_iv'];
  $tag		    = $row['key_tag'];
}

// $emailuser = 'web.mova@gmail.com'; //EMAIL TESTING - REMOVE THIS LINE FOR PRODUCTION

// PAYMENT STATUS CONDITIONAL
if($status == '3'){

  $updated = date("Y-m-d");

  $query 	= $conn->prepare("UPDATE users SET active = '1', plan_id = '$id_item', updated = '$updated' WHERE reference = '$reference' ");
  $query->execute();

  // DECRYPTING PASSWORD
  $decrypted_password = encrypting("decrypt", $password, $tag, $iv);

  $email = $emailuser;
  $subject = 'Move - Ativação de Conta';
  $content = '
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Email Move</title>
    </head>
    <body style="width:100%; text-align:center; background-color:#ddd; font-family:Arial, sans serif; color:#333;" align="center">
      <div style="width:100%; text-align:center; margin:30px 0; color:#ddd;">.</div>
      <div style="width:auto; text-align:center; margin:30px; border-radius:12px; background-color:#fff; padding:80px; margin:40px 100px;" align="center">

        <div class="text-align:text-center;">
          <img src="https://movedl.com/app/webroot/files/move_logo_positive.png" alt="move-logo" style="width:150px;">
        </div>
        <p><br></p>

        <div class="text-align:text-center; margin-top:90px;">
          <p>
            <h1 class="">Sua conta está ativada!</h1>
          </p>
          <p>
            <span style="">Seu login é:</span><br>
            <h2 style="margin-top:-10px; color:#000;">'.$emailuser.'</h2>
          </p>
          <p>
            <span style="">Sua senha é:</span><br>
            <h2 style="margin-top:-10px; color:#000;">'.$decrypted_password.'</h2>
          </p>
          <p>
            <br>
            <a href="https://movedl.com/admin" style="color:#E2067C !important; text-decoration:none !important; font-size:20px; font-weight:bold;">> Acesse já clicando aqui.</a>
          </p>


          <p>
            <br><br>
            <span style="font-size:13px; color:#888;">Este é um email seguro de ativação de conta, enviado pela Move.</span><br>
            <a href="https://movedl.com" style="color:#333 !important; text-decoration:none !important; font-size:13px; font-weight:bold;">movedl.com</a>
          </p>

        </div>

      </div>
      <div style="width:100%; text-align:center; margin:30px 0; color:#ddd;">.</div>
    </body>
  </html>

  ';

} else {

  $email = $emailuser;
  $subject = 'Move - Conta Inativa';

  $content = '
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Email Move</title>
    </head>
    <body style="width:100%; text-align:center; background-color:#ddd; font-family:Arial, sans serif; color:#333;" align="center">
      <div style="width:100%; text-align:center; margin:30px 0; color:#ddd;">.</div>
      <div style="width:auto; text-align:center; margin:30px; border-radius:12px; background-color:#fff; padding:80px; margin:40px 100px;" align="center">

        <div class="text-align:text-center;">
          <img src="https://movedl.com/app/webroot/files/move_logo_positive.png" alt="move-logo" style="width:150px;">
        </div>
        <p><br></p>

        <div class="text-align:text-center; margin-top:90px;">
          <p>
            <h1 class="">Seu pagamento ainda não foi autorizado =(</h1>
          </p>
          <p>
            <span style="">Aguarde, se em dentro de 2 horas você não receber um e-mail de ativação, fale conosco!</span><br>
            <h3 style="margin-top:-10px; color:#000;"><br>Whatsapp: (45) 99968-3799</h3>
            <h3 style="margin-top:-10px; color:#000;">contato@movedl.com</h3><br>
          </p>
          <p>
            <a href="https://movedl.com" style="color:#E2067C !important; text-decoration:none !important; font-size:20px; font-weight:bold;">> Acesse o site.</a>
          </p>


          <p>
            <br><br>
            <span style="font-size:13px; color:#888;">Este é um email seguro de ativação de conta, enviado pela Move.</span><br>
            <a href="https://movedl.com" style="color:#333 !important; text-decoration:none !important; font-size:13px; font-weight:bold;">movedl.com</a>
          </p>

        </div>

      </div>
      <div style="width:100%; text-align:center; margin:30px 0; color:#ddd;">.</div>
    </body>
  </html>

  ';

}

include 'app/model/email.php';

$conn = null;

 ?>
