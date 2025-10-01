<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<ol id="nav">
		<li class="left"><a href="login.php" class="active">TaskApp</a></li>
		<li class="right"><a href="signup.php" >Signup</a></li>
		<li class="right"><a href="#">About</a></li>
		
	</ol>
	<main>
	<h1>Login</h1>
	<div id="loginform">
		
		<form method="post">
			
			<label>Email</label>
			<input type="email" name="email" placeholder="Enter email" id="email" required>
			
			<label>Password</label>
			<input type="password" name="password" placeholder="Enter password" id="password" required>
			
			<input type="submit" name="login" value="login">
			<div class="formtext">Dont have an account? <a href="signup.php">Signup</a></div>
		</form>
		<?php
		include "connect.php";
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$email =trim($_POST["email"]);
			$password =$_POST["password"];
			//write query to get the user's details in the db
			$query = "SELECT * FROM student_accounts WHERE email='$email'";
			$run_query =mysqli_query($connectdb, $query);
			if($run_query){
				//Check if there's at least record from performing query
				if(mysqli_num_rows($run_query)){
					//fetch user data
					$user =mysqli_fetch_assoc($run_query);
					$password_hash =$user["password"];
					if(password_verify($password,$password_hash)){
						//echo "<div>Login successful<\div>";
						//start a session
						session_start();
						$_SESSION["email"] = $email;
						header("location:home.php");
					}else{
						echo "<div>Email or password incorrect<\div>";
				}
					}
				}else{
					echo "<div>Email does not exist<\div>";
				}
			}	
		
		?>
	</div>

	</main>
</body>
</html>