<?php
$host ="localhost";
$user ="root";
$password ="";
$database ="user_db";
$port = 3309;

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error){
    die("connecton failed: ". $conn->connect_error);
}
?>