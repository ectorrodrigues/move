<?php
    require (ELEMENTS_DIR .'head.php');
?>


<body>
  <div class="container-fluid mt-5 pt-5">

    <div class="row justify-content-center pt-5 mb-lg-0 mb-5">
      <div class="col-12 text-center my-lg-0 my-5">
        <img src="<?=FILES_DIR?>logo_negative.svg" alt="logo" class="logo">
      </div>
    </div>

    <div class="row justify-content-center py-5">
      <div class="col-lg-5 col-10">
	       <?php
	        if($_SERVER['REQUEST_METHOD'] == 'POST'){
	           echo '<p class="text-center">Accesso negado. Tente novamente.</p>';
	        }
	       ?>

			     <form action="<?= ROOT.'admin'.DS?>" method="post" enctype="multipart/form-data">

             <div class="form-group text-center">
               <label for="user">Usuário</label><br>
               <input type="text" name="user" class="form-control mt-0 form-control-lg"/><br>

               <label for="password">Senha</label><br>
               <input type="password" name="password" class="form-control mt-0 form-control-lg"/><br>
             </div>

             <div class="text-center mt-1">
   						<button type="submit" class="btn text-center submit transition">Entrar</button>
   					</div>

		      </form>
		</div>

	</div>

  </div>
</body>
</html>
