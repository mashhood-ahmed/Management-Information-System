<?php 
if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

		header("location: ../index.php");
	}
 ?>

<?php 

	if(isset($_GET['cou']) && isset($_GET['sem']) && isset($_GET['section']) && isset($_GET['mbtn']) && isset($_GET['week'])) {


		$cId = $_GET['cou'];
		$credit = $am->getCourseCredit($cId);
		$tid = $_SESSION['id'];
		$course = $dm->getCourseId($cId);
		$semester = $_GET['sem'];
		$section = $_GET['section'];
		$week = $_GET['week'];
		$session_class =  $dm->getSessionAndClass($cId,$_SESSION['id']);
		$student = $am->getRanStdRec($cId,$semester,$section);
		$teaherClasses = $am->calTeaClasses($tid,$cId,$student) * $credit;
		$date = $am->getDate($semester,$section,$cId,$week,$tid);
		$attendance = $am->getAttendance($semester,$section,$cId,$week,$tid);

	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
<!-- internal css is used -->
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
 	
 	
 	<?php 

 		if(mysqli_num_rows($attendance) > 0) {

 			?>

 			<div id="cross">
				<a href="index.php?viewAttendance">X</a>
			</div>	

			<h5>
				<div><strong>Course:</strong> <span><?php echo $course; ?></span></div>
				<div><strong>Semester:</strong> <span><?php echo $semester; ?></span></div>
				<div><strong>Section:</strong> <span><?php echo $section; ?></span></div>
				<div><strong>Week:</strong> <span><?php echo $week; ?></span></div>
				<div><strong>Session:</strong> <span><?php echo $session_class[0]; ?></span></div>
			</h5>

 			<?php 
 		

 	 ?>


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
 			<th>UPDATE</th>
 		</tr>

 		<?php 

 			while($row=mysqli_fetch_array($attendance)) {

 				$sid = $row['std_id'];

 				?>
 				<tr>
 					<td><?php echo $row['reg_no'] ?></td>
 					<td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
 					<td><?php echo $row['attendance']; ?></td>
 					<td><?php echo $row['date']; ?></td>
 					<td><?php echo $stdC=$am->calStdClasses($row['std_id'],$cId) * $credit; ?></td>
 					<td><?php echo $prcn=ceil($stdC/$teaherClasses*100); ?>%</td>
 					<td><?php echo calMarks($prcn); ?></td>

 					<td><a class="btn btn-primary" href="./index.php?updAtt=<?php echo $row['at_id']; ?>&cou=<?php echo $cId; ?>&sem=<?php echo $semester; ?>&sec=<?php echo $section; ?>&wek=<?php echo $week; ?>">Update</a></td>
 					
 				</tr>
 				<?php 
 			}
 		 ?>
 	
 	</table>

 	

 	</div>

 	<?php 

 		} else {

 			?>

 			<div class="w3-panel w3-display-container">
			<a href="index.php?viewAttendance" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
			</div>
 		
		<?php 

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