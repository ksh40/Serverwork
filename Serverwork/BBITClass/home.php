<?php
session_start(); //resume existing session
//prevent access if not logged in
if(!isset($_SESSION["email"])){
	header("location: login.php");
}

$email=$_SESSION["email"];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="home.css">
</head>
<body>
	<main>
		<nav class="navbar">
		    <div class="nav-left">
		      <a href="#">TaskApp</a>
		    </div>

		    <div class="nav-center">
		      <a href="#tasks">Tasks</a>
		    </div>

		    <div class="nav-right">
		      <a href="logout.php">Logout</a>
		    </div>
  </nav>
		
	<h1> Student Task Management App</h1>
	<h1> <?php echo "WELCOME $email" ?></h1>
	<div id="taskform">
		<h2 id="taskh2">Add Task</h2>
	<form method="post">
	<label>Task Name: </label>
	<input type="text" name="task_name" required>
	<label>Due date:</label>
	<input type="date" name="due_date">
	<input type="submit" name="add" value="Add Task" required>
</form>
	
	</div>
	<hr>
	
	<div class="todo-container">
    <h2 id="tasks">My Tasks</h2>
    <ul class="todo-list">
      <li>
      	<div class="task-text">
        <span >Web Lab 3</span>
        <span>11/07/2025</span>
        </div>
        <div class="actions">
          <button class="complete-btn">Complete</button>
          <button class="delete-btn">Delete</button>
        </div>
      </li>
      <li class="completed">
      	<div class="task-text">
        <span >Data Structures Assignment</span>
        <span>12/07/2025</span>
    </div>
        <div class="actions">
          <button class="complete-btn">Undo</button>
          <button class="delete-btn">Delete</button>
        </div>
      </li>
      
    </ul>
	
	</div>
		
	</main>
</body>
</html>