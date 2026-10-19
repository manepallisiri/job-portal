<div class="navbar">
    
</div><?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Applications</title>
<link rel="stylesheet" href="style.css">

<style>
body { font-family: Arial; text-align: center; }
table { margin: auto; border-collapse: collapse; }
th, td { padding: 10px; border: 1px solid black; }
</style>

</head>
<body>

<h2>Job Applications</h2>

<table>
<tr>
<th>User</th>
<th>Job</th>
<th>Status</th>
<th>Certificate</th>
<th>Action</th>
</tr>

<?php
$sql = "SELECT applications.id, applications.user_email, jobs.title, applications.status, certificates.file_path
        FROM applications
        JOIN jobs ON applications.job_id = jobs.id
        LEFT JOIN certificates ON certificates.user_email = applications.user_email";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['user_email']}</td>
    <td>{$row['title']}</td>
    <td>{$row['status']}</td>
    <td><a href='{$row['file_path']}' target='_blank'>View</a></td>
    <td>
        <a href='admin_applications.php?accept={$row['id']}'>Accept</a> |
        <a href='admin_applications.php?reject={$row['id']}'>Reject</a>
    </td>
    </tr>";
}
?>

</table>

<?php
if (isset($_GET['accept'])) {
    $id = $_GET['accept'];
    $conn->query("UPDATE applications SET status='Accepted' WHERE id=$id");
    header("Location: admin_applications.php");
}

if (isset($_GET['reject'])) {
    $id = $_GET['reject'];
    $conn->query("UPDATE applications SET status='Rejected' WHERE id=$id");
    header("Location: admin_applications.php");
}
?>

<a href="dashboard.php">⬅ Back</a>

</body>
</html>