
		<?php include ELEMENTS_DIR.'menu_admin.php'?>

		<div class="row justify-content-center pt-lg-2 pt-5">
			<div class="col-12 text-center my-lg-0 my-5">
				<img src="<?=FILES_DIR?>logo_negative.svg" alt="logo" class="logo p-3">
			</div>
		</div>

  <div class="row justify-content-center pt-lg-1 pt-2 pb-5 h-100 text-white" id="content">
    <div class="col-lg-6 col-10 py-5 my-auto align-self-center">

      <form action="" method="post" enctype="multipart/form-data" id="form">
        <div class="form-group text-center">
          <ul class="socialmedias text-center">
            <li class="socialmediasli instagram">
              <input name="socialmedia" type="radio" id="paypal" value="instagram" onclick="changeinstagram('linear-gradient(45deg, rgba(44,39,76,1) 0%, rgba(255,0,97,0.9962359943977591) 100%)')" checked>
              <label for="paypal">Instagram</label>
            </li>

            <li class="socialmediasli facebook">
              <input name="socialmedia" type="radio" id="pagseguro" value="facebook" onclick="changefacebook('linear-gradient(45deg, rgba(69,0,172,1) 0%, rgba(0,171,236,1) 100%)')">
              <label for="pagseguro">Facebook</label>
            </li>
          </ul>
        </div>


        <div class="form-group text-center mt-5">

          <label for="link">Dê um título pro seu deep link</label>
					<span id="warning" class="text-warning">
					</span><br>
          <input type="text" name="title" class="form-control mt-0 mb-4 form-control-lg" id="title" aria-describedby="link" placeholder="Ex.: Instagram da Maria">

          <label for="link">Cole aqui o link</label>
          <input type="text" name="link" class="form-control mt-0 form-control-lg" id="link" aria-describedby="link" placeholder="Ex.: https://www.redesocial.com/usuario">
          <div class="small mt-4 explain">Cole a URL completa, ou apenas o usuário desejado. <br>Ex.: Se o seu instagram é instagram.com/joaosilva, digite apenas <strong>joaosilva</strong></div>
        </div>

          <input type="hidden" name="user" value="<?PHP if (!isset($_SESSION['login'])) { echo $user_id; } else { echo $_SESSION['login']; } ?>">

        <div class="text-center mt-lg-0 mt-5">
          <button type="submit" class="btn text-center mt-lg-3 mt-5">Criar</button>
        </div>

      </form>

    </div>
  </div>

  <div id="result">
  </div>


	<script>

	$( document ).ready(function() {
	    $( "#title" ).focus();
	});

	$("#title").focusout(function(e) {
	var linkname = $(this).val();
	$('#warning').html('');
	$.ajax({
	     type: "GET",
	     url: '<?=ABSOLUTE_PATH?>app/model/validation.php?v=a',
	     data: 'linkname='+linkname,
	     success: function(data)
	     {
	       if(data == 'Este link já existe, escolha outro.'){
	         $('#warning').html('*'+data);
	         $('#title').val('');
	         $("#title").focus();
	       } else {
	         $('#title').val(data);
	       }

	     }
	   });
	});
	</script>


<script>
$("#form").submit(function(e) {
e.preventDefault(); // avoid to execute the actual submit of the form.
var form = $(this);
var url = form.attr('action');
$.ajax({
     type: "POST",
     url: '<?=ABSOLUTE_PATH?>app/model/action.php',
     data: form.serialize(), // serializes the form's elements.
     success: function(data)
     {
         $('#content').html(data);
     }
   });
});
</script>

<script>

function changeinstagram(str){
  $('body').css('background', str);
  $('.explain').html('Cole a URL completa, ou apenas o usuário desejado. <br>Ex.: Se o seu instagram é instagram.com/joaosilva, digite apenas <strong>joaosilva</strong>')
}

function changefacebook(str){
  $('body').css('background', str);
  $('.explain').html('Você pode colar a URL completa, ou apenas o nome do perfil ou página.<br>Você ainda pode enviar direto para um post específico, colando a URL direta dele.');
}

</script>
