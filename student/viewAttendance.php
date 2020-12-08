<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['reg'])) {

		header("location: ../index.php");
	}
	
	$cid = $_GET['choose'];
	$sid = $_SESSION['id'];

	$creditHr = $dm->getCourseCredit($cid);

	$studentSection = $dm->getStudentSection($sid);
	$record = $dm->getAttendance($sid,$cid);
	$c_data = $dm->getCourseData($cid);
	$std_classes = $dm->studentClasses($sid,$cid,$creditHr);
	$teacher_classes = $dm->teacherClasses($sid,$cid,$creditHr);
	if($teacher_classes == 0) {$teacher_classes = 1;}
	$percentage = ceil(($std_classes / $teacher_classes) * 100);	
	$marks = calMarks($percentage);

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

 		if(mysqli_num_rows($record) < 1) {

 			?>

		<div class="w3-panel w3-display-container">
			<a href="index.php?viewAttendance" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
		</div>

			<?php
 		
 		} else {

 	 ?>
 			
 	 <div id="cross">
		<a href="index.php?viewAttendance">X</a>
	</div>	


 	 <h5 class="text-center">
 	 	<div><strong>Course:</strong>&nbsp; <span><?php echo $c_data['title']; ?></span></div>
 	 	<div><strong>Semester:</strong>&nbsp; <span><?php echo $c_data['semester']; ?></span></div>
 	 	<div><strong>Section:</strong>&nbsp; <span><?php echo $studentSection; ?></span></div>
 	 	<div><strong>Session:</strong>&nbsp; <span><?php echo $c_data['session']; ?></span></div>
 	 </h5>


 	<table class="table table-striped text-center">

 		<tr>
 			<td style="font-size: 20px;" colspan="5"><strong>Attendance Marks</strong>&nbsp;<?php echo $marks; ?>&nbsp;| <strong>Total Classes Taken By Student</strong>&nbsp;<?php echo $std_classes; ?>&nbsp;| <strong>Percentage</strong>&nbsp;<?php echo $percentage . "%"; ?>&nbsp;| <strong>Total Classes Taken By Teacher</strong>&nbsp;<?php echo $teacher_classes; ?></td>
 		</tr>

 		<tr>
 			<th>ID</th>
 			<th>ATTENDANCE</th>
 			<th>WEEK</th>
 			<th>DATE</th>
 		</tr>

 		<?php 

 			$id = 1;

 			while($data=mysqli_fetch_array($record)){

 				?>
 				<tr>
 					<td><?php echo $id++; ?></td>
 					<td><?php echo $data['attendance']; ?></td>
 					<td><?php echo $data['week']; ?></td>
 					<td><?php echo $data['date']; ?></td>
 				</tr>	
 				<?php
 			}

 		 ?>

 	</table>

 	<?php } ?>

 </body>
 </html>

 <?php 

 	// function to calculate attendance marks

 	function calMarks($p) {

 		$marks = 0;

 		if($p >= 95) {

 			$marks = 5;
 		
 		} else if($p >= 90 && $p < 95) {

 			$marks = 4.5;
 		
 		}else if($p >= 85 && $p < 90) {

 			$marks = 4;

 		} else if($p >= 80 && $p < 85) {

 			$marks = 3.5;

 		} else if($p >= 75 && $p < 80) {

 			$marks = 3;

 		} else if($p >= 70 && $p < 75) {

 			$marks = 2.5;
 		
 		} else if($p >= 65 && $p < 70) {

 			$marks = 2;
 		
 		}else if($p >= 60 && $p < 65) {

 			$marks = 1.5;
 		
 		}else if($p >= 55 && $p < 60) {

 			$marks = 1;
 		
 		}else if($p >= 50 && $p < 55) {

 			$marks = 0.5;
 		
 		} else {

 			$marks = 0;
 		}

 		
 		return $marks;
 	}


  ?>