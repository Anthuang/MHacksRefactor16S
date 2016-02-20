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

// destroys current session
destroySession();

// prints message and then redirect to sign in page
echo "Sign out successful. Redirecting to Sign In Page in 5 seconds... or click " . "<a href='index.php'>here</a>". " to go directly.";
echo "<script>window.onload = function () {setTimeout(function(){location.href='index.php'} , 5000);}</script>";

?>