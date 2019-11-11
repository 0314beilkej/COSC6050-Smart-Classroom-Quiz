<?php
	session_start();
	include('../php/session.php');
	include('../php/connect.php');

	// Get class id from URI
	$URI = $_SERVER['REQUEST_URI'];
	$class_id = substr($URI, 39);
	$result = $conn->query("select * from class where class_id = '$class_id'");
	$row = $result-> fetch_assoc();
	
	//set session variables
	if ($class_id != ""){
		$_SESSION['class_id'] = $class_id;
		$_SESSION['class_code'] = $row['class_code'];
		$_SESSION['classname'] = $row['classname'];
		$_SESSION['subject'] = $row['subject'];
	}
	
?>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!--Font Awesome-->
	<script src="https://kit.fontawesome.com/f2904e4571.js" crossorigin="anonymous"></script>
	
	<!--Google Fonts-->
	<link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,500,600" rel="stylesheet" type="text/css">
	
	<!-- Material Kit CSS -->
	<link rel="stylesheet" href="../css/HeaderSheet.css">
    <link rel="stylesheet" href="../css/Side_Main_sheet.css">
    <!--bootstrap-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/ClassInfo.css">
    

	<!-- Insert javascript Modal link-->
	<script src="../js/Modal_popup.js"></script>

	<title>Teacher's Class</title>
</head>
<body>
	<!-- Top Navigation  -->
	<header>
	<div class="logo">
		<h1 class="log-text">MarQuiz</h1>
		<h4>
		<a class= "class_name" href="#0">
		<i class="fas fa-grip-vertical" style="color:#E6E6FA"></i>&nbsp <?php echo $_SESSION['classname']?></a>
		</h4>
	</div>
	

	<i class="fa fa-bars menu-toggle"></i>
	<ul class="nav"> 
		<li>
			<a href="./TeacherHome.php"><i class="fa fa-home" style="font-size: 1.5em;"></i></a>
		</li>
		<li><a href="#0">
			<i class="fa fa-plus " style="font-size: 1.5em;"></i></a>
			<ul style="left: 0px;">
				<li><a href="#" onclick="ClickCreate()">Create Quiz</a></li>
			</ul>
		</li>
		
		<li><a href="#">
			<i class="fa fa-user"style="height:18px;font-size: .9em;"></></></i>&nbsp <?php echo $_SESSION['name']; ?><i class="fa fa-chevron-down" style="font-size: .7em;"></i></a>
			<ul>
		       <li><a href="../MyProfile.php">My profile</a></li>
		       <li><a href="../php/logout.php">Logout</a></li>
			</ul>
		</li>
	</ul>
	<!-- The Modal for Create Quiz -->
	<div id="myModal0" class="modal">
			<form action="../php/CreateQuiz.php" class="form-container" method="POST">
				<h2>Create Quiz</h2>
					<p>Enter the title of the quiz here.</p>
					<input id="quizname" name="quizname" placeholder="Quiz Title" type="text" required>
					<p>Give a quick description for the quiz (less than 100 characters).</p>
					<input id="quizdescription" name="quizdescription" placeholder="Quiz Description" type="text" required>
					<button type="submit" name="btn create" class="btn"  id="submit">Submit</button>
					<button type="button" name="btn cancel" class="btn cancel" onclick="closeForm4()">Cancel</button>
			</form>
		</div>
	<!--End of the Modal-->	
		
	</header>
	<!-- Sidebar here -->
		<!-- Sidebar here -->
 <div class="wrapper">
        <div class="sidebar">
		<ul>
			<li  class="active"><a href="./TeacherClass.php"><i class="fas fa-info-circle"></i>Class info</a></li>
			<li><a href="./ClassList.php"><i class="fas fa-users"></i>Class List</a></li>
			<li><a href="./QuizList.php"><i class="fas fa-list"></i>Quizzes</a></li>
			<li><a href="./Questions.php"><i class="fas fa-question-circle"></i>Questions</a></li> 
        </ul>
       </div>
		<!--Main content here -->
        <div class="main-section">
            <div class="dashbord">
                <div class="icon-section">
                    <i class="fas fa-lock-open" aria-hidden="true"></i><br>
                    <strong>Class Code</strong>
                    <p><?php echo $_SESSION['class_code']?></p>
                </div>
            </div>
		<div class="dashbord dashbord-green">
			<?php 
			$username = $_SESSION['username'];
			$class_code = $_SESSION['class_code'];
			// edit by Julia -- only need class code to find enrollments
			//$query= "SELECT COUNT(*) as count FROM enrollment, users WHERE enrollment.class_code= '$class_code' and users.username = '$username'"; 
			$query= "SELECT COUNT(*) as count FROM enrollment WHERE enrollment.class_code= '$class_code'"; 
			$query_run = $conn->query($query);
			while($row= mysqli_fetch_array($query_run))
				$count = $row['count'];
			{
			?>
			
				<div class="icon-section">
					<i class="fa fa-users" aria-hidden="true"></i><br>
					<strong>Total Students</strong>
					<p><?php echo $count?></p>
				</div>
			
			<?php
				}
			?>
		</div>
            <div class="dashbord dashbord-blue">
                <div class="icon-section">
                    <i class="fa fa-tasks" aria-hidden="true"></i><br>
                    <strong>Total Quizzes</strong>
                    <p>0</p>
                </div>
            </div>
        </div>
</div>
<!-- Footer: Used for any page 
	<div id="footer">
			<p> MarQuiz </p>
	</div>-->
</body>
</html>