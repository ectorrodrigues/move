<?php

 function email($email, $content, $subject){

   require 'vendors/PHPMailer_5.2.0/PHPMailerAutoload.php';

   $mail = new PHPMailer;

   //$mail->SMTPDebug = 3;                             // Enable verbose debug output
   $mail->isSMTP();                                    // Set mailer to use SMTP
   $mail->Host = 'mail.movedl.com';                    // Specify main and backup SMTP servers
   $mail->SMTPAuth = true;                             // Enable SMTP authentication
   $mail->Username = 'contato@movedl.com';             // SMTP username
   $mail->Password = '#Avantemova2016';                // SMTP password
   $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
   $mail->Port = 587;                                  // TCP port to connect to
   $mail->CharSet = 'UTF-8';

   $mail->setFrom('contato@movedl.com', 'Move');
   $mail->addAddress($email, 'Mova');
   $mail->addReplyTo('contato@movedl.com');
   $mail->isHTML(true);                                  // Set email format to HTML

   $mail->Subject = 'Move - Dados de Acesso';
   $mail->Body    = $content;

   if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'Message has been sent';
  }

}

email($email, $content, $subject);

?>
