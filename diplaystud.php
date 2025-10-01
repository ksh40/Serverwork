<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display students</title>
    <style>
        table, th, td{
            border: 1px solid black; 
            border-collapse: collapse;
        }
        h1{
            text-align: center;
        }
        table{
            margin: 10px auto;
            width: 70%;
            padding: 10px;
        }
        td a{
            text-decoration: none;
            background-color: grey;
            border-radius: 5px;
            color: white;
            padding: 1px;

        }
    </style>
</head>
<body>
    <h1>Registered students</h1>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Fullname</th>
            <th>Course</th>
            <th>Email</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        //read operation
        //connect to bbitgroupb database
        include "connectdb.php";
        //write a query to select from the db
        $query = "SELECT * FROM students";
        //query db
        $run_query = mysqli_query($connectdb, $query);
        //check if query is successful
        if($run_query){
            //display data from our db - mysqli_fetch_assoc()
            while($row =  mysqli_fetch_assoc($run_query)){
                //display them
                $stud_id = $row["stud_id"];
                $fullname = $row["fullname"];
                $course = $row["course"];
                $email = $row["email"];
                echo"<tr>
                <td>$stud_id</td><td>$fullname</td>
                <td>$course</td><td>$email</td>
                <td><a href='delete.php?deleteid=$stud_id'>Delete</a></td>
                <td><a href='update.php?updateid=$stud_id'>Update</a></td>
                </tr>";
            }
            // $first_row= mysqli_fetch_assoc($run_query);
            // echo $first_row["email"];

        }
        ?>
    </table>
</body>
</html>