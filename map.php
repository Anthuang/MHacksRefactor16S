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

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no">
    <title>Pinguin</title>
    <link rel="stylesheet" type="text/css" href="css/map.css">
    <script src="src/jquery.js"></script>
</head>
<body>
    <header id="id_HeaderWrap">
        <a href="index.php"><img id="id_Logo" src="src/logo.png"/></a>
    </header>
    <div id="id_MapDiv"></div>
    <button id="id_UserReq" disabled="true">Make a request</button>
    <form id="id_ReqForm" action="found.php" method="post">
        <div id="id_ReqWrap">
            <label>Latitude:</label><input type="text" placeholder="Latitude" name="lat" id="id_ReqLat"></input>
            <label>Longitude:</label><input type="text" placeholder="Longitude" name="lng" id="id_ReqLng"></input>
            <div id="id_RadioWrap">
                <label>Lost: </label><input id="id_RadLost" type="radio" name="status" value="Lost" checked>
                <label>Found: </label><input id="id_RadFound" type="radio" name="status" value="Found">
            </div>
            <input type="hidden" id="id_ID" name="id">
            <input type="hidden" name="username" id="username" value=<?php echo $username; ?>>
            <button id="id_MapQuit">Return</button>
        </div>
        <button id="id_SubmitReq" type="button">Submit</button>
    </form>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdmA9zcBCRDeh7PBXvxbNeTrm6KtaOWaY&callback=initMap"></script>
    <script type="text/javascript" src="js/map.js"></script>
</body>
</html>