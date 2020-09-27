
<div class="container-fluid py-3">
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">

          <loop><sql>table=plans;where= id = '<?= $_GET['id']?>' ;</sql>
            <div>
              <h1>{title}</h1>
            </div>

            <div class="text-center pt-3 pb-4 plan-list">
              {description}
              <li>Limite de {function->numberformat->links_limit} cliques no período</li>
              <li>Links no ar duante {function->check_months->months}</li>
              <li>Valor Total: R$ {function->price_format->price}</li>
              </ul>
            </div>

            <div class="">
              <form class="text-left" action="../../../new_account.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="plan" value="<?=$_GET['id']?>">

                <label for="name" class="text-left pl-2 mr-1">Username</label>
                <span id="warning" class="text-warning">
                </span><br>
                <input type="text" name="username" id="username" class="form-control mt-0 mb-3 form-control-lg" placeholder="Somente letras e números, sem acentos.">


                <label for="name" class="text-left pl-2">Nome</label><br>
                <input type="text" name="name" class="form-control mt-0 mb-3 form-control-lg" placeholder="Nome">

                <label for="email" class="text-left pl-2">E-mail</label><br>
                <input type="email" name="email" class="form-control mt-0 mb-3 form-control-lg" placeholder="E-mail">

                <div class="row justify-content-center text-left mx-auto">
                  <div class="col-3 mr-1">
                    <label for="ddd" class="text-left pl-2">DDD</label><br>
                    <input type="tel" name="ddd" class="form-control mt-0 mb-3 form-control-lg" placeholder="XX">
                  </div>
                  <div class="col-7 ml-1">
                    <label for="name" class="text-left pl-2">Celular</label><br>
                    <input type="tel" name="phone" class="form-control mt-0 mb-3 form-control-lg" placeholder="99999-9999">
                  </div>
                </div>

                <label for="name" class="text-left pl-2">Senha</label><br>
                <input type="password" name="password" class="form-control mt-0 mb-3 form-control-lg" placeholder="***"  id="password">

                <label for="name" class="text-left pl-2">Repita sua senha</label><br>
                <input type="password" name="passwordrepeat" class="form-control mt-0 mb-3 form-control-lg" placeholder="Repita sua senha" id="passwordrepeat">

                <div class="row justify-content-center text-left mx-auto mt-5">
                  <button type="submit" class="btn text-center">Comprar</button>
                </div>

              </form>
            </div>

          </loop>

        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$("#passwordrepeat").focusout(function() {
  var pass        = $("#password").val();
  var passrepeat  = $("#passwordrepeat").val();

  if(pass != passrepeat){
    alert("As senhas não coincidem. Digite novamente.");
    $("#passwordrepeat").val('');
  }

});
</script>

<script>

$( document ).ready(function() {
    $( "#username" ).focus();
});

$("#username").focusout(function(e) {
var username = $(this).val();
$('#warning').html('');
$.ajax({
     type: "GET",
     url: '<?=ABSOLUTE_PATH?>app/model/validation.php?v=a',
     data: 'username='+username,
     success: function(data)
     {
       if(data == 'Este username já existe, escolha outro.'){
         $('#warning').html('*'+data);
         $('#username').val('');
         $("#username").focus();
       } else {
         $('#username').val(data);
       }

     }
   });
});
</script>
