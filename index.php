<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Job Portal</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;

    /* 🔥 Blue–Purple Gradient */
    background: linear-gradient(135deg, #5f2c82, #49a09d);
    height: 100vh;
}

/* NAVBAR */
.navbar {
    display: flex;
    justify-content: space-between;
    padding: 20px 50px;
    color: white;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
}

/* MAIN GLASS BOX */
.container {
    width: 500px;
    margin: 80px auto;
    padding: 50px;

    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    backdrop-filter: blur(15px);

    text-align: center;
    color: white;
}

/* TITLE */
h1 {
    font-size: 40px;
    margin-bottom: 20px;
}

/* TEXT */
p {
    margin-bottom: 30px;
}

/* BUTTONS */
.btn {
    display: block;
    width: 220px;
    margin: 10px auto;
    padding: 12px;
    background: rgba(255,255,255,0.25);
    color: white;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.btn:hover {
    background: rgba(229, 236, 238, 0.5);
    transform: scale(1.05);
}
</style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div>⚪ JobPortal</div>
    <div>
        <a href="index.php">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="container">

    <h1>WELCOME 👋</h1>

    <p>Secure Job Portal with Certificate Verification System</p>

    <!-- IMPORTANT BUTTONS -->
    <a href="register.php" class="btn">📝 Register</a>
    <a href="login.php" class="btn">🔐 Login</a>

    <br>

    <a href="jobs.php" class="btn">💼 View Jobs</a>
    <a href="verify.php" class="btn">🔍 Verify Certificate</a>

</div>

</body>
</html>