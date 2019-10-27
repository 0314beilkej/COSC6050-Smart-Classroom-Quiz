<?php
session_start();
$servername = "localhost";
$DBusername = "quizuser";
$DBpassword = "classquiz";
$DBname = "quiz";
// Create connection
$conn = new mysqli($servername, $DBusername, $DBpassword, $DBname);
$username = $_SESSION['username'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
	$checkSQL = "SELECT * from users where username = '$username'";
	$result = $conn->query($checkSQL);
	while ($row = $result-> fetch_assoc()){
		$name = $row['firstname'] ." ". $row['lastname']." ";
	$_SESSION['name'] = $name;
	$_SESSION['role'] = $row['role'];
	}  
}

// destroy the session 
//session_destroy(); 
?>
