<?php
	session_start();
	include('../php/connect.php');
	include('../php/session.php');
	include('../php/GenerateQuiz.php');
	
	// Get quiz id from URI
	$URI = $_SERVER['REQUEST_URI'];
	$quiz_id = substr($URI, 36);
	$quiz_id = $_GET['id'];
    $_SESSION['quiz_id'] = $quiz_id;
    
    $class_id = $_SESSION['class_id'];
?>
<html>
<head></head>
<body>
<table class="table text-center table-bordered table-hover">
      	<tr>
      		<th colspan="2" class="bg-dark"> <h1 class="text-white"> Results </h1></th>
      		
      	</tr>
      	<tr>
		      	<td>
		      		Questions Attempted
				  </td>
			<?php
			$counter = 0;
			$Resultans = 0;
                if(isset($_POST['submit'])){
                	if(!empty($_POST['quizcheck'])){
            		// Counting number of checked checkboxes.
						$checked_count = count($_POST['quizcheck']);
					}
				}	
            ?>
        	<td>
            <?php
			echo "Out of ??, You have attempt ".$checked_count. " options.";?>
			</td>
			
			<?php
			// Loop to store and display values of individual checked checkbox.
			$selected = $_POST['quizcheck'];
			print_r($selected);
			//$result = 0;
		foreach ($_SESSION['question_ids'] as $index=>$cur_question_id){
				$q1= "SELECT true_ans FROM questions WHERE question_id = '$cur_question_id'";
				$ans_run = $conn->query($q1);
           		 $i = 1;
            	while($rows = mysqli_fetch_array($ans_run)) {
					$flag = $rows['ans'] == $selected[$i];
            	
					if($flag){
						// echo "correct ans is ".$rows['ans']."<br>";				
						$counter++;
						$Resultans++;
						// echo "Well Done! your ". $counter ." answer is correct <br><br>";
					}else{
						$counter++;
						// echo "Sorry! your ". $counter ." answer is innncorrect <br><br>";
					}					
				$i++;		
			}
		}
			?>
			<tr>
    			<td>
    				Your Total score
				</td>
				<td colspan="2">
	    		<?php 
				echo " Your score is ". $Resultans.".";?>
				</td>
			</tr>
        </tr>
      </table>
</body>
</html>
