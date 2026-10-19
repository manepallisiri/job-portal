<div class="navbar">

</div><?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<style>
body { font-family: Arial; text-align: center; background: #f3f2ef; }
table { margin: auto; border-collapse: collapse; background: white; }
th, td { padding: 10px; border: 1px solid black; }
a { text-decoration: none; color: blue; }
</style>

</head>

<body>

<h2>Admin Panel</h2>

<table>
<tr>
<th>ID</th>
<th>Email</th>
<th>Certificate ID</th>
<th>File</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
$sql = "SELECT * FROM certificates";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['user_email']}</td>
    <td>{$row['cert_id']}</td>
    <td><a href='{$row['file_path']}' target='_blank'>View</a></td>
    <td>{$row['status']}</td>
    <td>
        <a href='admin.php?approve={$row['id']}'>Approve</a> |
        <a href='admin.php?reject={$row['id']}'>Reject</a>
    </td>
    </tr>";
}
?>

</table>

<br>
<a href="dashboard.php">⬅ Back</a>

<?php
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $conn->query("UPDATE certificates SET status='Verified' WHERE id=$id");
    header("Location: admin.php");
}

if (isset($_GET['reject'])) {
    $id = $_GET['reject'];
    $conn->query("UPDATE certificates SET status='Rejected' WHERE id=$id");
    header("Location: admin.php");
}
?>

</body>
</html>