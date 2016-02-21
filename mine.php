<?php

// starts a session
session_start();

// check if session with variable username exists
if (!isset($_SESSION['username'])) { // if not, user is not signed in
    die("You are not signed in. Redirecting to Sign In Page 5 seconds... or click " . "<a href='index.php'>here</a>".
        " to go directly.<script>window.onload = function () {setTimeout(function(){location.href='index.php'} , 5000);}</script>");
} else { // else, set variable $username equals to user's account
    $username = $_SESSION['username'];
}

if (isset($_POST['id']) && !empty($_POST['id'])) {
	$id = $_POST['id'];
	$result = queryMysql('SELECT * FROM `LostAndFound` WHERE `MarkerIdx`="'.$id.'"');
	$num = $result->num_rows;
	if ($num > 0) {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$lat = $row['lat'];
		$lng = $row['lng'];
		$item = $row['Item'];
		$date = $row['MarkerDate'];
		$time = $row['MarkerTime'];
		$q1 = $row['One'];
		$q2 = $row['Two'];
		$q3 = $row['Three'];
		$found = $row['Found'];
	}
}

?>