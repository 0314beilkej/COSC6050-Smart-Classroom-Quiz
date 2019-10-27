<?php
include 'connect.php';
session_start();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

	// Get form data 
	$firstname = filter_input(INPUT_POST, 'fname');
	$lastname = filter_input(INPUT_POST, 'lname');
	$username = filter_input(INPUT_POST, 'username');
	$email = filter_input(INPUT_POST, 'email');
	$password = filter_input(INPUT_POST, 'password');
	$passwordConf = filter_input(INPUT_POST, 'passwordConf');
	$role = filter_input(INPUT_POST, 'role');
	// Ensure that the account can be added.  
	$valid = TRUE;

	// Check if username exists
	if ($valid === TRUE) {
		$checkSQL = "SELECT * from users where username = '$username'";
		$result = $conn->query($checkSQL)->num_rows;
		if ($result > 0) {
			$valid = false;
			echo("<script>alert('The username ".$username." already exists.  Try a different username')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/signup.html';</script>");
			
		}
	}

	// Check if an account existst for this email address
	if ($valid === TRUE){
		$checkSQL = "SELECT * from users where email = '$email'";
		$result = $conn->query($checkSQL)->num_rows;
		if ($result > 0) {
			$valid = false;
			echo("<script>alert('There is already an account associated with ".$email.". Try signing up with another email address.')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/signup.html';</script>");
		}
	}
	
	//Verify passwords match and are the proper criteria
	if ($valid === TRUE){
		if ($password !== $passwordConf){
			$valid = false;
			echo ("<script>alert('Passwords do not match!')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/signup.html';</script>");

		// Validate password strength
		} elseif (strlen($password) < 6){
			$valid = false;
			echo ("<script>alert('Your Password Must Contain At Least 6 Characters!')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/signup.html';</script>");

		} elseif (!preg_match("#[0-9]+#",$password)) {
			$valid = false;
			echo ("<script>alert('Your Password Must Contain At Least 1 Number!')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/signup.html';</script>");
	
		} elseif (!preg_match("#[A-Z]+#",$password)) {
			$valid = false;
			echo ("<script>alert('Your Password Must Contain At Least 1 Uppercase Letter!')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/signup.html';</script>");

		} elseif (!preg_match("#[a-z]+#",$password)) {
			$valid = false;
			echo ("<script>alert('Your Password Must Contain At Least 1 Lowercase Letter!')</script>");
			echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/signup.html';</script>");
		}
	}

	// If the account information is valid, insert into user table
	if ($valid === TRUE) {
		$newUserSQL = "insert into users (username, firstname, lastname, email, password, role) values ('$username', '$firstname', '$lastname', '$email', '$password', '$role')";
		if ($conn->query($newUserSQL) === TRUE) {
			$checkSQL = "SELECT username, role from users where username = '$username' and password = '$password'";
			$result = $conn->query($checkSQL);
			while ($row = $result-> fetch_assoc()) {
				$_SESSION['username'] = $username;
				if ($row["role"] == "Teacher") {
					echo ("<script>alert('Your account has been successfully created. Click OK to view your homepage.')</script>");
					echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/TeacherHome.php';</script>");
				} else {
					echo ("<script>alert('Your account has been successfully created. Click OK to view your homepage.')</script>");
					echo("<script>window.location = 'https://pascal.mscsnet.mu.edu/quiz/StudentHome.php';</script>");
			}
			}
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}
?>