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
    <form id="id_ReqForm" action="found.php" method="post">
        <div id="id_ReqWrap">
            <input type="text" placeholder="Latitude" name="lat" id="id_ReqLat"></input>
            <input type="text" placeholder="Longitude" name="lng" id="id_ReqLng"></input>
            <label>Lost: </label><input id="id_RadLost" type="radio" name="status" value="Lost" checked>
            <label>Found: </label><input id="id_RadFound" type="radio" name="status" value="Found">
            <input type="hidden" id="id_ID" name="id">
        </div>
        <button id="id_SubmitReq" type="button">Submit</button>
    </form>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdmA9zcBCRDeh7PBXvxbNeTrm6KtaOWaY&callback=initMap"></script>
    <script type="text/javascript" src="js/index.js"></script>
</body>
</html>