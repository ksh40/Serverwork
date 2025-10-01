<?php
session_start();
include "connectdb.php";
$feedback="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["username"]; 
    $name = $_POST["playlist_name"];
    $visibility = $_POST["visibility"];
    if (isset($_FILES["playlist"]) && $_FILES["playlist"]["error"] == 0) {
        $target = "uploads/" . basename($_FILES["playlist"]["name"]);
        move_uploaded_file($_FILES["playlist"]["tmp_name"], $target);
        $sql = "INSERT INTO playlists (username, name, file_path, visibility)VALUES ('$username', '$name', '$target', '$visibility')";
         if (mysqli_query($connectdb, $sql)) {
            echo "<script>alert('Playlist recorded and saved!');</script>";
        }else{
            echo "<script>alert('Invalid Playlist');</script>";
        }
    }elseif (!empty($_POST["link"])) {
        $link = $_POST["link"];
        $sql = "INSERT INTO playlists (username, name, link, visibility)VALUES ('$username', '$name', '$link', '$visibility')";
        if (mysqli_query($connectdb, $sql)) {
            echo "<script>alert('Playlist recorded and saved!');</script>";
        }else{
            echo "<script>alert('Invalid Playlist');</script>";
        }
    }
}
?>        
<!DOCTYPE html> 
<html>
    <head>
        <title>Recently Added|WaveCheck</title>
        <link rel="icon" type="wavy.jpg" href="https://i.pinimg.com/736x/25/f2/e9/25f2e9402a5cae5324629aa9a8c349ec.jpg">
        <link rel="stylesheet" href="Wave.css">
        <link rel="stylesheet" href="ths.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
        <style>
        body {
            font-family: "WAVE CHECK", sans-serif;
        }
        [type=submit]{
            background-color: rgb(151, 247, 73);
            width: 15%;  
            padding: 5px; 
            font-size: 1.3em;
        }
        li{
            background-image:url("b.jpg");
            background-size: cover;
        }
        </style>
    </head>
    <body>
        <h1>WAVE CHECK</h1>

        <nav class="navigation">
        <a href="Home.html" class="nav"
         target="_blank" title="Home page">HOME</a>
        <a href="Add.php" class="nav"
         target="_blank" title="Recently added">Recently added</a>
        <a href="Registration.php" class="nav"
         target="_blank" title="Registration">REGISTRATION</a>
        <a href="Profile.php" class="nav"
         target="_blank" title="PROFILE">PROFILE</a>
        </nav>

        <h2 style="color: darkblue;">Want to add another playlist?</h2>
            
        <h3>OPTION 1: Upload via local files</h3>
        <form method="POST" enctype="multipart/form-data">
            <label>Name of playlist</label>
            <input type="text" name="playlist_name" placeholder="Enter playlist name"required>
            <p></p>
            <label>Upload playlist: </label>
            <input type="file" name="playlist">
            <p></p>
            <label>Public to everyone/Private: </label>
            <label>Public</label>
            <input type="radio" name="visibility"value="public" checked>
            <label>Private</label>
            <input type="radio" name="visibility"value="private">
            <p></p>
           <input type="submit" value="SAVE">
        </form>
        <hr>
        <h3>OPTION 2: Upload via link from streaming services</h3>
        
        <form method="POST">
            <label>Name of playlist</label>
            <input type="text" name="playlist_name" placeholder="Enter playlist name"required>
            <p></p>
            <label>Upload playlist: </label>
            <p></p>
            <textarea rows="2" name="link" cols="100" placeholder="Link from streaming service:"></textarea>
            <p></p>
            <label>Public to everyone/Private: </label>
            <label>Public</label>
            <input type="radio" name="visibility"value="public" checked>
            <label>Private</label>
            <input type="radio" name="visibility"value="private">
            <p></p>
            <input type="submit" value="SAVE">
        </form>
        
        <p></p>
        <hr>
        <h3 style="text-align: center; letter-spacing: 0.5cm; font-weight: 1000; color: rgb(169, 32, 248);font-size: 2em;">Recently added playlists</h3>
        <p></p>
        
        <?php
        $query = "SELECT * FROM playlists ORDER BY id DESC";
        $result = mysqli_query($connectdb, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<ol style='font-size: 1.5em;'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "<h3 style='color: rgb(168, 251, 16);'>" . htmlspecialchars($row["name"]) . "</h3><br>";
                if (!empty($row["file_path"])) {
                    echo "<a href='" . htmlspecialchars($row["file_path"]) . "' target='_blank'>Download Playlist File</a>";
                } elseif (!empty($row["link"])) {
                    echo "<a href='" . htmlspecialchars($row["link"]) . "' target='_blank'style='padding: 10px; margin: 0; display: inline-block;'>
                    <img src='re.jpg' alt='Open Playlist Link' width='100'></a>";
                }
                echo "<br><small><span style='color: rgb(168, 251, 16);'>
                Added by: " . htmlspecialchars($row["username"]) . " (" . htmlspecialchars($row["visibility"]) .")</span></small>";
                echo "</li><hr>";
            }
            echo "</ol>";
        } else {
            echo "<p>No playlists have been added yet.</p>";
        }
        ?>
    </body>
</html>