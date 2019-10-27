<?php
include('GetClassCode.php');
include 'connect.php';
session_start();

/* $servername = "localhost";
$DBusername = "quizuser";
$DBpassword = "classquiz";
$DBname = "quiz";
// Create connection
$conn = new mysqli($servername, $DBusername, $DBpassword, $DBname); */

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

	// Get form data 
	$classname = filter_input(INPUT_POST, 'classname');
    $subject = $_POST['subject'];
	// Ensure that the account can be added.  
	$valid = TRUE;
	$username= $_SESSION['username'];
	
	// Get a unique class code
	$codeExists = true;
	while($codeExists == true)
	{
		$classcode = generateRandomCode();
		$query = "select 'x' from class where class_code = '$classcode'";
		$numRows = $conn->query($query)->num_rows;
		if ($numRows == 0) {
			$codeExists = false;
		} 
	}

	// If the data information is valid, insert into class table
	if ($valid === TRUE) {
		$newClassSQL = "insert into class (classname, class_code, subject, instructor_id) values ('$classname', '$classcode', '$subject', '$username')";
		if ($conn->query($newClassSQL) === TRUE) {
			echo("<script>alert('New class created successfully! Class Code: ".$classcode."')</script>");
            echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/TeacherHome.php';</script>");
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
    }
}
?>