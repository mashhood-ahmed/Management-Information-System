<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

 ?>

<?php 

	$students = $dm->getStudentSemester();

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

	<h2 class="text-center">Search By Semester</h2>

	<form action="" method="get">
		
		<div class="form-group">
			<label for="semester">Select Semester</label>
			<select name="semester" id="semester" class="form-control form-control-sm">
				<?php 
					while($row=mysqli_fetch_array($students)) {

						?>
						<option value="<?php echo $row['semester']; ?>"><?php echo $row['semester']; ?></option>
						<?php 
					}	
				 ?>
			</select>
		</div>	

		<input type="submit" class="btn btn-success" name="viewCoursebtn" value="View" />

	</form>

</body>
</html>