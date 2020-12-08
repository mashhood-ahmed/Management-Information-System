<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['reg'])) {

		header("location: ../index.php");
	}
	
		$std_id = $_SESSION['id'];
		$std_sem = $_SESSION['semester'];
		$std_sec = $_SESSION['section'];
		$record = $dm->getCourseOnStudent($std_sem, $std_sec);	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<!-- internal css is used -->
	<style type="text/css">
		h2{
			margin-bottom: 20px;
			color: #292838;
		}	

		label{
			color: #17639e;
		}

		form {
			margin-bottom: 20px;
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
		<a href="index.php?home">X</a>
	</div>

	<h2>Choose Subject</h2>

 	<form action="" method="get">
 		
 		<div class="form-group">
 			<label>Choose Subject</label>
 			<select name="choose" class="form-control" required>
 				<option selected value="" disabled>Choose Subject From Here</option>

 				<?php 

 					while($data=mysqli_fetch_array($record)) {

 						?>
 						<option value="<?php echo $data['c_id']; ?>"><?php echo $data['title']; ?></option>	
 						<?php	
 					}

 				 ?>

 			</select>
 		</div>

 		<input type="submit" name="atten" value="View Attendance" class="btn btn-success" />

 	</form>

 </body>
 </html>

 <?php 

