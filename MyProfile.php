<?php
include('php/session.php');
include('php/connect.php');
?>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!--Font Awesome-->
	<script src="https://kit.fontawesome.com/f2904e4571.js" crossorigin="anonymous"></script>
	
	<!--Google Fonts-->
	<link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
	
	<!-- Material Kit CSS -->
	<link rel="stylesheet" href="css/HeaderSheet.css">
	<link rel="stylesheet" href="css/Side_Main_sheet.css">

	<!-- Insert javascript Modal link-->
	<script src="js/Modal_popup.js"></script>
	
	<title>Teacher's Homepage</title>
</head>
<body>

	<!-- Top Navigation  -->
<header>
	<i class="fa fa-bars menu-toggle"></i>
	<ul class="nav"> 
		<li>
			<a href=
				<?php 
					$user_role = $_SESSION['role'];
					If ($user_role === "Student")
						echo "StudentHome.php";
					else if ($user_role === "Teacher")
						echo "TeacherHome.php";
					else
						echo "#";
				?>
			><i class="fa fa-home" style="font-size: 1.5em;"></i></a>
		</li>
		
		<li><a href="#">
			<i class="fa fa-user"style="font-size: .9em;"></></></i>&nbsp <?php echo $_SESSION['name']; ?><i class="fa fa-chevron-down" style="font-size: .7em;"></i></a>
			<ul>
		       <li><a href="MyProfile.php">My profile</a></li>
		       <li><a href="#">Settings</a></li>
		       <li><a href="https://pascal.mscsnet.mu.edu/quiz/">Logout</a></li>
			</ul>
		</li>
	</ul>
</header>
	<!-- Main -->
<main>
	<div class="content-box">
		
	</div>
</main>
<!-- Footer: Used for any page 
	<div id="footer">
			<p> MarQuiz </p>
	</div>-->
</body>
</html>