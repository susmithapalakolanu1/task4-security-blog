<?php
include "db.php";

if(isset($_POST['login']))
{
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare(
"SELECT * FROM users WHERE username=?"
);

$stmt->bind_param("s",$username);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if(
$user &&
password_verify(
$password,
$user['password']
)
)
{
$_SESSION['user_id']=$user['id'];
$_SESSION['role']=$user['role'];

header("Location:index.php");
}
else
{
echo "Invalid Login";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>

<h2>Login</h2>

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
name="login">
Login
</button>

</form>

<a href="register.php">
Register Here
</a>

</body>
</html>