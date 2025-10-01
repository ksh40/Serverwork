<?php
session_start();
include "connectdb.php";

$username = $_SESSION["username"] ?? "";
$feedback = "";
$user = null;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $profile = "";
    $feedback = "";

    if (isset($_FILES["profile"]) && $_FILES["profile"]["error"] === 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $file_type = $_FILES["profile"]["type"];
        $file_ext = strtolower(pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION));
        $max_size = 2 * 1024 * 1024; // 2MB

        if (!in_array($file_type, $allowed_types) || !in_array($file_ext, ['jpeg', 'jpg', 'png'])) {
            $feedback = "Only JPG, JPEG, or PNG files are allowed.";
        } elseif ($_FILES["profile"]["size"] > $max_size) {
            $feedback = "File too large. Max size is 2MB.";
        } else {
            $upload_dir = "uploads/";
            if (!is_dir($upload_dir)) mkdir($upload_dir);

            $unique_name = $username . "_" . time() . "." . $file_ext;
            $target_file = $upload_dir . $unique_name;
            $full_path = __DIR__ . "/" . $target_file;

            if (move_uploaded_file($_FILES["profile"]["tmp_name"], $full_path)) {
                $profile = $target_file; // ✅ Save this to DB
            } else {
                $feedback = "Image upload failed.";
            }
        }
    }

    if (empty($feedback)) {
        $sql = "UPDATE register SET fullname='$fullname', email='$email', age=$age";
        if (!empty($profile)) {
            $sql .= ", profile='$profile'";
        }
        $sql .= " WHERE username='$username'";

        if (mysqli_query($connectdb, $sql)) {
            $feedback = "Profile updated successfully.";
        } else {
            $feedback = "Something went wrong during update.";
        }
    }
}



$query = "SELECT * FROM register WHERE username='$username'";
$result = mysqli_query($connectdb, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html> 
<html>
<head>
    <title>WaveCheck Profile</title>
    <link rel="stylesheet" href="Wave.css">
    <link rel="stylesheet" href="ths.css">
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
        img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin: 10px 0;
        }
        form {
            
            text-align: center;
            margin-top: 20px;
        }
        label {
            display: block;
        }
        input[type="text"], input[type="email"], input[type="number"], input[type="file"] {
            width: 300px;
            padding: 8px;
            font-size: 1em;
        }
        input[type="submit"] {
            background-color: rgb(151, 247, 73);
            color: black;
            padding: 10px 50px;
            font-size: 1em;
            margin-top: 15px;

        }
        .message {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>WAVE CHECK</h1>
    <nav class="navigation">
        <a href="Home.html" class="nav" target="_blank">HOME</a>
        <a href="Add.php" class="nav" target="_blank">Recently added</a>
        <a href="Registration.php" class="nav" target="_blank">REGISTRATION</a>
        <a href="Profile.php" class="nav" target="_blank">PROFILE</a>
    </nav>

    <h2 style="text-align: center;color: rgb(2, 42, 9);font-weight: 1000; font-size: 2em;">User Profile</h2>

    <?php if (!empty($feedback)) : ?>
        <div class="<?php echo strpos($feedback, 'success') !== false ? 'message' : 'error'; ?>">
            <?php echo htmlspecialchars($feedback); ?>
        </div>
    <?php endif; ?>

    <?php if ($user): ?>
        <?php if (!empty($user["profile"])): ?>
           <img src="<?php echo htmlspecialchars($user['profile']); ?>" alt="Profile Picture">

        <?php else: ?>
            <p style="text-align: center">No profile picture uploaded.</p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label>Full Name:</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($user["fullname"]); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user["email"]); ?>" required>

            <label>Age:</label>
            <input type="number" name="age" value="<?php echo htmlspecialchars($user["age"]); ?>" required>

            <label>Profile Picture (JPG/PNG only):</label>
            <input type="file" name="profile" accept=".jpg,.jpeg,.png">
            <p></p>
            <input type="submit" value="Update Profile">
        </form>
        <p style="text-align: center; font-weight: 1000; color: rgb(229, 104, 2);">
            Want to log out? <a href="login.php" 
            style="background-color: rgb(215, 18, 11); color: rgb(255, 255, 255);
            padding: 10px;margin: 0;">LOG OUT</a></p>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
</body>
</html>
