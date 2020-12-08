<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

		header("location: ../index.php");
	}
	
	if(isset($_GET['cou']) && isset($_GET['sem']) && isset($_GET['abtn']) && isset($_GET['section'])) {

		$tid = $_SESSION['id'];
		$cid = $_GET['cou'];
		$session_class =  $dm->getSessionAndClass($cid,$_SESSION['id']);
		$section = $_GET['section'];
		$semester = $_GET['sem'];

		$record = $mm->getMarks($tid,$cid,$section,$semester);
	
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

		<?php 

			if(mysqli_num_rows($record) < 1) {

				?>
				<div class="w3-panel w3-display-container">
					<a href="index.php?viewMarks" class="w3-button w3-large w3-display-topright">X</a>
					<h3>No Records Found</h3>
				</div>
				<?php

			} else {


		 ?>

		<div id="cross">
			<a href="index.php?viewMarks">X</a>
		</div>	

 	<h5>
 		<div><strong>Course:</strong> <span><?php echo $dm->getCourseId($cid);?></span></div>
 		<div><strong>Semester:</strong> <span><?php echo $semester; ?></span></div>
 		<div><strong>Section:</strong> <span><?php echo $section; ?></span></div>
 		<div><strong>Session:</strong> <span><?php echo $session_class[0]; ?></span></div>
 		
  	</h5>

 

 	<div id="table-box">

 	<table class="table text-center table-striped">
 		
 		<tr>
 			<th>REG #</th>
 			<th>NAME</th>
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
 			<th>UPDATE</th>
 		</tr>

 		<?php 

 			while($row=mysqli_fetch_array($record)) {

 				?>	

 				<tr>
 					<td><?php echo $row['reg_no']; ?></td>
 					<td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
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
 					<td><a class="btn btn-primary" href="./index.php?updMark=<?php echo $row['m_id']; ?>&cou=<?php echo $cid; ?>&sem=<?php echo $semester; ?>&sec=<?php echo $section; ?>">UPDATE</a></td>
 				</tr>

 				<?php

 			}	


 		 ?>	

 	</table>

 	</div>

 	<?php } ?>

 </body>
 </html>