<?php
	require (ELEMENTS_DIR .'head.php');
?>

<body class="movement_bg">

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WTGRPX7"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<?php
		// CONSTRUCTIONG TOP
		if(empty($page)){ $pagetop = 'home'; } else { $pagetop 	= $_GET['page']; }
		construct_page($pagetop, 'top.php');
	?>

	<main>
		<?php
			// CONSTRUCTIONG BODY
			$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			if(empty($page)){
				$page = 'home';
				$archive = 'index.php';
				construct_page($page, $archive);
			} else {
				$page 	= $_GET['page'];
				if(strpos($url, "/item/") == false){
					$archive = 'index.php';
					construct_page($page, $archive);
				}else{
					$id 	= $_GET['id'];
					$archive = 'item.php';
					construct_page($page, $archive);
				}
			}
		?>
	</main>

	<?php
		// CONSTRUCTIONG FOOTER
		if(empty($page)){ $pagetop = 'home'; } else { $pagetop 	= $_GET['page']; }
		construct_page($pagetop, 'footer.php');
	?>

</body>
