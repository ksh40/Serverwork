<?php
//connect to bbitgroupb database
$server = "localhost";
$user = "root";
$password = "";
$database = "bbitgroupb";
$connectdb = mysqli_connect($server, $user, $password, $database);
if(!$connectdb){
    die(mysqli_connect_error($connectdb));
}
//mysqli_close($connectdb);