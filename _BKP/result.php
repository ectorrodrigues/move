<?php

include 'db.php';

$conn = db();

$link = $_GET['link'];

$query 	= $conn->prepare("SELECT link FROM links WHERE code = '".$link."'");
$query->execute();
$userlink = $query->fetchColumn();

$query 	= $conn->prepare("SELECT socialmedia FROM links WHERE code = '".$link."'");
$query->execute();
$socialmedia = $query->fetchColumn();

?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>move link</title>
</head>
<body>

<script type="text/javascript">
  if (screen.width <= 699) {

    <?php

      if($socialmedia == 'instagram'){
        echo 'document.location = "instagram://user?username='.$userlink.'";';
      }
      elseif($socialmedia == 'facebook'){
        echo 'document.location = "fb://profile/'.$userlink.'";';
      }

    ?>


  }
  else {

    <?php

      if($socialmedia == 'instagram'){
        echo 'document.location = "https://instagram.com/'.$userlink.'";';
      }
      elseif($socialmedia == 'facebook'){
        echo 'document.location = "fb://profile/'.$userlink.'";';
      }

    ?>
}
</script>


</body>
</html>
