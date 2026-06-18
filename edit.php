<?php
include "db.php";

$id = $_GET['id'];

$stmt = $conn->prepare(
"SELECT * FROM posts WHERE id=?"
);

$stmt->bind_param("i",$id);
$stmt->execute();

$post = $stmt->get_result()->fetch_assoc();

if(isset($_POST['update']))
{
$title = $_POST['title'];
$content = $_POST['content'];

$update = $conn->prepare(
"UPDATE posts
SET title=?, content=?
WHERE id=?"
);

$update->bind_param(
"ssi",
$title,
$content,
$id
);

$update->execute();

header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Post</title>
</head>
<body>

<h2>Edit Post</h2>

<form method="POST">

<input
type="text"
name="title"
value="<?php echo $post['title']; ?>"
required>

<br><br>

<textarea
name="content"
required><?php echo $post['content']; ?></textarea>

<br><br>

<button
type="submit"
name="update">
Update
</button>

</form>

</body>
</html>