<?php
//form handling
//check whether the form has been submitted
if(isset($_GET["fullname"],$_GET["course"],$_GET["email"])){
    //pick the form data
    $fullname = $_GET["fullname"];
    $course = $_GET["course"];
    $email = $_GET["email"];
    //display
    echo "<p>Welcome $fullname to $course. <br> Your email is $email <p>";
}
//using post method - $_POST["variable"]
if(isset($_POST["fullname"],$_POST["course"],$_POST["email"])){
    //pick the form data
    $fullname = $_GET["fullname"];
    $course = $_GET["course"];
    $email = $_GET["email"];
     //display
    echo "<h1>$fullname</h1><p>Welcome $fullname to $course. <br> Your email is $email <p>";
}
