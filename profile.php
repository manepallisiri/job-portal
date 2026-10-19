<div class="navbar">
    
</div><?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user data
$result = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" href="style.css">

<style>
.profile-box {
    width: 400px;
    margin: 80px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
}

.profile-box h2 {
    margin-bottom: 20px;
}
</style>

</head>

<body>

<div class="navbar">👤 My Profile</div>

<div class="profile-box">

<h2>Profile Details</h2>

<p><b>Name:</b> <?php echo $user['name']; ?></p>
<p><b>Email:</b> <?php echo $user['email']; ?></p>

<?php
if (!empty($user['resume'])) {
    echo "<p><b>Resume:</b></p>";
    echo "<a href='{$user['resume']}' target='_blank'>📄 View Resume</a>";
} else {
    echo "<p>No resume uploaded</p>";
}
?>

<br>

<a href="resume.php" class="btn">📄 Upload / Update Resume</a>
<a href="dashboard.php" class="btn">⬅ Back to Dashboard</a>

</div>

</body>
</html>