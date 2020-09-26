<?php


// INCLUDES
include 'app/config/database.php';
include 'app/config/config.php';
include 'app/model/AppModel.php';

  $email = 'web.mova@gmail.com';
  $subject = 'Move - Conta Ativada';
  $content = '
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Email Move</title>
    </head>
    <body style="width:100%; text-align:center; background-color:#eee; font-family:Arial, sans serif; color:#333;" align="center">
      <div style="width:100%; text-align:center; margin:30px 0; color:#eee;">=)</div>
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
            <h2 style="margin-top:-10px; color:#000;">email@email.com</h2>
          </p>
          <p>
            <span style="">Sua senha é:</span><br>
            <h2 style="margin-top:-10px; color:#000;">testesenha</h2>
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
      <div style="width:100%; text-align:center; margin:30px 0; color:#eee;">.</div>
    </body>
  </html>

  ';



include 'app/model/email.php';

$conn = null;

 ?>
