<?php
   $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions";

   $credenciais = array(
        "email" => "movedeeplink@gmail.com",
        "token" => "DB01CE92BEBF4455A0CE1ABDD9FCF901"
   );
   $curl = curl_init($url);
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($credenciais));
   $resultado = curl_exec($curl);
   curl_close($curl);
   $session = simplexml_load_string($resultado)->id;
?>

<!DOCTYPE html>



<html lang="pt" dir="ltr">
<head>

    <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded; charset=ISO-8859-1" />
    <meta name="author" content="Mova" />

    <!-- Jquery and Ajax Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src=
    "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>MOVE</title>

  </head>
   <body>

     <?php
        $url = "https://ws.pagseguro.uol.com.br/v2/transactions/";

        $credenciais = array(
          "paymentMode" => "default",
          "paymentMethod" => "creditCard",
          "receiverEmail" => "suporte@lojamodelo.com.br",
          "currency" => "BRL",
          "extraAmount" => "1.00",
          "itemId1" => "0001",
          "itemDescription1" => "Notebook Prata",
          "itemAmount1" => "24300.00",
          "itemQuantity1" => "1",
          "notificationURL" => "https://sualoja.com.br/notifica.html",
          "reference" => "REF1234",
          "senderName" => "Jose Comprador",
          "senderCPF" => "22111944785",
          "senderAreaCode" => "11",
          "senderPhone" => "56273440",
          "senderEmail" => "comprador@uol.com.br",
          "senderHash" => "{hash_obtido_no_passo_2.3}",
          "shippingAddressRequired" => "true",
          "shippingAddressStreet" => "Av. Brig. Faria Lima",
          "shippingAddressNumber" => "1384",
          "shippingAddressComplement" => "5o andar",
          "shippingAddressDistrict" => "Jardim Paulistano",
          "shippingAddressPostalCode" => "01452002",
          "shippingAddressCity" => "Sao Paulo",
          "shippingAddressState" => "SP",
          "shippingAddressCountry" => "BRA",
          "shippingType" => "1",
          "shippingCost" => "1.00",
          "creditCardToken" => "{creditCard_token_obtido_no_passo_2.6}",
          "installmentQuantity" => "{quantidade_de_parcelas_escolhida}
          "installmentValue" => "{installmentAmount_obtido_no_retorno_do_passo_2.5}",
          "noInterestInstallmentQuantity" => "{valor_maxInstallmentNoInterest_incluido_no_passo_2.5}",
          "creditCardHolderName" => "Jose Comprador",
          "creditCardHolderCPF" => "22111944785",
          "creditCardHolderBirthDate" => "27/10/1987",
          "creditCardHolderAreaCode" => "11",
          "creditCardHolderPhone" => "56273440",
          "billingAddressStreet" => "Av. Brig. Faria Lima",
          "billingAddressNumber" => "1384",
          "billingAddressComplement" => "5o andar",
          "billingAddressDistrict" => "Jardim Paulistano",
          "billingAddressPostalCode" => "01452002",
          "billingAddressCity" => "Sao Paulo",
          "billingAddressState" => "SP",
          "billingAddressCountry" => "BRA"
        );
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($credenciais));
        $resultado = curl_exec($curl);
        curl_close($curl);
        $session = simplexml_load_string($resultado)->id;
     ?>

   </body>
</html>
