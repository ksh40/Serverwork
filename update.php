<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1,label{
            text-align: center;
            display:block;
        }
        input,select{
            display: block;
            margin: 5px auto;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Update</h1>
    <?php
    include "connectdb.php";
    //get updatid from url
    $updateid = $_GET["updateid"];
    //write query to select student details
    $query = "SELECT *FROM students WHERE stud_id=$updateid";
    $run_query = mysqli_query($connectdb, $query);
    //check if insert is successful
    if($run_query){
    $student = mysqli_fetch_assoc($run_query);
    $fullname =$student["fullname"];
    $course =$student["course"];
    $email =$student["email"];
    }else{
         die(mysqli_error($connectdb));
    }

    ?>
    <form method="post">
        <input type="text" name="fullname" placeholder="fullname" 
        value="<?php echo $fullname;?>">
        <select name="course">
            <option value="<?php echo $course;?>">--select course</option>
            <option>ICS</option>
            <option>BBIT</option>
            <option>CNS</option>
        </select>  
        <input type="email" name="email" placeholder="Enter email" 
        value="<?php echo $email;?>>
        <input type="submit" name="update" placeholder="update">
        <?php
        
      
        //check if the user has submitted the form
        if($_SERVER['REQUEST_METHOD']=="POST"){
            //pick the data user enters
            $fullname = $_POST["fullname"];
            $course = $_POST["course"];
            $email = $_POST["email"];
            //query to insert
            $query = "UPDATE students SET fullname="$fullname",
             course="$course", email="$email" WHERE stud_id="$updateid"";
            //query the db
            $run_query = mysqli_query($connectdb, $query);
            //check if insert is successful
            if($run_query){
            header("location:displaystud.php");
            }else{
               die(mysqli_error($connectdb));
            }
        }

        ?>
    </form>
</body>
</html>