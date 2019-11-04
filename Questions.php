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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
    
	<!-- Material Kit CSS -->
	<link rel="stylesheet" href="css/HeaderSheet.css">
    <link rel="stylesheet" href="css/Side_Main_sheet.css">
    <link rel="stylesheet" href="css/Questions_style.css">

    <!--bootstrap-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
	<!-- Insert javascript Modal link-->
    <script src="js/Modal_popup.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Questions</title>
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
			<ul style="left: 0px; z-index: 100;">
				<li><a href="/CreateQuiz.html">Create Quiz</a></li>
			</ul>
		</li>
		
		<li><a href="#">
			<i class="fa fa-user"style="height:18px;font-size: .9em;"></></></i>&nbsp <?php echo $_SESSION['name']; ?><i class="fa fa-chevron-down" style="font-size: .7em;"></i></a>
			<ul style="	z-index: 100; ">
		       <li><a href="MyProfile.php">My profile</a></li>
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
	      <li><a href="./ClassList.php"><i class="fas fa-users"></i>Class List</a></li>
          <li><a href="./QuizList.html"><i class="fas fa-list"></i>Quizzes</a></li>
	       <li class="active"><a href="./Questions.php"><i class="fas fa-question-circle"></i>Questions</a></li>  
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
                                        <select name="quizname" class="form-control" maxlength="20" required>
                                            <option name= "quiz1">quiz #</option>
                                        </select>
                                        <a href="#addQuestionModal" class="btn" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Question</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width:400px;">Questions</th>
                                <th style="width:400px;">Answer</th>
                                <th style="width:400px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>what is....?</td>
                                <td>Answer A</td>
                                <td>
                                    <a href="#editQuestionModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a href="#deleteQuestionModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Add Modal HTML -->
            <div id="addQuestionModal" class="modal">
                    <form action="" class="form-container" method="POST">
                        <h2>Add a new question</h2>
                        <br>
                            <textarea rows="2" placeholder="Enter the question here" name="q_name" ></textarea>
                            <textarea rows="2" placeholder="Enter Answer (A)" name="opt_1" ></textarea>
                            <textarea rows="2" placeholder="Enter Answer (B)" name="opt_2" ></textarea>
                            <textarea  rows="2" placeholder="Enter Answer (C)" name="opt_3" ></textarea>
                            <textarea  rows="2" placeholder="Enter Answer (D)" name="opt_4" ></textarea>
                            <select name="true_ans" required>
                                        <option name="">--Correct Answer--</option>
                                        <option name= "A">A</option>
                                        <option name= "B">B</option>
                                        <option name= "C">C</option>
                                        <option name= "D">D</option>
                            </select>
                            <input type="button" class="btn cancel" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn" value="Add">
                    </form>
            </div>
            <!-- Edit Modal HTML -->
            <div id="editQuestionModal" class="modal">
                    <form action="" class="form-container" method="POST">
                            <h2>Edit the question</h2>  
                            <br>
                                <textarea rows="2" placeholder="Enter the question here" name="q_name" ></textarea>
                                <textarea rows="2" placeholder="Enter Answer (A)" name="opt_1" ></textarea>
                                <textarea rows="2" placeholder="Enter Answer (B)" name="opt_2" ></textarea>
                                <textarea  rows="2" placeholder="Enter Answer (C)" name="opt_3" ></textarea>
                                <textarea  rows="2" placeholder="Enter Answer (D)" name="opt_4" ></textarea>
                                <select name="true_ans" required>
                                            <option name="">--Correct Answer--</option>
                                            <option name= "A">A</option>
                                            <option name= "B">B</option>
                                            <option name= "C">C</option>
                                            <option name= "D">D</option>
                                </select>
                                <input type="button" class="btn cancel" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn" value="Edit">
                        </form>
                
            </div>
            <!-- Delete Modal HTML -->
            <div id="deleteQuestionModal" class="modal">
                <form class="form-container">
                    <br>
                    <h4>Delete Question</h4>
                    <br>					
                    <p>Are you sure you want to delete these Record?</p>
                    <br>
                    <input type="button" class="btn cancel" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn" value="Delete">
                </form>
            </div>
    </div>
<!-- Footer: Used for any page 
	<div id="footer">
			<p> MarQuiz </p>
	</div>-->
</body>
</html>
