<?php
include 'db.php';

// counts
$users = $conn->query("SELECT * FROM users")->num_rows;
$jobs = $conn->query("SELECT * FROM jobs")->num_rows;
$certs = $conn->query("SELECT * FROM certificates WHERE status='Verified'")->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">Admin Dashboard</div>

<div class="container">

<div class="card">
<h3>Total Users</h3>
<p><?php echo $users; ?></p>
</div>

<div class="card">
<h3>Total Jobs</h3>
<p><?php echo $jobs; ?></p>
</div>

<div class="card">
<h3>Verified Certificates</h3>
<p><?php echo $certs; ?></p>
</div>

</div>

<a href="dashboard.php">⬅ Back</a>

</body>
</html>