<?php
include "db.php";

if(isset($_POST['register']))
{
$username = $_POST['username'];
$password = password_hash(
$_POST['password'],
PASSWORD_DEFAULT
);

$stmt = $conn->prepare(
"INSERT INTO users(username,password)
VALUES(?,?)"
);

$stmt->bind_param(
"ss",
$username,
$password
);

$stmt->execute();

echo "Registration Successful";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST">

<input
type="text"
name="username"
placeholder="Username"
required>

<br><br>

<input
type="password"
name="password"
placeholder="Password"
required>

<br><br>

<button
type="submit"
name="register">
Register
</button>

</form>

<a href="login.php">
Login Here
</a>

</body>
</html>