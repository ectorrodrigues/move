<?php

// INCLUDES
include ('../config/database.php');
include ('../config/directories.php');

function slug($str){
	$slug = array( ' '=>'', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b' );
	$slug = strtolower(strtr( $str, $slug ));
	return $slug;
} //endfunction

function slugwithdash($str){
	$slug = array( ' '=>'-', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b' );
	$slug = strtolower(strtr( $str, $slug ));
	return $slug;
} //endfunction


// CHECK IF USERNAME EXISTS
if(isset($_GET['username'])){

  $usernamecheck = $_GET['username'];
  $userslug = slug($usernamecheck);

  $conn = db();
  $query = $conn->prepare("SELECT username FROM users WHERE username = '$userslug'");
  $query->execute();

  if ($query->rowCount() > 0){
    echo 'Este username já existe, escolha outro.';
    return 'Este username já existe, escolha outro.';
  } else {
    echo $userslug;
  }


}

// CHECK IF LINK NAME EXISTS
if(isset($_GET['linkname'])){

  $linkname = $_GET['linkname'];
  $linknameslug = slugwithdash($linkname);

  $conn = db();
  $query = $conn->prepare("SELECT title FROM links WHERE title = '$linknameslug'");
  $query->execute();

  if ($query->rowCount() > 0){
    echo 'Este link já existe, escolha outro.';
    return 'Este link já existe, escolha outro.';
  } else {
    echo $linknameslug;
  }


}

?>
