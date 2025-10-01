<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "wave";
$connectdb = mysqli_connect($server, $user, $password, $database);
if(!$connectdb){
    die(mysqli_connect_error($connectdb));
}
?>