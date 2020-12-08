<?php 

	if(!isset($_SESSION['id']) && !isset($_SESSION['reg'])) {

		header("location: ../index.php");
	}

	$cid = $_GET['choose'];
	$sid = $_SESSION['id'];

	$studentSection = $dm->getStudentSection($sid);
	$record = $mm->getMarks($sid,$cid);
	$c_data = $dm->getCourseData($cid);
	//$std_classes = $dm->studentClasses($sid,$cid);
	//$teacher_classes = $dm->teacherClasses($sid,$cid);
	//$percentage = ceil(($std_classes / $teacher_classes) * 100);	
	//$marks = calMarks($percentage);
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
			text-align: left;
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
 	
 <div id="int_cont">

 	

 	<?php 

 		if(mysqli_num_rows($record) < 1) {

 			?>

			<div class="w3-panel w3-display-container">
			<a href="index.php?viewMark" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
		</div>

			<?php
 		
 		} else { 

 	 ?>
 	
 	 <div id="cross">
		<a href="index.php?viewMark">X</a>
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
 	 		<th>QUIZ 1</th>
 	 		<th>QUIZ 2</th>
 	 		<th>QUIZ 3</th>
 	 		<th>QUIZ 4</th>
 	 		<th>QUIZ 5</th>
 	 		<th>QUIZ 6</th>
 	 		<th>ASSIGNMENT 1</th>
 	 		<th>ASSIGNMENT 2</th>
 	 		<th>ASSIGNMENT 3</th>
 	 		<th>ASSIGNMENT 4</th>
 	 		<th>ASSIGNMENT 5</th>
 	 		<th>ASSIGNMENT 6</th>
 	 		<th>PARTICIPATION</th>
 	 		<th>PRESENTATION</th>
 	 		<th>MIDTERM</th>
 	 		<th>FINALTERM</th>
 	 	</tr>

 	 	<?php 

 	 		$id = 1;

 	 		while($data = mysqli_fetch_array($record)) {

 	 			?>
 	 				<tr>
 	 					<td><?php echo $id++; ?></td>
 	 					<td><?php echo $data['q1']; ?></td>
 	 					<td><?php echo $data['q2']; ?></td>
 	 					<td><?php echo $data['q3']; ?></td>
 	 					<td><?php echo $data['q4']; ?></td>
 	 					<td><?php echo $data['q5']; ?></td>
 	 					<td><?php echo $data['q6']; ?></td>	
 	 					<td><?php echo $data['a1']; ?></td>
 	 					<td><?php echo $data['a2']; ?></td>
 	 					<td><?php echo $data['a3']; ?></td>
 	 					<td><?php echo $data['a4']; ?></td>
 	 					<td><?php echo $data['a5']; ?></td>
 	 					<td><?php echo $data['a6']; ?></td>
 	 					<td><?php echo $data['participation']; ?></td>
 	 					<td><?php echo $data['presentation']; ?></td>
 	 					<td><?php echo $data['mid']; ?></td>
 	 					<td><?php echo $data['final']; ?></td>

 	 						
 	 					
 	 				</tr>
 	 			<?php

 	 		}

 	 	 ?>

 	 </table>

 	 <?php } ?>

 	 </div>

 </body>
 </html>