<?php
include 'connect.php';
include 'TeacherClass.php';
//include 'CreateClass.php';

session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

	//Get Form Data
	$quizname = filter_input(INPUT_POST, 'quizname');
    $quizdescription = filter_input(INPUT_POST, 'quizdescription');
	
	// Ensure that the account can be added.  
	$valid = TRUE;
	$username = $_SESSION['username'];
	$classid = $_SESSION['class_id'];
	
	// Check if a quizname exists
	if ($valid === TRUE){
		$checkSQL = "SELECT * from quizzes where quiz_name = '$quizname'";
		$result = $conn->query($checkSQL)->num_rows;
		if ($result > 0) {
			$valid = false;
			echo("<script>alert('There is already a quiz associated with ".$quizname.". Try creating a quiz with another name.')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/TeacherPages/TeacherClass.php';</script>");
		}
	}

	// If the data information is valid, insert into quizzes table
	if ($valid === TRUE) {
		var_dump ($classid);
		echo $username;
		$newSQL = "insert into quizzes (quiz_name, quiz_description, instructor_id, time_limit, num_questions, num_answer, max_attempt, class_id) values ('$quizname', '$quizdescription', '$username', 10, 10, 10, 10, '$classid')";
		if ($conn->query($newSQL) === TRUE) {
			echo ("<script>alert('New quiz created successfully!')</script>");
			echo ("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/TeacherPages/Questions.php';</script>");
		} else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
			echo("<script>alert('Error creating quiz')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/TeacherPages/TeacherClass.php';</script>");
		}
    }
}


?>