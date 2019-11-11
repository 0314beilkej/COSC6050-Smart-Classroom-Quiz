<?php
	session_start();
	include('../php/connect.php');
	include('../php/session.php');


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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
    
	<!-- Material Kit CSS -->
	<link rel="stylesheet" href="../css/HeaderSheet.css">
	<link rel="stylesheet" href="../css/TakeQuiz_style.css">

    <!--bootstrap-->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>Take Quiz</title>
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
		<li><a href="#">
			<i class="fa fa-user"style="height:18px;font-size: .9em;"></></></i>&nbsp <?php echo $_SESSION['name']; ?><i class="fa fa-chevron-down" style="font-size: .7em;"></i></a>
			<ul style="	z-index: 100; ">
		       <li><a href="../MyProfile.php">My profile</a></li>
		       <li><a href="../php/logout.php">Logout</a></li>
			</ul>
		</li>
	</ul>
    </header> 
	<div id="container">
                <h1> Quiz is Starting </h1>
				<p>Time left <b>00:00</b></p>
				<hr style="border-top: dotted 1px;" /><br>
            <section>
				<form action="grade.php" method="post" id="results">
					<ol>
						<li>
							<h3>1. CSS Stands for...</h3>
							<div>
								<input type="radio" name="question-1-answers" id="question-1-answers-A" value="A" />
								<label for="question-1-answers-A">A) Computer Styled Sections </label>
							</div>
							<div>
								<input type="radio" name="question-1-answers" id="question-1-answers-B" value="B" />
								<label for="question-1-answers-B">B) Cascading Style Sheets</label>
							</div>
							<div>
								<input type="radio" name="question-1-answers" id="question-1-answers-C" value="C" />
								<label for="question-1-answers-C">C) Crazy Solid Shapes</label>
							</div>
							<div>
								<input type="radio" name="question-1-answers" id="question-1-answers-D" value="D" />
								<label for="question-1-answers-D">D) None of the above</label>
							</div>
						</li>
						<li>
                		<h3>2. Internet Explorer 6 was released in...</h3>
                    	<div>
                        	<input type="radio" name="question-2-answers" id="question-2-answers-A" value="A" />
                        	<label for="question-2-answers-A">A) 2001</label>
                    	</div>
                    	<div>
                        	<input type="radio" name="question-2-answers" id="question-2-answers-B" value="B" />
                        	<label for="question-2-answers-B">B) 1998</label>
                   		 </div>
                    	<div>
                        	<input type="radio" name="question-2-answers" id="question-2-answers-C" value="C" />
                        	<label for="question-2-answers-C">C) 2006</label>
                   		</div>
                   		<div>
                        	<input type="radio" name="question-2-answers" id="question-2-answers-D" value="D" />
                        	<label for="question-2-answers-D">D) 2003</label>
						</div>
						</li>
					</ol><br>
						<input type="submit" value="Submit Answers">
                </form>
            </section>
    </div>        
	<!-- Footer: Used for any page 
	<div id="footer">
			<p> MarQuiz </p>
	</div>-->
</body>
</html>