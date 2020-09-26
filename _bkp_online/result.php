<?php

$link = $_GET['link'];

include 'app/config/database.php';
$conn = db();
foreach($conn->query("SELECT * FROM links WHERE code = '$link' ") as $row) {
  $userlink     = $row['link'];
  $socialmedia  = $row['socialmedia'];
  $code         = $row['code'];
  $user_id      = $row['user_id'];
  $clicks       = $row['clicks'];
}

foreach($conn->query("SELECT * FROM users WHERE id = '$user_id' ") as $row) {
  $active   = $row['active'];
  $plan_id  = $row['plan_id'];
}

foreach($conn->query("SELECT SUM(clicks) AS totalclicks FROM links WHERE user_id = '$user_id' ") as $row) {
  $totalclicks   = $row['totalclicks'];
}

if($active == '1'){
  $continue = 'yes';

  foreach($conn->query("SELECT * FROM plans WHERE id = '$plan_id' ") as $row) {
    $links_limit   = $row['links_limit'];
  }

  if($links_limit < $totalclicks){
    $continue = 'no';
    $error_message = 'Este link excedeu o número de cliques do plano. Se você é o dono da conta que criou este link, acesse seu painel.<br><a href=\"https://movedl.com/admin\">Acesse movedl.com</a>';
  }

} else {
  $continue = 'no';
    $error_message = 'Este link está inativo. Se você é o dono desta conta, acesse seu painel.<br><a href=\"https://movedl.com/admin\">Acesse movedl.com</a>';
}


$clickscount = ($clicks+1);

$sql =  "UPDATE links SET clicks = $clickscount  WHERE code = '$code' ";
$query = $conn->prepare($sql);
$query->execute();

?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>move link</title>
</head>
<body>

<div style="text-align:center; font-family:Arial, sans-serif; padding:150px 50px 0 50px; line-height:30px;" id="content">

<script type="text/javascript">
  if (screen.width <= 699) {

    <?php

    if($continue == 'yes'){
      if($socialmedia == 'instagram'){
        echo 'document.location = "instagram://user?username='.$userlink.'";';
      }
      elseif($socialmedia == 'facebook'){
        echo 'document.location = "fb://profile/'.$userlink.'";';
      }
    } else {
      echo 'document.write("'.$error_message.'");';
    }
    ?>

  }
  else {

    <?php

    if($continue == 'yes'){
      if($socialmedia == 'instagram'){
        echo 'document.location = "https://instagram.com/'.$userlink.'";';
      }
      elseif($socialmedia == 'facebook'){
        echo 'document.location = "fb://profile/'.$userlink.'";';
      }
    } else {
      echo 'document.write("'.$error_message.'");';
    }

    ?>
}
</script>

</div>

</body>
</html>
