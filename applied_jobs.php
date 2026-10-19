<div class="navbar">
    
</div><?php
session_start();
include 'db.php';

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Applied Jobs</title>

<style>
body { font-family: Arial; background: #f3f2ef; text-align: center; }
.box { background: white; margin: 20px auto; width: 400px; padding: 20px; border-radius: 10px; }
</style>

</head>
<body>

<h2>Your Applied Jobs</h2>

<?php
$sql = "SELECT jobs.title, jobs.company, applications.status
        FROM applications
        JOIN jobs ON applications.job_id = jobs.id
        WHERE applications.user_email='$email'";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div class='box'>
        <h3>{$row['title']}</h3>
        <p>{$row['company']}</p>
        <p>Status: {$row['status']}</p>
    </div>";
}
?>

<a href="dashboard.php">⬅ Back</a>

</body>
</html>