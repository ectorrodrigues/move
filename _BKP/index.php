<?php include 'head.php' ?>

<body>

	<main>
		<div class="container-fluid">

			<div class="row justify-content-center py-5">
				<div class="col-12">
					<h1>move</h1>
				</div>
			</div>

			<div class="row justify-content-center py-5 h-100">
				<div class="col-lg-8 col-10 py-5 my-auto align-self-center">
					<form action="action.php" method="post" enctype="multipart/form-data">
						<div class="form-group text-center">
					    <label for="socialmedia">Social Media</label><br>
					    <select id="socialmedia" class="socialmedia" name="socialmedia">
					      <option value="instagram">Instagram</option>
                <option value="facebook">Facebook</option>
					    </select>
					  </div>
					  <div class="form-group text-center mt-5">
					    <label for="link">Digite aqui o seu usuário.</label><br>

					    <input type="text" name="link" class="form-control mt-3" id="link" aria-describedby="link" placeholder="link">
							<div class="small mt-4">Digite só o usuario, sem a arroba.<br>Ex.: Se o seu instagram é instagram.com/joaosilva, digite apenas <strong>joaosilva</strong></div>
					  </div>
						<div class="text-center">
							<button type="submit" class="btn text-center mt-5">Criar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</main>

</body>
