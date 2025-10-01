<?php
// Delete operation
// Connect to bbitgroupb Database
include "connectdb.php";

// get the deleteid from the URL
$delete_id = $_GET["deleteid"];

// Write query to delete the student
$query = "DELETE FROM students WHERE stud_id = $delete_id";
$run_query = mysqli_query($connectdb, $query);
//check if insert is successful
if($run_query){
header("location:displaystud.php");
}else{
   die(mysqli_error($connectdb));
}
?>