<?php

require_once "utility.php";

$lat = $lng = $item = $date = $time = $q1 = $q2 = $q3 = $found = $id = "";

if (isset($_POST['lat']) && !empty($_POST['lat']) && isset($_POST['lng']) && !empty($_POST['lng']) &&
	isset($_POST['id']) && !empty($_POST['id'])) {

	$id = $_POST['id'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];

	if (isset($_POST['item']) && !empty($_POST['item']) && isset($_POST['date']) && !empty($_POST['date']) &&
		isset($_POST['time']) && !empty($_POST['time']) && isset($_POST['q1']) && !empty($_POST['q1']) &&
		isset($_POST['q2']) && !empty($_POST['q2']) && isset($_POST['q3']) && !empty($_POST['q3']) &&
		isset($_POST['found']) && !empty($_POST['found']) && isset($_POST['id']) && !empty($_POST['id'])) {

		$item = $_POST['item'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$q1 = $_POST['q1'];
		$q2 = $_POST['q2'];
		$q3 = $_POST['q3'];
		$found = $_POST['found'];
		$id = $_POST['id'];
		queryMysql('INSERT INTO `LostAndFound` VALUES ("'.$id.'", "'.$item.'", "'.$lat.'", "'.$lng.'", "'.$date.'", "'.$time.'", "'.$q1.'", "'.$q2.'", "'.$q3.'", "'.$found.'")');
	}
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
	<form action="found.php" id="id_FoundForm" method="post">
	    <label>Item: </label><input type="text" placeholder="Item" maxlength="32" name="item" value=<?php echo $item; ?>></input><br>
	    <label>Latitude: </label><input type="text" placeholder="Latitude" name="lat" value=<?php echo $lat; ?>></input>
	    <label>Longitude: </label><input type="text" placeholder="Longitude" name="lng" value=<?php echo $lng; ?>></input><br>
	    <label>Date: </label><input type="text" placeholder="MM/DD/YYYY" maxlength="10" name="date" value=<?php echo $date; ?>></input>
	    <label>Time: </label><input type="text" placeholder="HH/MM" maxlength="5" name="time" value=<?php echo $time; ?>></input><br>
	    Create three questions about the item (make it specific!):<br>
	    <label>Question 1: </label><input type="text" placeholder="Question 1" maxlength="128" name="q1" value=<?php echo $q1; ?>></input><br>
	    <label>Quesiton 2: </label><input type="text" placeholder="Question 2" maxlength="128" name="q2" value=<?php echo $q2; ?>></input><br>
	    <label>Question 3: </label><input type="text" placeholder="Question 3" maxlength="128" name="q3" value=<?php echo $q3; ?>></input><br>
	    <input type="hidden" name="id" value=<?php echo $id; ?>>
	    <input type="hidden" name="found" value="1">
	    <button>Submit</button>
	</form>
</body>
</html>