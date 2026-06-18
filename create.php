<?php
include "db.php";

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare(
    "INSERT INTO posts(title,content)
    VALUES(?,?)"
    );

    $stmt->bind_param(
    "ss",
    $title,
    $content
    );

    $stmt->execute();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Post</title>
</head>
<body>

<h2>Add Post</h2>

<form method="POST">

<input
type="text"
name="title"
placeholder="Title"
required>

<br><br>

<textarea
name="content"
placeholder="Content"
required>
</textarea>

<br><br>

<button
type="submit"
name="submit">
Add Post
</button>

</form>

</body>
</html>