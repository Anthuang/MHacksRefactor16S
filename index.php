<?php

require_once "utility.php";

$array = array();

$result = queryMysql('SELECT * FROM `LongLat`');
$num = $result->num_rows;
if ($num > 0) {
    for ($j = 0; $j < $num; $j++) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $array[] = $row;
    }
}

$json = json_encode($array);

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no">
    <title>Pinguin</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="src/jquery.js"></script>
</head>
<body>
    <header id="id_HeaderWrap">
        <img id="id_Logo" src="src/logo.png"/>
    </header>
    <div id="id_MapDiv"></div>
    <button id="id_UserReq">Make a request</button>
    <form id="id_ReqForm" method="post"><input name="lat" id="id_ReqLat"></input>
    <input name="long" id="id_ReqLng"></input>
    <button id="id_SubmitReq" type="button">Submit</button></form>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdmA9zcBCRDeh7PBXvxbNeTrm6KtaOWaY&callback=initMap"></script>
    <script type="text/javascript" src="js/index.js"></script>
</body>
</html>