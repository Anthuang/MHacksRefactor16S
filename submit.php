<?php

require_once "utility.php";

if (isset($_POST['lat']) && !empty($_POST['lat']) && isset($_POST['long']) && !empty($_POST['long'])) {
	$lat = $_POST['lat'];
	$long = $_POST['long'];
	queryMysql('INSERT INTO `LongLat` VALUES (null, "'.$lat.'", "'.$long.'")');
}

?>