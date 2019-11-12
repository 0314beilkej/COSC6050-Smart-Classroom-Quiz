<?php
	unset($_SESSION['question_ids']);
	unset($_SESSION['student_answer']);
	$class_id = $_SESSION['class_id'];
	echo("<script>alert('You have failed.')</script>");
	echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/StudentPages/StudentClass.php?id=$class_id';</script>");
?>