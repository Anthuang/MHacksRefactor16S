<?php

require_once "utility.php";

// starts a session
session_start();

// check if session with variable username exists
if (!isset($_SESSION['username'])) { // if not, user is not signed in
    die("You are not signed in. Redirecting to Sign In Page 5 seconds... or click " . "<a href='index.php'>here</a>". 
        " to go directly.<script>window.onload = function () {setTimeout(function(){location.href='index.php'} , 5000);}</script>");
} else { // else, set variable $username equals to user's account
    $username = $_SESSION['username'];
}

$lat = $lng = $item = $date = $time = $f1 = $f2 = $f3 = $lost = $id = $user = $message = "";

if (isset($_POST['lat']) && !empty($_POST['lat']) && isset($_POST['lng']) && !empty($_POST['lng']) && isset($_POST['id']) && !empty($_POST['id']) && 
	isset($_POST['username']) && !empty($_POST['username'])) {

	$user = $_POST['username'];
	$id = $_POST['id'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];

	if (isset($_POST['item']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['f1']) && isset($_POST['f2']) && 
		isset($_POST['f3']) && isset($_POST['lost'])) {

		$item = $_POST['item'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$f1 = $_POST['f1'];
		$f2 = $_POST['f2'];
		$f3 = $_POST['f3'];
		$lost = $_POST['lost'];
		$result = queryMysql('SELECT * FROM `LostAndFound` WHERE `MarkerIdx`='.$id);
		$num = $result->num_rows;
		if ($num != 0) {
			queryMysql('DELETE FROM `LostAndFound` WHERE `MarkerIdx`='.$id);
		}
		queryMysql('INSERT INTO `LostAndFound` VALUES ("'.$id.'", "'.$user.'", "'.$item.'", "'.$lat.'", "'.$lng.'", "'.$date.'", "'.$time.'", "'.$f1.'", "'.$f2.'", "'.$f3.'", "'.!$lost.'")');
		$message = "Success!";
	} else if (isset($_POST['lost']) && !empty($_POST['lost'])) {
		$result = queryMysql('SELECT * FROM `LongLat` WHERE `Idx`='.$id);
		$num = $result->num_rows;
		if ($num > 0) {
			queryMysql('DELETE FROM `LongLat` WHERE `Idx`='.$id);
		}
		echo "<script>window.onload = function () {setTimeout(function(){location.href='map.php'} , 0);}</script>";
		die();
	}
} else if (isset($_POST['id']) && !empty($_POST['id'])) {
	$result = queryMysql('SELECT * FROM `LongLat` WHERE `Idx`='.$id);
	$num = $result->num_rows;
	if ($num > 0) {
		queryMysql('DELETE FROM `LongLat` WHERE `Idx`='.$id);
	}
	echo "<script>window.onload = function () {setTimeout(function(){location.href='map.php'} , 0);}</script>";
	die();
} else {
	echo "<script>window.onload = function () {setTimeout(function(){location.href='map.php'} , 0);}</script>";
	die();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no">
    <script src="src/jquery.js"></script>
</head>
<body>
	<form action="lost.php" id="id_LostForm" method="post">
	    <label>Item: </label><input type="text" placeholder="Item" maxlength="32" name="item" value=<?php echo $item; ?>></input><br>
	    <label>Latitude: </label><input type="text" placeholder="Latitude" name="lat" value=<?php echo $lat; ?>></input>
	    <label>Longitude: </label><input type="text" placeholder="Longitude" name="lng" value=<?php echo $lng; ?>></input><br>
	    <label>Date: </label><input type="text" placeholder="MM/DD/YYYY" maxlength="10" name="date" value=<?php echo $date; ?>></input>
	    <label>Time: </label><input type="text" placeholder="HH:MM" maxlength="5" name="time" value=<?php echo $time; ?>></input><br>
	    Create three facts about the item (make it specific!):<br>
	    <label>Fact 1: </label><input type="text" placeholder="Fact 1" maxlength="128" name="f1" value=<?php echo $f1; ?>></input><br>
	    <label>Fact 2: </label><input type="text" placeholder="Fact 2" maxlength="128" name="f2" value=<?php echo $f2; ?>></input><br>
	    <label>Fact 3: </label><input type="text" placeholder="Fact 3" maxlength="128" name="f3" value=<?php echo $f3; ?>></input><br>
	    <input type="hidden" name="id" value=<?php echo $id; ?>>
	    <input type="hidden" name="lost" value="1">
	    <input type="hidden" name="username" value=<?php echo $user; ?>>
	    <button>Submit</button>
	</form>
	<div id="id_SucMes"><?php echo $message; ?></div>
</body>
</html>

<?php

mysqli_close($connection);

?>