<?php
include "db.php";

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$limit = 5;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page - 1) * $limit;

$result = mysqli_query($conn,
"SELECT * FROM posts ORDER BY id DESC LIMIT $offset, $limit");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="GET">
    <input type="text" name="search" placeholder="Search posts">
    <button type="submit">Search</button>
</form>

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
<?php
$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM posts");
$total_row = mysqli_fetch_assoc($total_result);

$total_pages = ceil($total_row['total'] / $limit);

echo "<div style='margin-top:20px;'>";

for($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='?page=$i' style='padding:8px; margin:5px; border:1px solid #000; text-decoration:none;'>$i</a>";
}

echo "</div>";
?>

</body>
</html>