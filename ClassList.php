<?php
	session_start();
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
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,500,600" rel="stylesheet" type="text/css">
	
	<!-- Material Kit CSS -->
	<link rel="stylesheet" href="css/HeaderSheet.css">
    	<link rel="stylesheet" href="css/Side_Main_sheet.css">
    <!--bootstrap-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/ClassInfo.css">
    

	<!-- Insert javascript Modal link-->
	<script src="js/Modal_popup.js"></script>
	
	<style>
		table {
		  
		  width: 100%;
		 
		}

		 th, td {
		  text-align: left;
		  padding: 8px;
		  border-bottom: 1px solid #ddd;
		}

		 tr:nth-child(even){background-color: #f2f2f2}

		th {
		  
		
		}
	</style>

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
			<a href="TeacherHome.php"><i class="fa fa-home" style="font-size: 1.5em;"></i></a>
		</li>
		<li><a href="#0">
			<i class="fa fa-plus " style="font-size: 1.5em;"></i></a>
			<ul style="left: 0px;">
				<li><a href="/CreateQuiz.html">Create Quiz</a></li>
			</ul>
		</li>
		
		<li><a href="#">
			<i class="fa fa-user"style="font-size: .9em;"></></></i>&nbsp <?php echo $_SESSION['name']; ?><i class="fa fa-chevron-down" style="font-size: .7em;"></i></a>
			<ul>
		       <li><a href="MyProfile.php">My profile</a></li>
		       <li><a href="#">Settings</a></li>
		       <li><a href="php/logout.php">Logout</a></li>
			</ul>
		</li>
	</ul>
	<!-- The Modal for create class -->
	<div id="myModal" class="modal">
			<form action="php/CreateClass.php" class="form-container" method="POST">
				<h2>Create class</h2>
					<input id="classname" name="classname" placeholder="Class Name" type="text" required>
					<input id="instructorID" name="instructorID" placeholder="Instructor ID" type="text" required>
					<select id="subject" name="subject" required>
						<option name="">--Subject--</option>
      						<option name="Bioinformatics" value="Bioinformatics">Bioinformatics</option>
      						<option name="Biology" value="Biology">Biology</option>
						<option name="Business Administration" value="Business Administration">Business Administration</option>
						<option name="Computing" value="Computing">Computing</option>
						<option name="Mathematics" value="Mathematics">Mathematics</option>
					</select>
					<button type="submit" name="btn create" class="btn"  id="submit">Create</button>
					<button type="button" name="btn cancel" class="btn cancel" onclick="closeForm()">Cancel</button>
			</form>
	</div>
	<!--End of the Modal-->
		
	</header>
	<!-- Sidebar here -->
		<!-- Sidebar here -->
 <div class="wrapper">
        <div class="sidebar">
		<ul>
         		<li><a href="./TeacherClass.php"><i class="fas fa-info-circle"></i>Class info</a></li>
	 		<li class="active"><a href="./ClassList.php"><i class="fas fa-users"></i>Class List</a></li>
          		<li><a href="./QuizList.html"><i class="fas fa-list"></i>Quizzes</a></li>
		  	<li><a href="./Question.html"><i class="fas fa-question-circle"></i>Question Bank</a></li>  
       		</ul>
       </div>
		<!--Main content here -->
        <div class="main_content">
			<table class="table">
				<thead>
					<tr>
					  <th>#</th>
					  <th style="width: 350px;">First Name</th>
					  <th style="width: 350px;">Last Name</th>
					  <th style="width: 350px;">Username</th>
					</tr>
			  </thead>
			  <tbody>
				  <?php 
					$classcode= $_SESSION['class_code'];
					$query= "SELECT distinct e.student_id, u.firstname,u.lastname FROM enrollment e, users u WHERE e.class_code = '$classcode' AND e.student_id = u.username"; 
					$query_run = $conn->query($query);
					$count = 0;
					while($row= mysqli_fetch_array($query_run)){
						$count++;
						$stu_first = $row['firstname'];
						$stu_last = $row['lastname'];
						$stu_id = $row['student_id'];
					
					?>
						<tr>
						  <th scope="row"><?php echo $count; ?></th>
						  <td><?php echo $stu_first; ?></td>
						  <td><?php echo $stu_last; ?></td>
						  <td><?php echo $stu_id; ?></td>
						</tr>
					<?php
					}
					?>
			  </tbody>
			</table>
           
        </div> 
</div>
<!-- Footer: Used for any page 
	<div id="footer">
			<p> MarQuiz </p>
	</div>-->
</body>
</html>