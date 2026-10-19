<div class="navbar">
    
</div><?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users 
                            WHERE email='$email' AND password='$password'");

    if ($result->num_rows > 0) {

        $_SESSION['email'] = $email;

        header("Location: dashboard.php");
        exit();

    } else {
        $error = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">

<style>
.box {
    width: 350px;
    margin: 80px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
}
</style>

</head>

<body>

<div class="box">
<h2>Login</h2>

<!-- Success message -->
<?php
if (isset($_GET['msg'])) {
    echo "<p style='color:green;'>Registered successfully! Please login.</p>";
}
?>

<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>

<?php
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>

<a href="register.php">Create Account</a>
</div>

</body>
</html>