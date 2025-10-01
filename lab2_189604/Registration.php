<?php
session_start();
include "connectdb.php";
?>
<!DOCTYPE html> 
<html>
<head>
    <title>Register to WaveCheck</title>
    <link rel="stylesheet" href="Wave.css">
    <link rel="stylesheet" href="reg.css">
    <link rel="icon" href="https://i.pinimg.com/736x/25/f2/e9/25f2e9402a5cae5324629aa9a8c349ec.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <style>
        body {
            font-family: "WAVE CHECK", sans-serif;
        }
        [type=submit] {
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

        <a href="Registration.php" class="nav" target="_blank">REGISTRATION</a>
 
    </nav>

    <h2 style="text-align: center;color: rgb(0, 255, 42);font-weight: 1000; font-size: 2em;">REGISTRATION FORM</h2>
    <div class="info">
        <form method="POST" action="">
            <label>Full Name:</label>
            <input type="text" name="fullname" placeholder="Enter your name" required id="fullname">
            <div id="fname"></div>
            <p></p>

            <label>User Name:</label>
            <input type="text" name="username" placeholder="Username" required id="username">
            <div id="uname"></div>
            <p></p>

            <label>Email:</label>
            <input type="email" name="email" placeholder="Enter email" required id="email">
            <p></p>

            <label>Phone no:</label>
            <input type="number" name="phoneno" placeholder="Enter phone number" minlength="10" required id="phoneno">
            <div id="noerr"></div>
            <p></p>

            <label>Age:</label>
            <input type="number" name="age" placeholder="Enter age" required min="18" max="100" id="age">
            <div id="noage"></div>
            <p></p>

            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter password" required id="password">
            <div id="pass"></div>
            <p></p>

            <input type="submit" value="REGISTER" id="register">
            <div id="registererr"></div>

        </form>
        <p style="text-align: center; font: weight 1000px; color: rgb(237, 121, 114);">
            Already have an account? <a href="login.php" 
            style="background-color: rgb(251, 255, 255); color: rgb(0, 0, 0);
            padding: 10px;margin: 0;">LOGIN</a></p>
    </div>

    <script>
        const username = document.getElementById("username");
        const uname = document.getElementById("uname");

        const fullname = document.getElementById("fullname");
        const fname = document.getElementById("fname");
        
        const password = document.getElementById("password");
        const pass = document.getElementById("pass");

        const phoneno = document.getElementById("phoneno");
        const noerr = document.getElementById("noerr");
        
        const age = document.getElementById("age");
        const noage = document.getElementById("noage");

        function validuser() {
            const usernameValue = username.value;
            if (usernameValue.match(/^[A-Za-z]+$/)) {
                uname.textContent = "";
                return true;
            } else {
                uname.textContent = "Username should have only alphabets";
                return false;
            }
        }
        username.addEventListener("input", validuser);

        function validfull() {
            const fullnameValue = fullname.value;
            if (fullnameValue.match(/^[A-Za-z]+(?:\s[A-Za-z]+)*$/)) {
                fname.textContent = "";
                return true;
            } else {
                fname.textContent = "No numbers";
                return false;
            }
        }
        fullname.addEventListener("input", validfull);

        function validpass() {
            const passwordValue = password.value;
            let letters = /[a-zA-Z]/.test(passwordValue); 
            let numbers = /\d/.test(passwordValue);       
            if (passwordValue.length < 8) {
                pass.textContent = "WEAK=Password should have at least 8 characters";
                pass.style.color="rgba(252, 43, 43, 1)"
            } else if(!letters || !numbers) {
                pass.textContent = "Average password strength, add letters and numbers";
                pass.style.color="rgba(251, 226, 0, 1)"
            }else{
                pass.textContent = "Strong password";
                pass.style.color="rgba(112, 255, 10, 1)"
            }
            return passwordValue.length >= 8 && letters && numbers;
        }
        password.addEventListener("input", validpass);

        function validphone() {
            const phoneValue = phoneno.value;
            if (phoneValue.length < 8) {
                noerr.textContent = "Phone number should be 8 digits";
                return false;
            } else {
                noerr.textContent = "";
                return true;
            }
        }
        phoneno.addEventListener("input", validphone);

        function validage() {
            const ageValue = age.value;
            if (ageValue < 18) {
                noage.textContent = "User must be over 18 years";
                return false;
            } else {
                noage.textContent = "";
                return true;
            }
        }
        age.addEventListener("input", validage);
        
    </script>

    <?php
    include "connectdb.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $_POST["fullname"];
        $username = $_POST["username"];
        $email = trim($_POST["email"]);
        $phoneno = $_POST["phoneno"];
        $age = $_POST["age"];
        $password = $_POST["password"];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connectdb->prepare("INSERT INTO register (fullname, username, email, phoneno, age, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssis", $fullname, $username, $email, $phoneno, $age, $password_hash);

        if ($stmt->execute()) {
            session_start();
			$_SESSION["username"] = $username;
			echo "<script>alert('SIGN UP SUCCESSFUL');
            window.location.href = 'Home.html';</script>";
            exit;
        } else {
            echo "<script>alert('SIGN UP UNSUCCESSFUL');</script>";
        }

        $stmt->close();
    }
    ?>
</body>
</html>
