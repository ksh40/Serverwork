<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<ol id="nav">
		<li class="left"><a href="login.php">TaskApp</a></li>
		<li class="right"><a href="signup.php" class="active">Signup</a></li>

		<li class="right"><a href="#">About</a></li>
			</ol>
	<h1>Sign Up</h1>
	<div id="signupform">
		
		<form method="post">
			<label>Email</label>
			<input type="email" name="email" placeholder="Enter email" id="email" required>
			
			<label>Password</label>
			<input type="password" name="password" placeholder="Enter password" id="password" required>
			
			<input type="submit" name="signup" value="signup">
			<div class="formtext">Already have an account? <a href="login.php">Login</a></div>
		</form>
		<?php
		include "connect.php";
		//check id the user has clicked on signup
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			//Pick the data
			$email =trim($_POST["email"]);
			$password =$_POST["password"];
			$password_hash = password_hash($password,PASSWORD_DEFAULT);
			//write query to insert
			$query ="INSERT INTO student_accounts(email, password)
			VALUES ('$email','$password_hash')";
			$run_query = mysqli_query($connectdb, $query);
			if($run_query){
				echo "<div>Sign up successful<\div>";
			}else{
				echo "<div>Sign up not successful<\div>";
			}
		}
		?>
	</div>

	
</body>
</html>