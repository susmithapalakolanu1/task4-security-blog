<?php
include "db.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Blog Posts</h2>

<a href="create.php">Add Post</a> |
<a href="logout.php">Logout</a>

<hr>

<?php while($row = $result->fetch_assoc()) { ?>

<h3><?php echo htmlspecialchars($row['title']); ?></h3>

<p><?php echo htmlspecialchars($row['content']); ?></p>

<a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>

<?php if($_SESSION['role']=="admin") { ?>
|
<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
<?php } ?>

<hr>

<?php } ?>

</body>
</html>