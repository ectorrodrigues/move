<?php

  $id     = $_GET['id'];
  $action = $_GET['action'];

  if($action == 'edit'){
    $item = $_SESSION['login'];
  }
  else{
    $item = '0';
  }

  $conn = db();
  foreach($conn->query("SELECT title FROM cms WHERE id = '".$id."' ") as $row) {
    $title    = $row['title'];
  }

  echo '<h1 class="py-lg-3 pb-5 pt-3 mt-lg-0 mt-5 text-dark">minha conta</h1>';

  echo '<form action="'.ROOT.ADMIN.'model'.DS.$action.DS.$id.DS.$item.'" method="post" enctype="multipart/form-data" class="form">';

  $query = $conn->prepare("DESCRIBE ".$title);
  $query->execute();
  $table_fields = $query->fetchAll(PDO::FETCH_COLUMN);


  foreach($table_fields as $field) {

    // TRADUÇÕES -------------------- *******************


    if($field == 'title'){ $label = 'Nome'; }
    if($field == 'email'){ $label = 'E-mail'; }
    if($field == 'password'){ $label = 'Senha'; }
    if($field == 'keypass'){ $label = 'Confirme a senha'; }
    if($field == 'plan_id'){ $label = 'Plano'; }


    // TRADUÇÕES FIM ---------------- *******************

    $inputs = '';

    if($action == 'edit'){
      foreach($conn->query("SELECT * FROM ".$title." WHERE id = '".$item."' ") as $row_item) {
        $value    = $row_item[$field];
        //if($field == 'data'){  $value = '2018-01-01';}
      }
    } else {
      $value  = '';
      if($field == 'data'){  $value = date("Y-m-d");}
    }

    if(in_array($field, $array_fields_hidden, TRUE)){
      $inputs  .= '<input type="hidden" name="'.$field.'" value="'.$value.'" />';
    }

    elseif(in_array($field, $array_fields_text, TRUE)){

      if($field == 'plan_id'){
        foreach($conn->query("SELECT title FROM plans WHERE id = '".$value."' ") as $row) {
          $field    = $row['title'];
        }
        $inputs  .= '<h1 class="text-dark mt-5 mb-0 pb-0">
                      Plano '.$field.'
                    </h1>
                    <div class="text-center mb-4">
                      <strong>
                      <a href="'.ROOT.'">
                        Fazer Upgrade
                      </a>
                      </strong>
                    </div>';
      } else {
        $inputs  .= '<label>'.$label.':</label><input type="text" name="'.$field.'" id="'.$field.'" placeholder="'.$field.'" value="'.$value.'" />';
      }
    }

    elseif(in_array($field, $array_fields_select, TRUE)){

      $inputs  .= '<label>'.$label.':</label><select name="'.$field.'">';

      if($field == "category" || $field == "subcategory"  ){ $field = $field;}
      elseif($field == "id_category"){ $field = "category";}

      foreach($conn->query("SELECT * FROM ".$field." ORDER BY title ASC") as $row) {
        $id_select     = $row['id'];
        $title_select  = $row['title'];

        if($id == $id_select){ $selected = 'selected="selected"'; } else { $selected = ''; }

        $inputs  .= '<option value="'.$id_select.'" '.$selected.'>'.$title_select.'</option>';
      }

      $inputs  .= '</select>';

    }

    elseif(in_array($field, $array_fields_number, TRUE)){
      $inputs  .= '<label>'.$label.':</label><input type="number" name="'.$field.'" id="'.$field.'" placeholder="'.$field.'" value="'.$value.'" />';
    }

    elseif(in_array($field, $array_fields_price, TRUE)){
      $inputs  .= '<label>'.$label.':</label><input type="number" name="'.$field.'" id="'.$field.'" placeholder="'.$field.'"  step="any" value="'.$value.'" />';
    }

    elseif(in_array($field, $array_fields_img, TRUE)){
      $inputs  .= '<label>'.$label.':</label><input type="file" name="'.$field.'" />';
    }

    elseif(in_array($field, $array_fields_time, TRUE)){
      $inputs  .= '<label>'.$label.':</label><input type="time" name="'.$field.'" />';
    }

    elseif(in_array($field, $array_fields_textarea, TRUE)){
      $inputs  .= '<label>'.$label.':</label><textarea name="'.$field.'">'.$value.'</textarea><script> CKEDITOR.replace( "description" );</script><script> CKEDITOR.replace( "content" );</script><script> CKEDITOR.replace( "texto" );</script><script> CKEDITOR.replace( "certificacoes" );</script><script> CKEDITOR.replace( "institucional" );</script><script> CKEDITOR.replace( "lucratividade" );</script>';
      $textreavalue = $value;
    }

    elseif($field == "resumo"){
      //$inputs  .= '<input type="hidden" name="'.$field.'" value="'.$value.'" />';
      $inputs  .= '<label>'.$label.':</label><div>'.$value.'</div>';
    }

    elseif(in_array($field, $array_fields_date, TRUE)){

      $inputs  .= '<label>'.$label.':</label><input type="date" name="'.$field.'" value="'.date("Y-m-d", strtotime($value)).'" />';

    }

    elseif(in_array($field, $array_fields_password, TRUE)){
      $inputs  .= '<label>'.$label.':</label><input type="password" name="'.$field.'" id="'.$field.'" placeholder="'.$field.'" value="'.$value.'" />';
    }

    elseif($field == "status_pagseguro"){
      $inputs  .= '<label>'.$label.':</label>
      <select name = "status_pagseguro">
        <option value="1">Aguardando Pagto</option>
        <option value="2">Aprovado</option>
        <option value="3">Cancelado</option>
        <option value="4">Concluído</option>
      </select>';
    }

    else {
      $inputs  .= '<label>'.$label.':</label><input type="text" name="'.$field.'"  id="'.$field.'" placeholder="'.$field.'" value="'.$value.'" />';
    }

    echo $inputs;
  }

  if(in_array($title, $array_galleries, TRUE)){

    if($action == 'add'){

      echo '<p><label>Fotos:</label><input type="file" name="filesToUpload[]" id="filesToUpload" multiple></p>';

    } else {

      echo '<p><label>Fotos:</label><input type="file" name="filesToUpload[]" id="filesToUpload" multiple></p>';

      foreach($conn->query("SELECT * FROM ".$title."_gallery WHERE id_".$title." = '".$item."' ") as $row) {
        $img    = $row['img'];
        $id_img    = $row['id'];

				$server = $_SERVER['DOCUMENT_ROOT'];

        echo '
        <div class="content-item">
          <div class="content-item-thumb inline" style="background-image:url('.IMG_DIR.$title.DS.$img.');">
          </div>
          <div class="col2 inline" align="right">
            <a href="'.$server.ADMIN.'model'.DS.'gallery'.DS.$id.DS.$id_img.'"><div class="bt_delete inline transition"><i class="fa fa-times" aria-hidden="true"></i></div></a>
          </div>
        </div>
        ';
      }

    }

  }

  echo '
    <div class="col-12 text-center mt-lg-0 mt-5">
      <button type="submit" class="btn mb-5 mt-lg-4 mt-5 transition text-center">Enviar</button>
    </div>
  </form>';

  if($title == 'pedidos'){

    echo '

    <div class="bg-secondary p-5" style="border-radius:8px;">

    <h2 class="mb-3 text-white">// Responder Orçamento</h2>

    <form action="http://mova.ppg.br/resources/clientes/nolano/app/model/AppModel.php?orderfeedback=ok" method="post" enctype="multipart/form-data">
    <textarea name="orderfeedback">

     <p>
     --------------------------------<br />
     '.$textreavalue.'
     </p>
    </textarea>
    <input type="text" name="emailfeedback" value="email" id="emailfeedback"/>
    <script> CKEDITOR.replace( "orderfeedback" );</script>

    <button type="submit" class="btn btn-primary mb-2 mt-2">Responder Email</button>

    </form>

    </div>

    <script>
      var email = $("#email").val();
      $("#emailfeedback").val(email);
    </script>
    ';
  }

  echo '
  <script>$(".bt_add").css("display", "none")</script>
  <script type="text/javascript">$("#preco").maskMoney();</script>
  ';

  echo '
  <script>$("#price").attr("step", "any");</script>
  ';

?>

<script type="text/javascript">
$( document ).ready(function() {
    $('body').css('background', '#fff');
    $('.menu_admin div a i').css('color', '#333');
});
</script>
