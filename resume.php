<?php
session_start();
include 'db.php';

$email = $_SESSION['email'];

if (isset($_POST['upload'])) {

    $file = $_FILES['resume']['name'];
    $temp = $_FILES['resume']['tmp_name'];

    $path = "uploads/" . time() . "_" . $file;

    if (move_uploaded_file($temp, $path)) {

        $conn->query("UPDATE users SET resume='$path' WHERE email='$email'");
        echo "<p class='success'>Resume uploaded!</p>";

    } else {
        echo "<p class='error'>Upload failed</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">Resume Upload</div>

<div class="box">
<h2>Upload Resume</h2>

<form method="POST" enctype="multipart/form-data">
<input type="file" name="resume" required>
<button name="upload">Upload</button>
</form>

<a href="dashboard.php">⬅ Back</a>
</div>

</body>
</html>