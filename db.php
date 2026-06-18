<?php

$conn = new mysqli(
"localhost",
"root",
"",
"blog_project"
);

if($conn->connect_error){
die("Connection Failed");
}

session_start();

?>