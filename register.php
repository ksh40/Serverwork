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
    <h1>Register</h1>
    <form method="post">
        <input type="text" name="fullname" placeholder="fullname">
        <select name="course">
            <option>--select course</option>
            <option>ICS</option>
            <option>BBIT</option>
            <option>CNS</option>
        </select>  
        <input type="email" name="email" placeholder="Enter email">
        <input type="submit" name="register" placeholder="register">
        <?php
        include "connectdb.php";
        //check if the user has submitted the form
        if(isset($_POST["register"])){
            //pick the data user enters
            $fullname = $_POST["fullname"];
            $course = $_POST["course"];
            $email = $_POST["email"];
            //query to insert
            $query = "INSERT INTO students(fullname, course, email) 
            VALUES('$fullname', '$course', '$email')";
            //query the db
            $run_query = mysqli_query($connectdb, $query);
            //check if insert is successful
            if($run_query){
                echo "<div style ='text-align: center;'> Registeration successful </div>";
            }else{
                echo "<div style ='text-align: center;'> RegisterNotation successful </div>";
            }
        }

        ?>
    </form>
</body>
</html>