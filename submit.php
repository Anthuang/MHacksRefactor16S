<?php

require_once "utility.php";

if (isset($_POST['lat']) && !empty($_POST['lat']) && isset($_POST['lng']) && !empty($_POST['lng'])) {
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	queryMysql('INSERT INTO `LongLat` VALUES (null, "'.$user.'", "'.$lat.'", "'.$lng.'")');
	echo mysqli_insert_id($connection);
}

?>