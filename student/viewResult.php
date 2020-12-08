<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['reg'])) {

		header("location: ../index.php");
	}
	
	$cid = $_GET['choose'];
	$sid = $_SESSION['id'];

	$studentSection = $dm->getStudentSection($sid);
	$record = $mm->getMarks($sid,$cid);
	$c_data = $dm->getCourseData($cid);

	$res = $dm->is_DataAvaliable($sid,$cid);

	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<style type="text/css">
 		
 		h5 {
 			margin-bottom: 20px;
 			color: gray;
 		}


 		#cross {
			margin-top: 10px;
			margin-bottom: 20px;
			text-align: right;
			padding-right: 10px;
	}

		
		#cross a {
			border: 2px solid #c2c2a3;
			padding: 5px;
			color: #c2c2a3;
			border-radius: 20px;
	}

 	</style>
 </head>
 <body>

	<?php 

		if(!$res) {

			?>

		<div class="w3-panel w3-display-container">
			<a href="index.php?viewResult" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
		</div>

			<?php
		
		} else {

			$max = maxFinalScore($cid);
			$sessional = $mm->getSessional($sid,$cid);
			$mid = $mm->getMidTerm($sid,$cid);
			$finalTerm = $mm->getFinalTerm($sid,$cid);
			$finalScore = $rm->finalScore($sessional,$mid,$finalTerm);
			$normalize = $rm->getNormalizeScore($max,$finalScore);
			$grade = $rm->getGrade($normalize);
			$gpa = $rm->getGpa($grade);

	 ?>

	 	<div id="cross">
			<a title="Close" href="index.php?viewResult">X</a>
		</div>	

	<h5 class="text-center">
 	 	<div><strong>Course:</strong>&nbsp; <span><?php echo $c_data['title']; ?></span></div>
 	 	<div><strong>Semester:</strong>&nbsp; <span><?php echo $c_data['semester']; ?></span></div>
 	 	<div><strong>Section:</strong>&nbsp; <span><?php echo $studentSection; ?></span></div>
 	 	<div><strong>Session:</strong>&nbsp; <span><?php echo $c_data['session']; ?></span></div>
 	 	
 	 </h5>

 	 <table class="table table-striped text-center">
 	 	
 	 	<tr>
 	 		<th>ID</th>
 	 		<th>SESSIONAL</th>
 	 		<th>MIDTERM</th>
 	 		<th>FINALTERM</th>
 	 		<th>FINAL SCORE</th>
 	 		<th>NORMALIZED</th>
 	 		<th>GRADE</th>
 	 		<th>GPA</th>
 	 	</tr>	

 	 	<tr>
 	 		<td>1</td>
 	 		<td><?php echo $sessional; ?></td>
 	 		<td><?php echo $mid; ?></td>
 	 		<td><?php echo $finalTerm; ?></td>
 	 		<td><?php echo $finalScore; ?></td>
 	 		<td><?php echo round($normalize,2); ?></td>
 	 		<td><?php echo $grade; ?></td>
 	 		<td><?php echo $gpa; ?></td>

 	 	</tr>

 	 </table>

 	 <?php } ?>

 </body>
 </html>

 <?php 

 // calculate maximum score from final scores

 function maxFinalScore($cid) {

 	global $mm;

 	$conn = new mysqli("localhost","root","","csit");

 	$query = "SELECT std_id , t_id FROM internal_marks WHERE c_id=$cid";
 	$run = mysqli_query($conn,$query);

 	$score = 0;
 	$max = 0;

 	if($run) {

 		while($row = mysqli_fetch_array($run)) {

 			$std = $row['std_id'];
 			$tid = $row['t_id'];

 			$se = $mm->getSessional($std,$cid,$tid); 
 			$mid = $mm->getMidTerm($std,$cid,$tid); 
 			$final = $mm->getFinalTerm($std,$cid,$tid);

 			 $score = ($se*100/100) + ($mid*100/100) + ($final*100/100);

 			 if($score > $max) {

 			 	$max = $score;
 			 }
 		}
 	}

 	return $max;

 }

//////////////// end function ////////////////////////////////

  ?>