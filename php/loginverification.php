<?php
session_start();
include 'connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

	// Get form data 
	$username = filter_input(INPUT_POST, 'username');
	$password = filter_input(INPUT_POST, 'password');



	// Validate username and password
	$checkSQL = "SELECT username, role from users where username = '$username' and password = '$password'";
	$result = $conn->query($checkSQL);
		if ($result-> num_rows > 0) {
			while ($row = $result-> fetch_assoc()) {
				$_SESSION['username'] = $username;
				if ($row["role"] == "Teacher") {
					//header('Location: https://pascal.mscsnet.mu.edu/quiz/TeacherHome.php');
					header('Location: ../TeacherPages/TeacherHome.php');
				} else {
					header('Location: https://pascal.mscsnet.mu.edu/quiz/StudentPages/StudentHome.php');
				}
			}
		} else {
			echo ("<script>alert('username or password is invalid!')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/index.html';</script>");

			//eventually want to create an alert saying login unsuccessful
		}
}	
	
?>