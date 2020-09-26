<?php

  echo '<h1 class="py-lg-3 pb-5 pt-3 mt-lg-0 mt-5 text-dark">links</h1>';

  echo '
    <div class="row text-dark">
      <div class="col-12 text-right filters">
        Filtrar:<span class="separator">|</span><span class="filter_all" onclick="filter(\'filter_all\')">Tudo</span>
                <span class="separator">|</span>
                <span class="filter_ig" onclick="filter(\'filter_instagram\')"><i class="fab fa-instagram"></i></span>
                <span class="separator">|</span>
                <span class="filter_fb" onclick="filter(\'filter_facebook\')"><i class="fab fa-facebook"></i></span>
      </div>
    </div>
  ';

  $test = $_SESSION['login'];

  $query  = $conn->prepare("SELECT username FROM users WHERE id = '$test' ");
  $query->execute();
  $username = $query->fetchColumn();

  foreach($conn->query("SELECT * FROM links WHERE user_id = '$test' ORDER BY id DESC") as $row) {

    $id = $row['id'];
    $code = $row['code'];
    $created = $row['created'];
    $clicks = $row['clicks'];
    $socialmedia = $row['socialmedia'];

    if(isset($row['title'])){
      $title = $row['title'];
    }

    echo '
    <div class="row justify-content-around history my-4 text-dark hr-border pb-4 filter_'.$socialmedia.'">
      <div class="col-12">

        <div class="row">
          <div class="col-12">
            <h2><font size="-1">::</font> '.$title.'</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-11">
            <input type="text" name="link'.$id.'" id="link'.$id.'" value="'.ABSOLUTE_PATH.'dl/'.$username.'/'.$title.'">
          </div>
          <div class="col-1 my-auto">
            <i class="far fa-clone my-auto transition" onclick="copylink('.$id.')"></i>
          </div>
        </div>

        <div class="row mt-2 pb-2 infos">
          <div class="col-12 text-left">
            Cliques: <strong>'.$clicks.'</strong>
            <span class="mx-3"> | </span>
            Criado: <strong>'.date_format(date_create($created), "d/m/Y").'</strong>
            <span class="mx-3"> | </span>
            <strong>'.$socialmedia.'</strong>
          </div>
        </div>

      </div>
    </div>
    ';
  }


?>

<script type="text/javascript">
$( document ).ready(function() {
    $('body').css('background', '#fff');
    $('.menu_admin div a i').css('color', '#333');
});
</script>

<script>
function copylink(str) {
  var copyText = document.getElementById("link"+str);
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Link Copiado: " + copyText.value);
}
</script>

<script>
function filter(str) {
  if(str == 'filter_all'){
    $('.filter_instagram').show();
    $('.filter_facebook').show();
  }

  if(str == 'filter_instagram'){
    $('.filter_instagram').show();
    $('.filter_facebook').hide();
  }


  if(str == 'filter_facebook'){
    $('.filter_instagram').hide();
    $('.filter_facebook').show();
  }
}
</script>


<!--
<a href="'.ROOT.ADMIN.'edit'.DS.$id_item.DS.$id.'"><div class="bt_edit inline transition"><i class="fas fa-pen"></i></div></a>
<a href="'.DS.ADMIN.'model'.DS.'delete'.DS.$id_item.DS.$id.'"><div class="bt_delete inline transition"><i class="fa fa-times" aria-hidden="true"></i></div></a>
-->
