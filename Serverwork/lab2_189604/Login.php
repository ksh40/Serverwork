
<!DOCTYPE html> 
<html>
    <head>
        <title>Login to WaveCheck</title>
        <link rel="stylesheet" href="Wave.css">
        <link rel="stylesheet" href="reg.css">
        <link rel="icon" type="wavy.jpg" href="https://i.pinimg.com/736x/25/f2/e9/25f2e9402a5cae5324629aa9a8c349ec.jpg">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
        <style>
        body {
            font-family: "WAVE CHECK", sans-serif;
        }
        [type=submit]{
            background-color: rgb(7, 255, 230);
            width: 25%;  
            padding: 10px; 
            font-size: 1.3em;
        }
        
        </style>
    </head>
    <body>
        <h1>WAVE CHECK</h1>
        <nav class="navigation">
        <a href="Registration.php" class="nav"
         target="_blank" title="Registration">REGISTRATION</a>
        <a href="Login.php" class="nav"
         target="_blank" title="LOGIN">LOGIN</a>
        </nav>
        
        <h2 style="text-align: center;color: rgb(0, 255, 42);font-weight: 1000; font-size: 2em;">LOGIN</h2>
        <div class="info">
        <form method="POST" action="">
            
            <label>User Name: </label>
            <input type="text" name="username" placeholder="Username"required id="username">
            <div id="uname"></div>
            <p></p>
            
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password"required id="password">
            <div id="pass"></div>
            <p></p>
            <label></label>
            <input type="submit" value="LOGIN" id="login">
            <div id="loginerr"></div>
        </form>
        <p style="text-align: center; font: weight 1000px; color: rgb(237, 121, 114);">
            Don't have an account? <a href="Registration.php" 
            style="background-color: rgb(251, 255, 255); color: rgb(0, 0, 0);
            padding: 10px;margin: 0;">REGISTER</a></p>
        </div>
        <script>
            
        const username = document.getElementById("username");
        const uname = document.getElementById("uname");

        const password = document.getElementById("password");
        const pass = document.getElementById("pass");
        
        const loginerr = document.getElementById("login");

        function validuser(){
            const usernameValue = username.value;
            if(usernameValue.match(/^[A-Za-z]+$/)){
                uname.textContent = "";
                loginerr.disabled = false;
                return true;
            } else{
                //display error
                uname.textContent = "Username should have only alphabets";
                return false;
            }
        }
        username.addEventListener("input", validuser);

        function validpass(){
            const passwordValue = password.value;
            if(passwordValue.length < 8){
                pass.textContent = "Password should have at least 8 characters";
                return false;
            } else{
                pass.textContent = "";
                loginerr.disabled = false;
                return true;
            }
        }
        pass.addEventListener("input", validpass);

        // function login(){
        //     if(validuser() && validpass()){
        //         alert("Sign Up Successful");
        //     }else{
        //         loginerr.disabled = true;
        //     }
        // }
        // loginerr.addEventListener("click", login);

        </script>
        <?php
		include "connectdb.php";
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$username =$_POST["username"];
			$password =$_POST["password"];
			//write query to get the user's details in the db
			$query = "SELECT * FROM register WHERE username='$username'";
			$run_query =mysqli_query($connectdb, $query);
			if($run_query){
				//Check if there's at least record from performing query
				if(mysqli_num_rows($run_query)>0){
					//fetch user data
					$user =mysqli_fetch_assoc($run_query);
					$password_hash =$user["password"];
					if(password_verify($password,$password_hash)){
						session_start();
						$_SESSION["username"] = $username;
						header("Location:Home.html");
					}else{
						echo "<script>alert('Wrong username/password');</script>";
				}
					}
				}else{
					echo "<script>alert('Account does not exist')</script>";
				}
			}	
		
		?>
        <br>
    </body>