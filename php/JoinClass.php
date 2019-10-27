<?php
include('GetClassCode.php');
session_start();

$servername = "localhost";
$DBusername = "quizuser";
$DBpassword = "classquiz";
$DBname = "quiz";
// Create connection
$conn = new mysqli($servername, $DBusername, $DBpassword, $DBname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

	// Get form data 
	$classcode = filter_input(INPUT_POST, 'classcode');
	// Ensure that the account can be added.  
	$valid = TRUE;
	$username= $_SESSION['username'];
	

	// If the data information is valid, insert into class table
	if ($valid === TRUE) {
		$newJoinSQL = "insert into enrollment (class_code, student_id) values ('$classcode','$username')";
		if ($conn->query($newJoinSQL) === TRUE) {
			echo("<script>alert('You are successfully joined to this class!')</script>");
            echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/StudentHome.php';</script>");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
    }
}
?>