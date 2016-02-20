<?php

require_once "utility.php";

if (isset($_POST['is_signup']) && !empty($_POST['is_signup'])) {
    if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = queryMysql('SELECT * FROM `Users` WHERE `Username`="'.$username.'"');
        $num = $result->num_rows;
        if ($num < 1) {
            queryMysql('INSERT INTO `Users` VALUES (null, "'.$username.'",'.$password.')');
        } else {
            die('<a href="index.php">Invalid input. Go back.</a>');
        }
    } else { // input fields not filled out
        die('<a href="index.php">Invalid input. Go back.</a>');
    }
} else if (isset($_POST['is_signin']) && !empty($_POST['is_signin'])) {
    if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = queryMysql('SELECT * FROM `Users` WHERE `Username`="'.$username.'"');
        $num = $result->num_rows;
        if ($num == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if ($password == $row['Password']) {
                session_start();
                $_SESSION['username'] = $username;
                echo "Sign in successful. Redirecting to Main Page in 5 seconds... or click " . "<a href='map.php'>here</a>". " to go directly.";
                echo "<script>window.onload = function () {setTimeout(function(){location.href='map.php'} , 5000);}</script>";
                die();
            } else { // password is wrong
                die('<a href="index.php">Combination incorrect. Go back.</a>');
            }
        } else { // username does not exist
            die('<a href="index.php">Combination incorrect. Go back.</a>');
        }
    } else { // input fields not filled out
        die('<a href="index.php">Invalid input. Go back.</a>');
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no">
    <title>Pinguin</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <script src="src/jquery.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>
    <header id="id_HeaderWrap">
        <img id="id_Logo" src="src/logo.png"/>
    </header>
    <div id="id_NavBar">
        <ul>
            <a href="#About"><li class="c_NavItem">About</li></a>
            <a href="#Contact"><li class="c_NavItem">Contact Us</li></a>
            <a href="#Signup"><li class="c_NavItem">Sign Up/Sign In</li></a>
        </ul>
    </div>
    <div class="c_Section">
        <a name="About">a</a>
        <h1>About</h1>
        <div>Pinguin It is devoted to assist people in recovering or returning personal belongings that they either lost or found. We aim to provide a platform where people can
         find their precious possessions easily, without having to resort to Facebook or Twitter. We provide a fast, secure, and reliable network, all to shorten the distance 
         people and their lost belongings.</div>
    </div>
    <div class="c_Section">
        <a name="Contact">a</a>
        <h1>Contact Us</h1>
        <div>Pinguin It is founded by <br>Anthony Huang anthuang@umich.edu,<br>Thomas Huang thomaseh@umich.edu,<br>and Anton Yang ayangz@umich.edu.<br>
        Contact us if you have any questions or suggestions!</div>
    </div>
    <div class="c_Section">
        <div class="c_UserSection">
            <a name="Signup">a</a>
            <h1>Sign Up</h1>
            <form action="index.php" method="post">
                <label>Username</label><input name="username" type="text"></input><br>
                <label>Password</label><input name="password" type="password"></input><br>
                <input type="hidden" name="is_signup" value="1">
                <button>Register</button>
            </form>
        </div>
        <div class="c_UserSection">
            <h1>Sign In</h1>
            <form action="index.php" method="post">
                <label>Username</label><input name="username" type="text"></input><br>
                <label>Password</label><input name="password" type="password"></input><br>
                <input type="hidden" name="is_signin" value="1">
                <button>Log In</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php

mysqli_close($connection);

?>