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

?>

<p> Pending Applications </p>

<?php

if (isset($_POST['acceptance']) && isset($_POST['app_id']) && isset($_POST['marker_num'])) {
	$decision = $_POST['acceptance'];
	$app_id = $_POST['app_id'];
	$marker = $_POST['marker_num'];
	$result = queryMysql('SELECT * FROM `Applications` WHERE `AppID`="'.$app_id.'"');
	$num = $result->num_rows;
	if ($num > 0) {
		queryMysql('UPDATE `Applications` SET `Pending`=0 WHERE `AppID`="'.$app_id.'"');
	}
	if ($decision) {
		queryMysql('UPDATE `Applications` SET `Approved`=1 WHERE `AppID`="'.$app_id.'"');
		$result2 = queryMysql('SELECT * FROM `LostAndFound` WHERE `MarkerIdx`="'.$id.'"');
		$num2 = $result2->num_rows;
		if ($num2 > 0) {
			queryMysql('DELETE FROM `LostAndFound` WHERE `MarkerIdx`="'.$id.'"');
		}
	}
}

$result = queryMysql('SELECT * FROM `Applications` WHERE `ToUser`="'.$username.'" AND `Pending`=1');
$num = $result->num_rows;
if ($num > 0) {
	for ($j = 0; $j < $num; $j++) {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$app_id = $row['AppID'];
		$marker_num = $row['MarkerIdx'];
		$a1 = $row['One'];
		$a2 = $row['Two'];
		$a3 = $row['Three'];

		$result2 = queryMysql('SELECT * FROM `LostAndFound` WHERE `MarkerIdx`="'.$marker_num.'"');
		$num2 = $result2->num_rows;
		if ($num2 > 0) {
			$row2 = $result2->fetch_array(MYSQLI_ASSOC);
			$q1 = $row2['One'];
			$q2 = $row2['Two'];
			$q3 = $row2['Three'];

echo <<<_END

Question 1: <input type="text" value=$q1 id="q1" readonly="readonly"><input type="text" name="a1" value=$a1 readonly="readonly"><br>
Question 2: <input type="text" value=$q2 id="q2" readonly="readonly"><input type="text" name="a2" value=$a2 readonly="readonly"><br>
Question 3: <input type="text" value=$q3 id="q3" readonly="readonly"><input type="text" name="a3" value=$a3 readonly="readonly"><br>
<form action="apps.php" method="post">
	<input type="radio" name="acceptance" value=1>Accept<input type="radio" name="acceptance" value=0>Reject<label><br>If rejected, please state reason: </label><input type="text" name="reason"><br><button>Submit</button>
	<input type="hidden" name="app_id" value=$app_id><input type="hidden" name="marker_num" value=$marker_num>
</form>

_END;

		} else {
			die("Marker ID does not exist.");
		}
	}
} else {
	echo "No pending applications";
}

?>
<br><br>
<p>Finished Applications</p>

<?php

$result2 = queryMysql('SELECT * FROM `Applications` WHERE `ToUser`="'.$username.'" AND `Pending`=0');
$num2 = $result2->num_rows;
if ($num2 > 0) {
	for ($j = 0; $j < $num2; $j++) {
		$row2 = $result2->fetch_array(MYSQLI_ASSOC);
		$app_id = $row2['AppID'];
		$marker_num = $row2['MarkerIdx'];
		$a1 = $row2['One'];
		$a2 = $row2['Two'];
		$a3 = $row2['Three'];
		$approved = $row2['Approved'];
		$reason = $row2['Reason'];

		$result3 = queryMysql('SELECT * FROM `LostAndFound` WHERE `MarkerIdx`="'.$marker_num.'"');
		$num3 = $result2->num_rows;
		if ($num3 > 0) {
			$row3 = $result3->fetch_array(MYSQLI_ASSOC);
			$q1 = $row3['One'];
			$q2 = $row3['Two'];
			$q3 = $row3['Three'];

echo <<<_END

Question 1: <input type="text" value=$q1 id="q1" readonly="readonly"><input type="text" name="a1" value=$a1 readonly="readonly"><br>
Question 2: <input type="text" value=$q2 id="q2" readonly="readonly"><input type="text" name="a2" value=$a2 readonly="readonly"><br>
Question 3: <input type="text" value=$q3 id="q3" readonly="readonly"><input type="text" name="a3" value=$a3 readonly="readonly"><br>
<form action="apps.php" method="post">

_END;

if ($approved) {
	echo '<p>Accepted</p>';
} else {
	echo '<p>Rejected</p><p>Reason: '.$reason.'</p><br>';
}

echo <<<_END
	<input type="hidden" name="app_id" value=$app_id><input type="hidden" name="marker_num" value=$marker_num>
</form>
_END;

		} else {
			die("Marker ID does not exist.");
		}
	}
} else {
	echo "No finished applications";
}

mysqli_close($connection);

?>