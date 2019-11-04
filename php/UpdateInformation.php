<?php
include 'connect.php';
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
	
	// Get form data 
	$firstname	= filter_input(INPUT_POST, 'firstname');
    $lastname 	= filter_input(INPUT_POST, 'lastname');
	$email	= filter_input(INPUT_POST, 'email');
	$newusername	= filter_input(INPUT_POST, 'username');
	$password	= filter_input(INPUT_POST, 'password');
	$username = $_SESSION['username'];
	$existingemail = $_SESSION['email_form'];
	
	
	// Ensure that the account can be added.  
	$valid = TRUE;
	
	//Update table information by overwriting it.
	if ($valid = TRUE) {
		
		//defining overwriting functions
		$updatefnameSQL = "UPDATE users SET firstname = '$firstname' WHERE username = '$username' ";
		$updatelnameSQL = "UPDATE users SET lastname = '$lastname' WHERE username = '$username' ";
		$updateemailSQL = "UPDATE users SET email = '$email' WHERE username = '$username' ";
		$updatepasswordSQL = "UPDATE users SET password = '$password' WHERE username = '$username' ";
		
		if(!empty($firstname)){
			if (mysqli_query($conn, $updatefnameSQL)) {
			}
		}
		if(!empty($lastname)){
			if (mysqli_query($conn, $updatelnameSQL)) {
			}
		}
		if(!empty($email)){
			$checkSQL = "SELECT email from users where email = '$existingemail'";
			$result = $conn->query($checkSQL)->num_rows;
			if ($result > 0) {
				$valid = false;
				echo("<script>alert('There is already an account associated with ".$email.". Try updating with another email address.')</script>");
				echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/MyProfile.php';</script>");
			}
			if (mysqli_query($conn, $updateemailSQL)) {
			}
		}
		if(!empty($password)){
			if (strlen($password) < 6){
			$valid = false;
			echo ("<script>alert('Your Password Must Contain At Least 6 Characters!')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/MyProfile.php';</script>");

			} elseif (!preg_match("#[0-9]+#",$password)) {
				$valid = false;
				echo ("<script>alert('Your Password Must Contain At Least 1 Number!')</script>");
				echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/MyProfile.php';</script>");
		
			} elseif (!preg_match("#[A-Z]+#",$password)) {
				$valid = false;
				echo ("<script>alert('Your Password Must Contain At Least 1 Uppercase Letter!')</script>");
				echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/MyProfile.php';</script>");

			} elseif (!preg_match("#[a-z]+#",$password)) {
				$valid = false;
				echo ("<script>alert('Your Password Must Contain At Least 1 Lowercase Letter!')</script>");
				echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/MyProfile.php';</script>");
			}
			if (mysqli_query($conn, $updatepasswordSQL)) {
			}
		}
		echo("<script>alert('Information updated successfully!') </script>");
		echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/MyProfile.php';</script>");
	}
}	
	


?>