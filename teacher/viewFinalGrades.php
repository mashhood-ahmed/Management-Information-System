<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

		header("location: ../index.php");
	}
	
	if(isset($_GET['finalbtn']) && isset($_GET['cou']) && isset($_GET['section']) && isset($_GET['sem'])) {

		
		$flag = $rm->checkFinalGrades($_GET['cou']);

	}	

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<style type="text/css">

 		h5{
			margin-bottom: 20px;
			color: #292838;
			text-align: center;
		}

		h5 > div , h5 > div > span {
			color: gray;
		}

 		h2{
			
			margin-bottom: 20px;
		}

 		#cross {
			margin-top: 10px;
			margin-bottom: 10px;
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

		if($flag) {

			?>
			<div class="w3-panel w3-display-container">
			<a href="index.php?final" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
			</div>
			<?php

		} else {

		?>

		<div id="cross">
			<a href="index.php?final">X</a>
		</div>
		
		<?php	


		$tid = $_SESSION['id'];
		$cid = $_GET['cou'];
		
		$max = maxFinalScore($cid);

		$sec =  $_GET['section'];
		$sem =  $_GET['sem'];

		//$resultData = $rm->getResult($tid,$cid,$sec,$sem);
		$resultData = $dm->getStudentsBySecAndSem($sem,$sec);
		

	 ?>


 	<div id="table-box">

				<h5>
					<div><strong>Final Grades</strong></div>
				</h5>	
 		
 		<table class="table table-striped text-center">
 			<tr>
 				<th>S.NO.</th>
 				<th>REGISTRAION</th>
 				<th>NAME</th>
 				<th>SESSIONAL MARKS</th>
 				<th>MIDTERM</th>
 				<th>FINALTERM</th>
 				<th>FINAL SCORE</th>
 				<th>NORMALIZED</th> 
 				<th>GRADE</th> 
 				<th>GPA</th> 

 			</tr>


 			<?php 

 				$s = 1;
 				$scores = array();

 				while($row=mysqli_fetch_array($resultData)) {

 					$std = $row['std_id'];

 					?>	
 						<tr>
 							<td><?php echo $s++; ?></td>
 							<td><?php echo $row['reg_no']; ?></td>
 							<td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
 							<td><?php echo $se = $rm->getSessional($std,$cid,$tid); ?></td>
 							<td><?php echo $mid = $rm->getMidTerm($std,$cid,$tid); ?></td>
 							<td><?php echo $final = $rm->getFinalTerm($std,$cid,$tid); ?></td>
 							<td>
 								<?php 
 								echo $fs = $rm->finalScore($std,$cid,$tid,$se,$mid,$final);
 								?>	
 								</td>

 							<td><?php echo $n = round($rm->getNormalizeScore($max,$fs),2); ?></td>
 							<td><?php echo $g = $rm->getGrade($n); ?></td>
 							<td><?php echo $rm->getGpa($g); ?></td>
 						</tr>
 					<?php
 				}

 			 ?>

 		</table>


 		<div class="text-center">
 			<a href=".\graph\barGraph.php">View Grade Distribution Graph</a>
 		</div>



 	</div>

 	<?php } ?>

 </body>
 </html>


 <?php 

 // calculate maximum score from final scores

 function maxFinalScore($cid) {

 	global $rm;

 	$conn = new mysqli("localhost","root","","csit");

 	$query = "SELECT std_id , t_id FROM internal_marks WHERE c_id=$cid";
 	$run = mysqli_query($conn,$query);

 	$score = 0;
 	$max = 0;

 	if($run) {

 		while($row = mysqli_fetch_array($run)) {

 			$std = $row['std_id'];
 			$tid = $row['t_id'];

 			$se = $rm->getSessional($std,$cid,$tid); 
 			$mid = $rm->getMidTerm($std,$cid,$tid); 
 			$final = $rm->getFinalTerm($std,$cid,$tid);

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