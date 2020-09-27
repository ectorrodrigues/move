
				<div class="col-lg-6 col-10 text-center">
          <?php

						include ('../config/database.php');
						include ('../config/directories.php');


						function slug($str){
							$slug = array( ' '=>'-', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b' );
							$slug = strtolower(strtr( $str, $slug ));
							return $slug;
						} //endfunction

          	$socialmedia = $_POST['socialmedia'];
          	$link = $_POST['link'];
          	$code = uniqid();
						$title = $_POST['title'];
						$title = slug($title);
						$user_id = $_POST['user'];
						$created = date('Y-m-d');

						$conn = db();
            $query  = $conn->prepare("INSERT INTO links (title, link, socialmedia, code, user_id, created) VALUES (:title, :link, :socialmedia, :code, :user_id, :created)");
						$query->bindParam(':title', $title);
						$query->bindParam(':socialmedia', $socialmedia);
						$query->bindParam(':code', $code);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':created', $created);





            // INSTAGRAM HANDLING ------------------- *********** ------------------
            if($socialmedia == 'instagram'){

							if(strpos($link, 'instagram.com') == false){
								$query->bindParam(':link', $link);
							}else{
								$link_exploded = explode('/', $link);
								$link_exploded = $link_exploded[3];
								$link = $link_exploded;
								echo $link.'<br>';
							}

            }
            // FACEBOOK HANDLING ------------------- *********** ------------------
            elseif($socialmedia == 'facebook'){


							if(strpos($link, '/photos/a') == false){

								if(strpos($link, 'facebook.com') == false){
									$link = 'https://www.facebook.com/'.$link;
								}

								include ('../model/dom.php');
	              $url = $link;
	              $opts = array(
	                  'http'=>array(
	                      'header'=>"User-Agent:    Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6\r\n"
	                  )
	              );
	              $context = stream_context_create($opts);
	              $html = file_get_html($url , false, $context);
	              $metas = $html->find('meta');

	              foreach ($metas as $meta){
	                  $id = $meta->content;
	                  if(is_string($id)){
	                      if($id[0]=='f' && $id[1]=='b'){
	                          $id = preg_replace('/[^0-9.]/','',$id);
	                          break;
	                      }
	                  }
	              }
								$link = $id;

							} else {
								$link_exploded = explode('/', $link);
								$link_exploded = $link_exploded[6];
								$link = $link_exploded;
							}

            }

						$query->bindParam(':link', $link);
            $query->execute();

						$query  = $conn->prepare("SELECT username FROM users WHERE id = '$user_id' ");
						$query->execute();
						$username = $query->fetchColumn();

            echo '
             <label for="link" class="mt-5">Copie o código abaixo</label>
             <input type="text" id="link" name="link" class="form-control mt-5" value="'.ABSOLUTE_PATH.'dl/'.$username.'/'.$title.'">
            ';

          ?>

          <button onclick="copylink()" class="btn mt-5"><i class="far fa-clone"></i> Copiar Link</button>

				</div>

  <script>
  function copylink() {
    var copyText = document.getElementById("link");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Link Copiado: " + copyText.value);
  }
  </script>
