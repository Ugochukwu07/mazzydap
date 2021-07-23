<?php

$host = HOST;
$user = DB_USER;
$pass = DB_PASS;
$db_name = DB_NAME;

$conn = new mySQLi($host, $user, $pass, $db_name);

if($conn->connect_error){
    die('Database Connection Erorr: ' . $conn->connect_error );
}
?>