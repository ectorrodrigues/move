<?php
	require (ELEMENTS_DIR .'head.php');
?>

<body>

<main>
	<div class="container-fluid">

<?php


	$url = /*$_SERVER['HTTP_HOST'].*/$_SERVER['REQUEST_URI'];

	if (preg_match('#[0-9]#',$url)){

		$id_item = $_GET['id'];

		if(strpos($url,"add") == true || strpos($url,"edit") == true || strpos($url,"delete") == true){

			include (ELEMENTS_DIR.'menu_admin.php');

			echo '<div class="row justify-content-center py-lg-3 pt-0 px-3">
							<div class="col-lg-6 col-10 py-lg-2 pt-0">';

			include (HELPER_DIR.'form.php');

			echo '	</div>
						</div>';

		} else {
			include (ELEMENTS_DIR.'menu_admin.php');

			echo '<div class="row justify-content-center py-lg-3 pt-0 px-3">
							<div class="col-lg-6 col-10 py-lg-2 pt-0 mb-5">';

			include (HELPER_DIR.'list.php');

			echo '	</div>
						</div>';
		}

	} else {

		foreach($conn->query("SELECT * FROM users WHERE id = '$user_id' ") as $row) {
		  $active    = $row['active'];
			$plan_id   = $row['plan_id'];
			$updated   = $row['updated'];
		}

		if($active == '1'){

			foreach($conn->query("SELECT * FROM plans WHERE id = '$plan_id' ") as $row) {
		    $links_limit	= $row['links_limit'];
				$months				= $row['months'];
		  }

			//DATE PERIOD ACCESS CONTROL
			$new = strtotime($updated);
			$new = date("Y-m-d", strtotime("+$months month", $new));
			$limit_date = $new;
			$today = date("Y-m-d");


			// CLICK LIMIT ACCESS CONTROL
			foreach($conn->query("SELECT SUM(clicks) AS totalclicks FROM links WHERE user_id = '$user_id' ") as $row) {
			  $totalclicks   = $row['totalclicks'];
			}

			//DATE PERIOD ACCESS CONTROL IF CHECK
			if($today > $limit_date){

				$sql =  "UPDATE users SET active = '0' WHERE id = '$user_id' ";
				$query = $conn->prepare($sql);
				$query->execute();

				$access_error = 'Esta conta expirou a data limite.<br> Contrate um novo plano para continuar usando a move.';
				include (PAGES_DIR .'admin/inactive.php');

			// CLICK LIMIT ACCESS CONTROL  IF CHECK
			} elseif($clicks > $limit_date){

				$access_error = 'Esta conta ultrapassou o limite de cliques.<br> Contrate um novo plano para continuar usando a move.';
				include (PAGES_DIR .'admin/inactive.php');

			} else {

				include (PAGES_DIR .'admin/active.php');

			}

		// IF ALREADY INACTIVE
		} elseif($active == '0') {

			$access_error = 'Esta conta está inativa.';
			include (PAGES_DIR .'admin/inactive.php');

		} else {
			include (PAGES_DIR .'admin/active.php');
		}

	}


?>
		</div>
	</main>
</body>
