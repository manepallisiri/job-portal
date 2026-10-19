<form method="GET">
<input type="text" name="search" placeholder="Search jobs...">
<button>Search</button>
</form><div class="navbar">
    
</div><?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Jobs</title>
<link rel="stylesheet" href="style.css">

<style>
body { font-family: Arial; background: #f3f2ef; text-align: center; }
.job { background: white; padding: 20px; margin: 20px auto; width: 400px; border-radius: 10px; }
button { padding: 10px; background: #0077b5; color: white; border: none; }
</style>

</head>
<body>

<h2>Available Jobs</h2>

<?php

$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM jobs 
        WHERE title LIKE '%$search%' 
        OR company LIKE '%$search%'";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div class='job'>
    <h3>{$row['title']}</h3>
    <p>Company: {$row['company']}</p>
    <p>{$row['description']}</p>
    <form method='POST'>
        <input type='hidden' name='job_id' value='{$row['id']}'>
        <button name='apply'>Apply</button>
    </form>
    </div>";
}

if (isset($_POST['apply'])) {
    $job_id = $_POST['job_id'];
    $email = $_SESSION['email'];

    $conn->query("INSERT INTO applications (user_email, job_id)
                  VALUES ('$email', '$job_id')");

    echo "<p style='color:green;'>Applied Successfully!</p>";
}
?>

<a href="dashboard.php">⬅ Back</a>

</body>
</html>