<?php
// database information. please change according to database. will differ
$db_hostname = "localhost";
$db_database = "MHacksRefactor16s";
$db_username = "root";
$db_password = "root";

$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database); // connection to database
if ($connection->connect_error) die($connection->connect_error);

function queryMysql($query) { // function for querying the database
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
}

function queryMysql_link($query, $link) { // function for querying the database with link
    $result = $link->query($query);
    if (!$result) die($link->error);
    return $result;
}

function destroySession() { // function for destroying a session
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

        session_destroy();
}
?>