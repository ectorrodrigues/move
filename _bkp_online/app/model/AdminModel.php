<?php


//------------- INIT ---------------------------------------------------------------------------------------

	include ('../config/directories.php');
	include ('../config/database.php');


	$array_galleries = array('portfolio', 'noticias'); // Here we tell the pages that will have some gallery within

	$action	= $_GET['action'];
	$table	= $_GET['id'];
	$item 	= $_GET['item'];

	$conn = db();

	foreach($conn->query("SELECT title FROM cms WHERE id = '".$table."' ") as $row) {
		$table		= $row['title'];
	}


//------------- ADD -------------------------------------------------------------------------------------------------

	if($action == 'add'){

		$query = $conn->prepare("DESCRIBE ".$table);
		$query->execute();
		$table_fields = $query->fetchAll(PDO::FETCH_COLUMN);

		$columns		= '';
		$columns_val	= '';

		foreach($table_fields as $field) {

			if($field == "id"){
				$columns .= '';
			}
			else{
				$columns .= $field.', ';
			}

			if($field !== "img") {
				$field = $_POST[$field];
			}
			else{
				$file		= $_FILES[$field]['name'];
				$datename = date('Y-m-d-h-m-s');
				$img		= $datename.'-'.$file;


				$_UP['folder']	= '../webroot/img/'.$table.'/';
				move_uploaded_file($_FILES['img']['tmp_name'], $_UP['folder'] . $img);

				include ('../../app/vendor/rosell-dk/webp-convert/webpconvert.php');

			}


			if($columns == ""){
				$columns_val	.= '';
			}
			else{

				if(!empty($img)){
					$columns_val	.= " '".$img."', ";
					$img = '';
				} else {
					$columns_val	.= " '".$field."', ";
				}

			}
		}


		$query 	= $conn->prepare("SELECT id FROM cms WHERE title = '".$table."'");
		$query->execute();
		$id_category = $query->fetchColumn();

		$sql = 'INSERT INTO '.$table.' ('.substr($columns, 0, -2).') VALUES ('.substr($columns_val, 0, -2).')' ;
		$query = $conn->prepare($sql);
		$query->execute();

		$query 	= $conn->prepare("SELECT id FROM ".$table." ORDER BY ID DESC LIMIT 1");
		$query->execute();
		$id_last = $query->fetchColumn();

		$id_last_new = ($id_last+1);

		if(!empty($_FILES['filesToUpload']['tmp_name'][0])){

			if(in_array($table, $array_galleries, TRUE)){

				$i = 0;

				foreach ($_FILES['filesToUpload']['name'] as $fileimg) {

					$fileimgname = uniqid().$fileimg;
					$_UP['folder']	= '../webroot/img/'.$table.'/';

					move_uploaded_file($_FILES['filesToUpload']['tmp_name'][$i], $_UP['folder'] . $fileimgname);


					$query 	= $conn->prepare("INSERT INTO ".$table."_gallery (title, img, id_".$table.") VALUES ( '".$fileimgname."', '".$fileimgname."', '".$id_last."')");
					$query->execute();

					include ('../../app/vendor/rosell-dk/webp-convert/webpconvert.php');

					$i++;
				}




			}

		}


	}


//------------- EDIT -------------------------------------------------------------------------------------------------

	elseif($action == 'edit'){

		$columns		= '';
		$columns_val	= '';

		$query = $conn->prepare("DESCRIBE ".$table);
		$query->execute();
		$table_fields = $query->fetchAll(PDO::FETCH_COLUMN);

		foreach($table_fields as $field) {

			if($field == "id"){
				$id		 = $_POST[$field];
				$field   = '';
				$columns = '';
			}

			elseif($field == "img" OR $field == "icone"){

				if(empty($_FILES[$field]['tmp_name'][0])){

					$columns = '';
					$field   = '';
					$columns_val	.= '';

				}else{

					$file		= $_FILES[$field]['name'];
					$img		= uniqid().$file;

					$_UP['folder']	= IMG_REL_DIR . $table . DS;
					move_uploaded_file($_FILES[$field]['tmp_name'], $_UP['folder'] . $img);
					include ('../../app/vendor/rosell-dk/webp-convert/webpconvert.php');

					$columns_val	.= $field." = '".$img."', ";
				}

			} else {

				$columns = $field;
				$field = $_POST[$field];

				if($columns == ""){
					$columns_val	.= '';
				} else{
					$columns_val		.= $columns." = '".$field."', ";
				}
			}

		}

		$query 	= $conn->prepare("SELECT id FROM cms WHERE title = '".$table."'");
		$query->execute();
		$id_category = $query->fetchColumn();

		$sql = 'UPDATE '.$table.' SET '.substr($columns_val, 0, -2)." WHERE id = '".$id."'";
		$query = $conn->prepare($sql);
		$query->execute();

		$conn=null;

		if(!empty($_FILES['filesToUpload']['tmp_name'][0])){

			require (CONFIG_REL_DIR . 'database.php');

			$query 	= $conn->prepare("SELECT id FROM ".$table." ORDER BY ID DESC LIMIT 1");
			$query->execute();
			$id_last = $query->fetchColumn();

			if(in_array($table, $array_galleries, TRUE)){

				$i = 0;

				foreach ($_FILES['filesToUpload']['name'] as $fileimg) {

					$fileimgname = uniqid().$fileimg;

					move_uploaded_file($_FILES['filesToUpload']['tmp_name'][$i], ABSOLUTE_PATH . $table . DS . $fileimgname);


					$query 	= $conn->prepare("INSERT INTO ".$table."_gallery (id_".$table.", title, img) VALUES ('".$id."', '".$fileimgname."', '".$fileimgname."')");
					$query->execute();

					include ('../../app/vendor/rosell-dk/webp-convert/webpconvert.php');

					$i++;
				}

			}

		}

	}


//------------- DELETE -------------------------------------------------------------------------------------------------


	elseif($action == 'delete'){

		$query 	= $conn->prepare("DELETE FROM ".$table." WHERE id = ".$item."");
		$query->execute();

	}


//------------- GALLERY -------------------------------------------------------------------------------------------------


	elseif($action == 'gallery'){

		$query 	= $conn->prepare("DELETE FROM ".$table."_gallery WHERE id = ".$item."");
		$query->execute();

	}



//------------- CLOSE CONN AND REDIRECT ---------------------------------------------------------------------------------------

	$conn=null;


	header('Location:'. SERVER_DIR . ADMIN . $_GET['id']);

?>
