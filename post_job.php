<div class="navbar">
   
</div><?php
include 'db.php';

if (isset($_POST['post'])) {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $desc = $_POST['desc'];

    $conn->query("INSERT INTO jobs (title, company, description)
                  VALUES ('$title', '$company', '$desc')");

    echo "Job Posted!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Post Job</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Post Job</h2>

<form method="POST">
<input type="text" name="title" placeholder="Job Title" required><br>
<input type="text" name="company" placeholder="Company" required><br>
<textarea name="desc" placeholder="Description"></textarea><br>
<button name="post">Post Job</button>
</form>

</body>
</html>