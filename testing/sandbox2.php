<?php

  $inpsenderhash = $_POST['inpsenderhash'];
  $inpcardtoken = $_POST['inpcardtoken'];

   $url = "https://ws.pagseguro.uol.com.br/v2/transactions/";

   $credenciais = array(
     "paymentMode" => "default",
     "paymentMethod" => "creditCard",
     "receiverEmail" => "movedeeplink@gmail.com",
     "currency" => "BRL",
     "extraAmount" => "1.00",
     "itemId1" => "0001",
     "itemDescription1" => "Notebook Prata",
     "itemAmount1" => "10.00",
     "itemQuantity1" => "1",
     "notificationURL" => "https://movedl.com/checkout.php",
     "reference" => "REF1234",
     "senderName" => "Jose Comprador",
     "senderCPF" => "22111944785",
     "senderAreaCode" => "11",
     "senderPhone" => "56273440",
     "senderEmail" => "c26281648080944450330@sandbox.pagseguro.com.br",
     "senderHash" => "$inpsenderhash",
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
     "creditCardToken" => "$inpcardtoken",
     "installmentQuantity" => "1",
     "installmentValue" => "100",
     "noInterestInstallmentQuantity" => "2",
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

   echo 'feito';
?>
