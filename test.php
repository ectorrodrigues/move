<?php

$api = file_get_contents("http://api.instagram.com/oembed?url=https://www.instagram.com/p/CGA0GsiAbom/");
$apiObj = json_decode($api,true);
$media_id = $apiObj['media_id'];
echo $media_id;

?>
