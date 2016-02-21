<?php

require_once "utility.php";

$array = array();

if (isset($_POST['username']) && !empty($_POST['username'])) {
	$user = $_POST['username'];

	$result = queryMysql('SELECT * FROM `LostAndFound` WHERE `User`="'.$user.'"');
	$num = $result->num_rows;
	if ($num > 0) {
	    for ($j = 0; $j < $num; $j++) {
	        $row = $result->fetch_array(MYSQLI_ASSOC);
	        $array[] = $row;
	    }
	}

	$json = json_encode($array, JSON_NUMERIC_CHECK);
	echo $json;
}

?>