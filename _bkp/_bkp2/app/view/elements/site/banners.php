
<div class="linha" align="center">
	<img src="<?=ABSOLUTE_PATH?>app/webroot/img/Bolson_Site-05.png" />
</div>

<style type="text/css">
<?php

$num_banners		= 3;
$tempo				= 8*$num_banners;
$transicao			= 2;
$width				= '100%';
$height				= '450px';
$banner_divs		= '';

for($x = 1; $x < ($num_banners+1); $x++){

	$xx = ($x-1);

	echo '
		.banner'.$x.'{
			width:'.$width.';
			height:'.$height.';
			background-image: url('.ABSOLUTE_PATH.'app/webroot/img/banners/banner'.$x.'.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			background-position:center;
			position:absolute;
			margin:0;
			animation: banner'.$x.' '.$tempo.'s infinite;
			-webkit-animation: banner'.$x.' '.$tempo.'s infinite;

			clip-path: polygon(0 5%, 10% 1%, 33% 0, 46% 0, 56% 1%, 71% 8%, 87% 15%, 100% 30%, 100% 100%, 0 100%);
			-webkit-clip-path: polygon(0 5%, 10% 1%, 33% 0, 46% 0, 56% 1%, 71% 8%, 87% 15%, 100% 30%, 100% 100%, 0 100%);
			-moz-clip-path: polygon(0 5%, 10% 1%, 33% 0, 46% 0, 56% 1%, 71% 8%, 87% 15%, 100% 30%, 100% 100%, 0 100%);
		}

		@keyframes banner'.$x.'{
			0%{ opacity:0;}
			'.((($xx/$num_banners)*100)-$transicao).'%{ opacity:0;}
			'.(($xx/$num_banners)*100).'%{opacity:1;}
			'.(((($xx+1)/$num_banners)*100)-($transicao-1)).'%{opacity:1;}
			'.(((($xx+1)/$num_banners)*100)).'%{opacity:0;}
			100%{opacity:0;}
		}

		@-webkit-keyframes banner'.$x.'{
			0%{ opacity:0;}
			'.((($xx/$num_banners)*100)-$transicao).'%{ opacity:0;}
			'.(($xx/$num_banners)*100).'%{opacity:1;}
			'.(((($xx+1)/$num_banners)*100)-($transicao-1)).'%{opacity:1;}
			'.(((($xx+1)/$num_banners)*100)).'%{opacity:0;}
			100%{opacity:0;}
		}
	';

	$banner_divs .= '<div class="banner'.$x.'">'.$x.'</div>';

}

?>
</style>

<div class="banners">
<?php echo $banner_divs; ?>
</div>

<div class="linha-baixo" align="center">
	<img src="<?=ABSOLUTE_PATH?>app/webroot/img/Bolson_Site-08.png" />
</div>
