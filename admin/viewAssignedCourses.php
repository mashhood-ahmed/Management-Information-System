<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}
 ?>

<?php 

	if(isset($_GET['semester']) && isset($_GET['viewCoursebtn'])) {

		$semester = $_GET['semester'];
		$records = $acm->getAssignCourseBySemester($semester);

	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<!-- internal css is used -->
	<style type="text/css">
		h2{
			margin-top: 0px;
			margin-bottom: 20px;
			color: #292838;
		}	

		table {
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

 		if(mysqli_num_rows($records) < 1) {

 			?>
 			<div class="w3-panel w3-display-container">
			<a href="index.php?viewassgniedCourse" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
		</div>
 			<?php

 		} else {
 			
 			?>

 			<div id="cross">
				<a href="index.php?viewassgniedCourse">X</a>
			</div>

 			<?php

 			echo "<h2 class='text-center'>$semester Semester</h2>";
 		

 	 ?>

 	<table class="table table-striped  text-center">
 		<tr>
 			<th>ID</th>
 			<th>TEACHER</th>
 			<th>COURSE</th>
 			<th>SEMESTER</th>
 			<th>SESSION</th>
 			<th>DELETE</th>

 			<?php 

 				$serial = 1;
 				while($row=mysqli_fetch_array($records)) {
 					?>
 					<tr>
 						<td><?php echo $serial++; ?></td>
 	<td><?php echo $tm->getTeacherFnameOnId($row['t_id']) . " " .$tm->getTeacherLnameOnId($row['t_id']); ?></td>
 						<td><?php echo $cm->getCourseTitleOnId($row['c_id']) ; ?></td>
 						<td><?php echo $row['semester']; ?></td>
 						<td><?php echo $row['session']; ?></td>
 						<td><a onclick="delCourse('<?php echo $row['a_id'] ?>','<?php echo $row['c_id'] ?>','<?php echo $row['t_id'] ?>')" class="btn btn-danger" href="./index.php?semester=<?php echo $row['semester'] ?>&viewCoursebtn=View" >Delete</a></td>
 					</tr>
	 				<?php
 				}

 			 ?>

 		</tr>
 	</table>

 	<?php } ?>

 	<script type="text/javascript">
 		
 		function delCourse(aid,cid,tid) {

 			let xhttp = new XMLHttpRequest();

 			xhttp.open("GET","./deleteAssignCourse.php?aid="+aid+"&cid="+cid+"&tid="+tid,true);
 			xhttp.send();

 		}

 	</script>

 </body>
 </html>

