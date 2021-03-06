<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no">
    <link rel="shortcut icon" href="src/logowithouttext.png" />
    <link type = "text/css" rel = "stylesheet" href = "css/list.css" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <title>Pinguin - List</title>
    <script src="src/jquery.js"></script>
    <script src="js/list.js"></script>
</head>
<body>
<header id="id_HeaderWrap">
        <a href="index.php"><img id="id_Logo" src="src/logo.png"/></a>
    </header>
    <div id="id_NavBar">
        <ul>
            <a href="map.php"><li class="c_NavItem">Map</li></a>
        </ul>
    </div>
<div id="right"><a href="#"><button id="back2top">TOP</button></a></div>
<form action="list.php" method="post">
	<label>Ordering: </label><select name="selector">
	  <option value="MarkerIdx">ID</option>
	  <option value="MarkerDate">Date</option>
	  <option value="MarkerTime">Time</option>
	</select>
	<button>Enter</button>
</form>

<!-- <?php

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

$orderby = "MarkerIdx"; // default

if (isset($_POST['selector']) && !empty($_POST['selector'])) $orderby = $_POST['selector'];
$result = queryMysql('SELECT * FROM `LostAndFound` ORDER BY `'.$orderby.'`');
$num = $result->num_rows;
if ($num > 0) {
	for ($j = 0; $j < $num; $j++) {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$id = $row['MarkerIdx'];
		$user = $row['User'];
		$item = $row['Item'];
		$lat = $row['Latitude'];
		$lng = $row['Longitude'];
		$date = $row['MarkerDate'];
		$time = $row['MarkerTime'];
		$one = $row['One'];
		$two = $row['Two'];
		$three = $row['Three'];
		$found = $row['Found'];
		if ($found) {
			if ($username == $user) {
				echo '<br><ul class="itemList">'.'<li class="class_ListID" value="'.$id.'">'.$id.'. '.$item.'</li>'.'<li class="class_ListLat">'.$lat.'</li><li class="class_ListLng">'.$lng.'</li>'.'<li>'.$date.' '.$time.'</li>'.'<li>Question 1: '.$one.'</li>'.'<li>Question 2: '.$two.'</li>'.'<li>Question 3: '.$three.'</li><li>Item Found by You</li><li><button class="class_EditButton" value=1>Edit this entry</button></li></ul>';
			} else {
				echo '<br><ul class="itemList">'.'<li class="class_ListID" value="'.$id.'">'.$id.'. '.$item.'</li>'.'<li class="class_ListLat">'.$lat.'</li><li class="class_ListLng">'.$lng.'</li>'.'<li>'.$date.' '.$time.'</li>'.'<li>Question 1: '.$one.'</li>'.'<li>Question 2: '.$two.'</li>'.'<li>Question 3: '.$three.'</li><li>Item Found by '.$user.'</li><li><button class="class_EditMine" value=1>This is mine.</button></li></ul>';
			}
		}
		else {
			if ($username == $user) {
				echo '<br><ul class="itemList">'.'<li class="class_ListID" value="'.$id.'">'.$id.'. '.$item.'</li>'.'<li class="class_ListLat">'.$lat.'</li><li class="class_ListLng">'.$lng.'</li>'.'<li>'.$date.' '.$time.'</li>'.'<li>Fact 1: '.$one.'</li>'.'<li>Fact 2: '.$two.'</li>'.'<li>Fact 3: '.$three.'</li><li>Item Lost by You</li><li><button class="class_EditButton" value=0>Edit this entry</button></li></ul>';
			} else {
				echo '<br><ul class="itemList">'.'<li class="class_ListID" value="'.$id.'">'.$id.'. '.$item.'</li>'.'<li class="class_ListLat">'.$lat.'</li><li class="class_ListLng">'.$lng.'</li>'.'<li>'.$date.' '.$time.'</li>'.'<li>Fact 1: '.$one.'</li>'.'<li>Fact 2: '.$two.'</li>'.'<li>Fact 3: '.$three.'</li><li>Item Lost by '.$user.'</li><li><button class="class_EditHave" value=0>I have it.</button></li></ul>';
			}
		}
	}
}

?> -->

<form id="id_ListForm" action="found.php" method="post">
    <input type="hidden" name="lat" id="id_ReqLat">
    <input type="hidden" name="lng" id="id_ReqLng">
    <input type="hidden" name="id" id="id_ID">
    <input type="hidden" name="username" value=<?php echo $username; ?>>
</form>

<form action="index.php"><button id="main">Back to Main Page</button></form>

</body>
</html>

<?php

mysqli_close($connection);

?>