<?php
	session_start();
	include('../php/session.php');
	include('../php/connect.php');
	
	// Get quiz id from URI
	$URI = $_SERVER['REQUEST_URI'];
	//$quiz_id = substr($URI, 36);
	$quiz_id = $_GET['id'];
	$_SESSION['quiz_id'] = $quiz_id;

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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
    
	<!-- Material Kit CSS -->
	<link rel="stylesheet" href="../css/HeaderSheet.css">
    <link rel="stylesheet" href="../css/Side_Main_sheet.css">
    <link rel="stylesheet" href="../css/Questions_style.css">

    <!--bootstrap-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
	<!-- Insert javascript Modal link-->
    <script src="../js/Modal_popup.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</script>
	
	<!-- Scripts for passing info to modals -->
	 <script type="text/javascript">
		$( document ).ready(function() {
			 $('.delete').click(function (e) {
				e.preventDefault();
				var link = this;
				var deleteModal = $("#deleteQuestionModal");
				// store the ID inside the modal's form
				deleteModal.find('input[name=id]').val(this.dataset.id2);
			});
		});
    </script>
	
    <title>Grades</title>
</head>
<body>
	<!-- Top Navigation  -->
	<header>
	<div class="logo">
		<h1 class="log-text">MarQuiz</h1>
		<h4>
		<a class= "class_name" href="#0">
		<i class="fas fa-grip-vertical" style="color:#E6E6FA"></i>&nbsp <?php echo $_SESSION['classname'];?></a>
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
				<li><a href="#" onclick="ClickCreate()">Create Quiz</a></li>
			</ul>
		</li>
		
		<li><a href="#">
			<i class="fa fa-user"style="height:18px;font-size: .9em;"></></></i>&nbsp <?php echo $_SESSION['name']; ?><i class="fa fa-chevron-down" style="font-size: .7em;"></i></a>
			<ul style="	z-index: 100; ">
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
          <li><a href="./TeacherClass.php"><i class="fas fa-info-circle"></i>Class info</a></li>
	      <li><a href="./ClassList.php"><i class="fas fa-users"></i>Class List</a></li>
          <li><a href="./QuizList.php"><i class="fas fa-list"></i>Quizzes</a></li>
		  <li><a href="./Questions.php"><i class="fas fa-question-circle"></i>Questions</a></li>
		  <li class="active"><a href="./TeacherGrades.php"><i class="fas fa-bar-chart"></i>Grades</a></li>
        </ul>
       </div>
	<!--Main content here -->
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group col-md-4">
                                        <label>Select Quiz name: </label>&nbsp
										<select name="quiz_id" class="form-control" maxlength="20" onchange="location = this.value"required>
											<option value= "TeacherGrades.php">All Quizzes</option>
											<?php 
												// list all quizzes for the teacher and class
												$instructor_id = $_SESSION['username'];
												$class_id = $_SESSION['class_id'];
												$query = "select quiz_name, quiz_id from quizzes where instructor_id = '$instructor_id' and class_id ='$class_id'";
												$query_run = $conn->query($query);
												while($row = mysqli_fetch_array($query_run)){
													$row_quiz_name = $row['quiz_name'];
													$row_quiz_id = $row['quiz_id'];
											?>
												<option value= "TeacherGrades.php?id=<?php echo $row_quiz_id; ?>" <?php if ($row_quiz_id == $quiz_id) { echo "selected";}?>><?php echo $row_quiz_name; ?></option>
											<?php 
												}
											?>
										</select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th style="width:400px;">Attempts Taken</th>
                                <th style="width:400px;">Best Score</th>
                                <th style="width:400px;">First Attempt Score</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php 
								if ($quiz_id == $quiz_id) {
									$grades_query = "SELECT * from scores where quiz_id = '$quiz_id'";
									
								} elseif ($quiz_id == "") {
									$grades_query = "SELECT a.question_id, a.question, case a.true_ans when 'A' then a.ans_a when 'B' then a.ans_b when 'C' then a.ans_c when 'D' then a.ans_d end as answer from questions a, quizzes b where a.quiz_id = b.quiz_id and b.instructor_id = '$instructor_id'";
									//$question_query = "select a.question, a.correct_answer from questions_2 a, quizzes b where a.quiz_id = b.quiz_id and b.instructor_id = '$instructor_id'";
							
									
								}
								$query_run = $conn->query($grades_query);
								while($row = mysqli_fetch_array($query_run)){
										$row_student = $row['student_id'];
										$row_attempts = $row['attempt_count'];
										$row_best_score = $row['best_score'];
										$row_first_attempt_score = $row['first_attempt_score'];
							?>
								<tr>
									<td><?php echo $row_student; ?></td>
									<td><?php echo $row_attempts; ?></td>
									<td><?php echo $row_best_score; ?></td>
									<td><?php echo $row_first_attempt_score; ?></td>
								</tr>
							<?php
								}
							?>
                        </tbody>
                    </table>
                </div>
            </div> 
    </div>
<!-- Footer: Used for any page 
	<div id="footer">
			<p> MarQuiz </p>
	</div>-->
</body>
</html>