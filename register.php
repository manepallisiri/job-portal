<div class="navbar">
    
</div><?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert into database
    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql)) {

        // Redirect to login page
        header("Location: login.php?msg=registered");
        exit();

    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">

<style>
body {
    font-family: Arial;
    background: #eef2f5;
}

.box {
    width: 350px;
    margin: 80px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
}

input {
    width: 90%;
    padding: 10px;
    margin: 10px;
}

button {
    width: 95%;
    padding: 10px;
    background: #0077b5;
    color: white;
    border: none;
}

.error {
    color:white;
}
</style>

</head>

<body>

<div class="box">
<h2>Register</h2>

<form method="POST">
<input type="text" name="name" placeholder="Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="register">Register</button>
</form>

<?php
if (isset($error)) {
    echo "<p class='error'>$error</p>";
}
?>

<a href="login.php">⬅ Back to Login</a>
</div>

</body>
</html>