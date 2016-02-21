<?php

require_once "utility.php";

$q1 = $q2 = $q3 = $a1 = $a2 = $a3 = "";

// starts a session
session_start();

// check if session with variable username exists
if (!isset($_SESSION['username'])) { // if not, user is not signed in
    die("You are not signed in. Redirecting to Sign In Page 5 seconds... or click " . "<a href='index.php'>here</a>".
        " to go directly.<script>window.onload = function () {setTimeout(function(){location.href='index.php'} , 5000);}</script>");
} else { // else, set variable $username equals to user's account
    $username = $_SESSION['username'];
}

if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['touser']) && !empty($_POST['touser'])) {
	$id = $_POST['id'];
	$touser = $_POST['touser'];
	if (isset($_POST['a1']) && !empty($_POST['a1']) && isset($_POST['a2']) && !empty($_POST['a2']) && isset($_POST['a3']) && !empty($_POST['a3'])) {
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		queryMysql('INSERT INTO `Applications` VALUES (null, "'.$username.'", "'.$touser.'", "'.$id.'", "'.$a1.'", "'.$a2.'", "'.$a3.'", 0, 1)');
	}
	$result = queryMysql('SELECT * FROM `LostAndFound` WHERE `MarkerIdx`="'.$id.'"');
	$num = $result->num_rows;
	if ($num > 0) {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$lat = $row['Latitude'];
		$lng = $row['Longitude'];
		$item = $row['Item'];
		$date = $row['MarkerDate'];
		$time = $row['MarkerTime'];
		$q1 = $row['One'];
		$q2 = $row['Two'];
		$q3 = $row['Three'];
		$found = $row['Found'];

echo <<<_END
<form action="mine.php" method="post">
	Question 1: <input type="text" value="$q1" id="q1"><input type="text" name="a1" value="$a1"><br>
	Question 2: <input type="text" value="$q2" id="q2"><input type="text" name="a2" value="$a2"><br>
	Question 3: <input type="text" value="$q3" id="q3"><input type="text" name="a3" value="$a3"><br>
	<input type="hidden" name="id" value=$id><input type="hidden" name="touser" value=$touser>
	<button>Submit</button>
</form>
_END;

	} else {
		die("Not a valid ID.");
	}
} else {
	die("ID or users not received.");
}

?>

<form action="map.php"><button>Back to Map</button></form>

<?php

mysqli_close($connection);

?>