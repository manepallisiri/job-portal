<div class="navbar">
    
</div><?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'db.php';

// Check login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['upload'])) {

    $email = $_SESSION['email'];
    $cert_id = $_POST['cert_id'];

    $file = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];

    // Unique file name
    $newName = time() . "_" . basename($file);
    $path = "uploads/" . $newName;

    // Upload file
    if ($error === 0 && move_uploaded_file($temp, $path)) {

        // 🔍 Check valid certificate
        $check = $conn->query("SELECT * FROM valid_certificates WHERE cert_id='$cert_id'");
        if ($check->num_rows > 0) {
    $status = "Verified";   // AUTO VERIFIED
} else {
    $status = "Fake";
}
        

        // 📌 Insert into database
        $sql = "INSERT INTO certificates (user_email, cert_id, file_path, status)
                VALUES ('$email', '$cert_id', '$path', '$status')";

        if ($conn->query($sql)) {

            // 📲 QR CODE GENERATION
            include 'phpqrcode/qrlib.php';

            $qr_path = "uploads/qr_" . $cert_id . ".png";
            $verify_link = "http://localhost/job-portal/verify.php?cert_id=" . $cert_id;

            QRcode::png($verify_link, $qr_path);

            // 🎯 Output
            if ($status == "Fake") {
                echo "<p style='color:red;'>❌ Fake Certificate Detected!</p>";
            } else {
                echo "<p style='color:green;'>✅ Certificate Verified Automatically!</p>";
                
                echo "<p>QR Code Generated:</p>";
                echo "<img src='$qr_path' width='150'>";
            }

        } else {
            echo "Database error";
        }

    } else {
        echo "<p style='color:red;'>❌ File upload failed</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload Certificate</title>
<link rel="stylesheet" href="style.css">

<style>
body {
    font-family: Arial;
    background: #f3f2ef;
    text-align: center;
}

.box {
    width: 400px;
    margin: 80px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
}

input, button {
    margin: 10px;
    padding: 10px;
    width: 80%;
}

button {
    background: #0077b5;
    color: white;
    border: none;
}

a {
    display: block;
    margin-top: 15px;
}
</style>

</head>

<body>

<div class="box">
    <h2>Upload Certificate</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="cert_id" placeholder="Certificate ID (TS1001)" required>
        <input type="file" name="file" required>
        <button name="upload">Upload</button>
    </form>

    <a href="dashboard.php">⬅ Back to Dashboard</a>
</div>

</body>
</html>