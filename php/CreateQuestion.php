<?php 

	// Establish connection and session
	include 'connect.php';
	session_start();

	// Get input
	$q_name = filter_input(INPUT_POST, 'q_name');
	$opt_1 = filter_input(INPUT_POST, 'opt_1');
	$opt_2 = filter_input(INPUT_POST, 'opt_2');
	$opt_3 = filter_input(INPUT_POST, 'opt_3');
	$opt_4 = filter_input(INPUT_POST, 'opt_4');
	$true_ans = filter_input(INPUT_POST, 'true_ans');
	$question_id = $_SESSION['question_id'];
	$quiz_id = $_SESSION['quiz_id'];

	// Insert into table
	$insert = "insert into questions (quiz_id,ques_name,ans1,ans2,ans3,ans4,true_ans) values ('$quiz_id','$opt_1','$opt_2','$opt_3','$opt_4','$true_ans')";
	if ($conn->query($insert) === TRUE) {
			echo("<script>alert('New question created successfully!)</script>");
            echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/QuestionList.php';</script>");
	} else {
        echo("<script>alert('Error creating question!)</script>");
        echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/QuestionList.php';</script>");

	}
?>