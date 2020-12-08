<?php 

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}
	
	if(isset($_GET['cou']) && isset($_GET['section']) && isset($_GET['sem']) && isset($_GET['week']) && isset($_GET['mbtn'])) {

							
			$course = $_GET['cou'];
			$sec = $_GET['section'];
			$sem = $_GET['sem'];
			$week = $_GET['week'];

			$cTitle = $am->getCourseTitle($course);
			$session_class = $am->getSessionAndClass($course);
			$record = $am->getAttendanceBy($course,$sec,$sem,$week);
			$student = $am->getRanStdRec($course,$sem,$sec);
			$credit = $am->getCourseCredit($course);
			$teaherClasses = $am->calTeaClasses($course,$student) * $credit;
			

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

		h2{
			margin-top: 20px;
			margin-bottom: 20px;
		}

		h5 > div , h5 > div > span {
			color: gray;
		}

		label{
			color: #17639e;
		}

		
		#table-box {
			
			width: 1000px;
			margin: 0px auto 20px auto;
		
		}

 		#cross {
			margin-top: 10px;
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
 	
 	<div id="cross">
		<a href="index.php?atten">X</a>
	</div>

		<?php if(mysqli_num_rows($record) > 0) { ?>

		<h5>
			<div><strong>Course:</strong> <span><?php echo $cTitle; ?></span></div>
			<div><strong>Semester:</strong> <span><?php echo $sem; ?></span></div>
			<div><strong>Section:</strong> <span><?php echo $sec; ?></span></div>
			<div><strong>Week:</strong> <span><?php echo $week; ?></span></div>
			<div><strong>Session:</strong> <span><?php echo $session_class[0]; ?></span></div>
			
		</h5>

 	<div id="table-box">

 	<table class="table text-center table-striped text-center">
 		
 		<tr>
 			<td align="left" class="text-primary" colspan="10">Total Classes Taken By Teacher:<?php echo $teaherClasses; ?></td>
 		</tr>

 		<tr>

 			<th>REGISTRATION</th>
 			<th>STUDENT</th>
 			<th>ATTENDANCE</th>
 			<th>DATE</th>
 			<th>STUDENT CLASSES</th>
 			<th>%AGE</th>
 			<th>MARKS</th>
 			<th>DELETE</th>

 		</tr>

 		<?php 

 			while($row=mysqli_fetch_array($record)) {

 				$sid = $row['std_id'];

 				?>
 				<tr>
 					<td><?php echo $row['reg_no'] ?></td>
 					<td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
 					<td><?php echo $row['attendance']; ?></td>
 					<td><?php echo $row['date']; ?></td>
 					<td><?php echo $stdC=$am->calStdClasses($row['std_id'],$course) * $credit; ?></td>
 					<td><?php echo $prcn=ceil($stdC/$teaherClasses*100); ?>%</td>
 					<td><?php echo calMarks($prcn); ?></td>
 					<td><a href="" class="btn btn-danger" onclick="deleteC('<?php echo $row['at_id'] ?>')">DELETE</a></td>
 					
 				</tr>
 				<?php 
 			}
 		 ?>
 	
 	</table>

 	

 	</div>

 	<?php 

 		} else {

 			echo "<h2>No Records Found</h2>";
 		} 

 	 ?>

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

<script type="text/javascript">
	
	function deleteC(id) {

		let i = id;
		let xhttp = new XMLHttpRequest();

		xhttp.open("GET","./DeleteStudentRecordAjax.php?i="+i,true);
		xhttp.send();
	}

</script>

 </body>
 </html>