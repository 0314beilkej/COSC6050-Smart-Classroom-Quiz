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

	// Check if a classcode exists
	//if ($valid === TRUE){
		//$checkSQL = "SELECT * from enrollment where class_code = '$classcode'";
		//$result = $conn->query($checkSQL)->num_rows;
		//if ($result > 0) {
			//$valid = false;
			//echo("<script>alert('You are already registred for the class with code ".$classcode.". Try to join another class.')</script>");
			//echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/StudentPages/StudentHome.php';</script>");
		//}
	//}
	

	// If the data information is valid, insert into class table
	if ($valid === TRUE) {
		$newJoinSQL = "insert into enrollment (class_code, student_id) values ('$classcode','$username')";
		if ($conn->query($newJoinSQL) === TRUE) {
			echo("<script>alert('You are successfully joined to this class!')</script>");
            echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/StudentPages/StudentHome.php';</script>");
		} else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
			echo("<script>alert('Please enter a valid class code!')</script>");
            echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/StudentPages/StudentHome.php';</script>");
		}
    }
}
?>