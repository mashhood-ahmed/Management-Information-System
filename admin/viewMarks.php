<?php 
	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

	if(isset($_GET['cou']) && isset($_GET['section']) && isset($_GET['sem'])  && isset($_GET['abtn'])) {

		$cid = $_GET['cou'];
		$cTitle = $am->getCourseTitle($cid);
		$sec = $_GET['section'];
		$sem = $_GET['sem'];
		$session_class = $am->getSessionAndClass($cid);

		$flag = $km->checkMarks($cid);

		$rec = $mm->getMarks($cid,$sec,$sem);
	}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<!-- internal css is used -->
	<style type="text/css">
		h5{
			margin-top: 20px;
			margin-bottom: 20px;
			color: #292838;
			text-align: center;
		}	

		h2 {
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
			margin: 0px auto 20px auto;
			/*text-align: center;*/
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
 	
 <!-- 	<div id="cross">
		<a href="index.php?marks">X</a>
	</div>	
 -->
	<?php 

	if(!$flag) {

		?>

		<div class="w3-panel w3-display-container">
			<a href="index.php?marks" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
		</div>

		<?php

	} else {

	 ?>
 	
 	<h5>
 		<div><strong>Course:</strong> <span><?php echo $cTitle; ?></span></div>
 		<div><strong>Semester:</strong> <span><?php echo $sem; ?></span></div>
 		<div><strong>Section:</strong> <span><?php echo $sec; ?></span></div>
 		<div><strong>Session:</strong> <span><?php echo $session_class[0]; ?></span></div>
  	</h5>

 

 	<div id="table-box">

 	<table class="table text-center table-striped">
 		
 		<tr>
 			<th>ID</th>
 			<th>REGISTRATION</th>
 			<th>STUDENT</th>
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
 			<th>DELETE</th>
 		</tr>

 		<?php 

 			$id = 0;

 			while($row=mysqli_fetch_array($rec)) {

 				?>
 				<tr>
 				<td><?php echo ++$id; ?></td>
 				<td><?php echo $row['reg_no']; ?></td>
 				<td><?php echo $row['fname'] . " " . $row['lname'];  ?></td>
 				<td><?php echo $row['q1']; ?></td>
 				<td><?php echo $row['q2']; ?></td>
 				<td><?php echo $row['q3']; ?></td>
 				<td><?php echo $row['q4']; ?></td>
 				<td><?php echo $row['q5']; ?></td>
 				<td><?php echo $row['q6']; ?></td>
 				<td><?php echo $row['a1']; ?></td>
 				<td><?php echo $row['a2']; ?></td>
 				<td><?php echo $row['a3']; ?></td>
 				<td><?php echo $row['a4']; ?></td>
 				<td><?php echo $row['a5']; ?></td>
 				<td><?php echo $row['a6']; ?></td>
 				<td><?php echo $row['participation']; ?></td>
 				<td><?php echo $row['presentation']; ?></td>
 				<td><?php echo $row['mid']; ?></td>
 				<td><?php echo $row['final']; ?></td>
 				<td><a href="" class="btn btn-danger" onclick="deleteMarks('<?php echo $row['m_id'] ?>')">DELETE</a></td>
 				</tr>
 				<?php

 			}


 		 ?>	


 	</table>

 	</div>

 	<?php } ?>

<script type="text/javascript">
function deleteMarks(id) {

	let i = id;
				let xhttp = new XMLHttpRequest();

				xhttp.open("GET","./DeleteStudentRecordAjax.php?marks="+i,true);
				xhttp.send();
 		}
</script>
 </body>
 </html>