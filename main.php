<?php

require_once "utility.php";

if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no">
    <title>Pinguin</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <script src="src/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
    <header id="id_HeaderWrap">
        <img id="id_Logo" src="src/logo.png"/>
    </header>
    <div id="id_NavBar">
        <ul>
            <a href="#About"><li class="c_NavItem">About</li></a>
            <a href="#Contact"><li class="c_NavItem">Contact Us</li></a>
            <a href="#Signup"><li class="c_NavItem">Sign Up</li></a>
        </ul>
    </div>
    <div class="c_Section">
        <a name="About">a</a>
        <h1>About</h1>
        <div>Pinguin It is devoted to help people recover personal items that they lost or return items that they found.</div>
    </div>
    <div class="c_Section">
        <a name="Contact">a</a>
        <h1>Contact Us</h1>
        <div>Pinguin It is founded by <br>Anthony Huang anthuang@umich.edu,<br>Thomas Huang thomaseh@umich.edu,<br>and Anton Yang ayangz@umich.edu</div>
    </div>
    <div class="c_Section">
        <a name="Signup">a</a>
        <h1>Sign Up</h1>
        <form action="main.php" method="post">
            <label>Username</label><input name="username" type="text"></input><br>
            <label>Password</label><input name="password" type="text"></input><br>
            <button>Submit</button>
        </form>
    </div>
</body>
</html>

<?php

mysqli_close($connection);

?>