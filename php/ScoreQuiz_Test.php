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
			$score = 0;
			$counter =0;
			$selected = $_POST['quizcheck'];
			print_r($selected);
			$questionID= $_POST['question-id'];
			$sql = "SELECT true_ans from questions WHERE question_id = $questionID";
				$result = $conn->query($sql);
            	if ($result->num_rows > 0) {
               	 while($row = $result->fetch_assoc()) {
                    $correct = $row["true_ans"];
                                        }
                                    }

            if ($selected == $correct) {
				$score++;
				$$counter++;
            }
            else {
				$counter++;
            }
			?>
			<tr>
    			<td>
    				Your Total score
				</td>
				<td colspan="2">
	    		<?php 
				echo " Your score is ". $score.".";?>
				</td>
			</tr>
        </tr>
      </table>
</body>
</html>
