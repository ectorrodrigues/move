<?php

$order = '

  <html>
    <head></head>
    <body>

    <div align="center" style="background-color:#ddd; text-align:center; padding:50px;">

      <div align="center" style="background-color:#fff; text-align:left; padding:50px;">

        <h2>// Orçamento</h2>

        <hr>

        <div style="padding:30px 0;">

        <p>
          Olá,<br />
          Segue o orçamento para os itens descritos abaixo na sua solicitação:
        </p>

        <p>
        Att,<br />
        Joao da Silva
        </p>

        </div>

        <hr>

      <p>
      <strong>Cliente:</strong> '.$name.'<br />
      <strong>E-mail:</strong> '.$email.'<br />
      <strong>Telefone:</strong> '.$phone.'<br />
      <strong>Endereco:</strong> '.$address.'<br />
      <strong>Cidade:</strong> '.$city.'<br />
      <strong>UF:</strong> '.$uf.'<br />
      <strong>Data Pedido:</strong> '.$date.'<br />
      </p>

  ';

$order .= '
  <p>
      <table>
        <tbody>
            <tr style="padding:10px; background-color:#999; color:#fff;">
                <th style="padding:10px;">Cod.</th>
                <th style="padding:10px;">Produto</th>
                <th style="padding:10px;">Qtd.</th>
            </tr>
  ';


 $order .= '<tr>';
    $order .= '<td style="padding:10px; border-bottom-color:#ddd; border-bottom-style:solid; border-bottom-width:1px;  border-right-color:#ddd; border-right-style:solid; border-right-width:1px;  border-left-color:#ddd; border-left-style:solid; border-left-width:1px;">1</td>';
    $order .= '<td style="padding:10px; border-bottom-color:#ddd; border-bottom-style:solid; border-bottom-width:1px;  border-right-color:#ddd; border-right-style:solid; border-right-width:1px;  border-left-color:#ddd; border-left-style:solid; border-left-width:1px;">2</td>';
    $order .= '<td style="padding:10px; border-bottom-color:#ddd; border-bottom-style:solid; border-bottom-width:1px;  border-right-color:#ddd; border-right-style:solid; border-right-width:1px;  border-left-color:#ddd; border-left-style:solid; border-left-width:1px;">3</td>';
    $order .= '</tr>';


   $order .= '

  </tr>
        </tbody>
      </table>
    </p>

    <table>
      <tr align="center">
        <td valign="center">
          <img src="http://mova.ppg.br/resources/clientes/nolano/app/webroot/img/logo-email.png" />
        </td>
        <td valign="center" style="text-align:left; padding-left:20px;">
          <p>
          (45) 3123-1234<br />
          contato@nolanosenepol.com
          </p>
          <p>
          Rua lorem ipsum, 123<br />
          Cidade/UF
          </p>
        </td>
      </tr>
    </table>

  </div>

</div>

</body>
</html>

  ';

require ($_SERVER['DOCUMENT_ROOT'].'resources/PHPMailer_5.2.0/class.phpmailer.php');
 require ($_SERVER['DOCUMENT_ROOT'].'resources/PHPMailer_5.2.0/class.pop3.php');
 require ($_SERVER['DOCUMENT_ROOT'].'resources/PHPMailer_5.2.0/class.smtp.php');

 //ini_set('max_execution_time', 0);
 $mail = new PHPMailer;

 //$mail->SMTPDebug = 3;                               // Enable verbose debug output

 $mail->isSMTP();                                      // Set mailer to use SMTP
 $mail->Host = 'email-ssl.com.br';  // Specify main and backup SMTP servers
 $mail->SMTPAuth = true;                               // Enable SMTP authentication
 $mail->Username = 'web@mova.ppg.br';                 // SMTP username
 $mail->Password = 'Avantemova2016';                           // SMTP password
 $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
 $mail->Port = 587;                                 // TCP port to connect to

 $mail->setFrom('web@mova.ppg.br', 'Nolano Senepol');

 $mail->addAddress('web.mova@gmail.com', 'Nolano Senepol');
 
 $mail->addReplyTo('web@mova.ppg.br');
 $mail->isHTML(true);                                  // Set email format to HTML

 $mail->Subject = $subject;
 $mail->Body    = $order;

 if(!$mail->send()) {
     echo '<div class="text-danger">Oops something went wrong please try again !</div>';
 } else {

    echo $order;
    echo '<p>ok</p>';
 }

?>