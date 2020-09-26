<?php include 'http://localhost:8888/move/app/view/elements/site/head.php' ?>

<body>

	<main>
		<div class="container-fluid">

      <div class="row justify-content-center py-5">
				<div class="col-12">
					<h1>move</h1>
				</div>
			</div>

			<div class="row justify-content-center py-5">
				<div class="col-10 text-center">
          <?php

          	include 'db.php';
            $conn = db();

          	$socialmedia = $_POST['socialmedia'];
          	$link = $_POST['link'];
          	$code = uniqid();

            $query  = $conn->prepare("INSERT INTO links (link, socialmedia, code) VALUES (:link, :socialmedia, :code)");
            $query->bindParam(':socialmedia', $socialmedia);
            $query->bindParam(':code', $code);


            // INSTAGRAM HANDLING ------------------- *********** ------------------
            if($socialmedia == 'instagram'){

              $query->bindParam(':link', $link);

            }
            // FACEBOOK HANDLING ------------------- *********** ------------------
            elseif($socialmedia == 'facebook'){

              include "dom.php";
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
              $query->bindParam(':link', $id);

            }

            $query->execute();

            echo '
             <label for="link" class="mt-5 pt-5">Copie o código abaixo</label>
             <input type="text" id="link" name="link" class="form-control mt-5" value="http://mova.ppg.br/move/result.php?link='.$code.'">
            ';

          ?>
          <button onclick="copylink()" class="mt-5"><i class="far fa-clone"></i> Copiar Link</button>

				</div>
			</div>
		</div>
	</main>

  <script>
  function copylink() {
    var copyText = document.getElementById("link");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Link Copiado: " + copyText.value);
  }
  </script>

</body>
