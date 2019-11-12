<?php
	session_start();
	include('connect.php');
	$class_id = $_SESSION['class_id'];
	
	$total_questions = 0;
	$total_correct = 0;
	foreach ($_SESSION['question_ids'] as $index=>$cur_question_id){
		$student_ans = $_POST['ans'.$index];
		$ans_query = "select true_ans from questions where question_id = '$cur_question_id'";
		$ans_run = $conn->query($ans_query);
		$ans_row = mysqli_fetch_array($ans_run);
		$true_ans = $ans_row['true_ans'];
		if ($true_ans == $student_ans){
			$total_correct++;
		}
		$total_questions++;
	}
	
	// clear quiz arrays and redirect to display page (eventually)
	unset($_SESSION['question_ids']);
	unset($_SESSION['student_answer']);
	echo("<script>alert('Score: $total_correct out of $total_questions')</script>");
	echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/StudentPages/StudentClass.php?id=$class_id';</script>");
?>