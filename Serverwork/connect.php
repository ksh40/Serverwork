<?php
//connect to the mysql server
$server_name = "localhost";
$server_user ="root";
$server_password = "";

//establish connection to the sserver - mysqli_connect()
$connect = mysqli_connect($server_name, $server_user, $server_password);

//check if the connection has started
if($connect){
    echo "Connection successful";
}else{
    echo "Not successful";
    die(mysqli_connect_error());
}
//write a query to create a database
$query = "CREATE DATABASE bbitgroupb";
//execute query - mysqli_query(connection, query)
$query_result = mysqli_query($connect, $query);
if($query_result){
    echo "<br> Database created successfully";
}else{
    echo "<br> Database not created";
}