<?php
	session_start();
	include('connect.php');
	
	// set decimal precision for division
	ini_set("precision", 3);
	
	// get session variables
	$class_id = $_SESSION['class_id'];
	$user_id = $_SESSION['username'];
	$quiz_id = $_SESSION['quiz_id'];
	$class_id = $_SESSION['class_id'];
	$cur_question_id = $_SESSION['question_ids'];
	
	// compare student's answer to correct answer
	$total_questions = 0;
	$total_correct = 0;
	if (isset($_POST['submit'])) {
		foreach($_POST['quizcheck'] as $option_num => $student_ans){
				$ans_query = "SELECT true_ans FROM questions";
				$ans_run = $conn->query($ans_query);
				$ans_row = mysqli_fetch_array($ans_run);
				$true_ans = $ans_row['true_ans'];
				if ($true_ans == $student_ans){
					$total_correct++;
				}
				//echo("<script>alert('Checking row $total_questions: student answer = ".$student_ans." and correct ans = $true_ans')</script>");
				$total_questions++;
		}
	}
	$score = $total_correct / $total_questions;
	$score = $score * 100;

	// update score table
	
	// check to see if the student already has a row in scores
	$score_exists_query = "select 'x' from scores where student_id = '$user_id' and quiz_id = '$quiz_id'";
	$score_exists = $conn->query($score_exists_query)->num_rows;
	
	// If there is an existing row, we need to update that row with the current score and attempt count. Otherwise we insert a row 
	if ($score_exists > 0) {
		
		// Get attempt count and best score
		$score_query = "select attempt_count, best_score, best_attempt from scores where student_id = '$user_id' and quiz_id = '$quiz_id'";
		$score_run = $conn->query($score_query);
		$score_result = mysqli_fetch_assoc($score_run);
		$attempt_count = $score_result['attempt_count'];
		$best_score = $score_result['best_score'];
		$best_attempt = $score_result['best_attempt'];
		
		// Update attempt count
		$attempt_count++;
		
		// If the current score is better than the previous best score, update best score and best attempt
		if ($score >= $best_score) {
			$best_score = $score;
			$best_attempt = $attempt_count;
		}
		
		// Insert updated information
		$update = "update scores set attempt_count = '$attempt_count', best_score = '$best_score', best_attempt = '$best_attempt' where student_id = '$user_id' and quiz_id = '$quiz_id'";
		$update_run = $conn->query($update);
		if ($conn->query($update) === true){
			echo("<script>alert('Your scores have been updated. Score: $total_correct out of $total_questions')</script>");
		} else {
			 echo "Error: " . $update . "<br>" . $conn->error;
		}
		
		
	} else {
		// if no row exists, we need to insert a row into the table
		$insert = "INSERT INTO `scores` (`student_id`, `class_id`, `quiz_id`, `attempt_count`, `best_score`, `best_attempt`, `first_attempt_score`) 
		VALUES ('$user_id', '$class_id', '$quiz_id', '1', '$score', '1', '$score')";
		if ($conn->query($insert) === true){
			echo("<script>alert('Your scores have been updated. Score: $total_correct out of $total_questions')</script>");
		} else {
			 echo "Error: " . $insert . "<br>" . $conn->error;
		}
			
	}
	
	// clear quiz arrays and redirect to display page (eventually)
	unset($_SESSION['question_ids']);
	unset($_SESSION['student_answer']);
	
	echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/StudentPages/StudentClass.php?id=$class_id';</script>");
?>

