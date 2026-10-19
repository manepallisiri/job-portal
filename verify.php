<div class="navbar">
    
</div><?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Verify Certificate</title>
<link rel="stylesheet" href="style.css">

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #eef2f5;
}

/* Navbar */
.navbar {
    background: #0077b5;
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
}

/* Center container */
.box {
    width: 380px;
    margin: 80px auto;
    background: white;
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    text-align: center;
}

/* Title */
h2 {
    margin-bottom: 20px;
}

/* Input */
input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background: #0077b5;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #005f8a;
}

/* Status styles */
.success {
    color: green;
    font-size: 18px;
    font-weight: bold;
}

.error {
    color: red;
    font-size: 18px;
    font-weight: bold;
}

.pending {
    color: orange;
    font-weight: bold;
}

/* Link */
a {
    display: block;
    margin-top: 15px;
    color: #0077b5;
    text-decoration: none;
}
</style>

</head>

<body>

<div class="navbar">🔍 Certificate Verification</div>

<div class="box">
<h2>Verify Certificate</h2>

<form method="POST">
<input type="text" name="cert_id" placeholder="Enter Certificate ID" required>
<button name="check">Verify</button>
</form>

<?php

if (isset($_GET['cert_id'])) {
    $cert_id = $_GET['cert_id'];
}
elseif (isset($_POST['check'])) {
    $cert_id = $_POST['cert_id'];
}

if (!empty($cert_id)) {

    $sql = "SELECT * FROM certificates WHERE cert_id='$cert_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        if ($row['status'] == "Fake") {
            echo "<p class='error'>❌ Fake Certificate</p>";
        }
        elseif ($row['status'] == "Verified") {
            echo "<p class='success'>✅ Verified Certificate</p>";
        }
        else {
            echo "<p class='pending'>⏳ Pending Verification</p>";
        }

        echo "<a href='{$row['file_path']}' target='_blank'>📄 View Certificate</a>";

    } else {
        echo "<p class='error'>Certificate not found</p>";
    }
}
?>

<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>

</body>
</html>