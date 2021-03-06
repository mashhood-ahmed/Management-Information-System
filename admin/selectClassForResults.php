<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}
	
	$data = $acm->getAssignCourses();	
 ?>
<!DOCTYPE html>
<html>
<head>

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
			margin-top: 20px;			
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
			<label for="sub">Choose Subject</label>
			<select required name="course" class="form-control" id="sub" onchange="getSemesterByCouse(this.value)">
				<option selected disabled value="">Select Course</option>
				<?php 
					while($row=mysqli_fetch_array($data)) {
						?>
						<option value="<?php echo $row['c_id']; ?>"><?php echo $row['title']; ?></option>
						<?php					}
				 ?>
			</select>
		</div>	

		<div class="form-group">
			<label for="sec">Choose Section</label>
			<select name="section" class="form-control" id="sec">		
			</select>
		</div>

		<div  class="form-group">
			<label for="sem">Semester</label>
			<select class="form-control" id="sem" name="semester">
				<option id="showSemester"></option>
			</select>
		</div>

		<input type="submit" name="rbtn" value="Next" class="btn btn-success" />
		
</form>	


	<script type="text/javascript">
		
		function getSemesterByCouse(str) {

				getSection(str);

				let xhttp = new XMLHttpRequest();

				xhttp.onreadystatechange = function() {

					if(this.readyState == 4 && this.status == 200) {

						document.getElementById("showSemester").innerHTML = this.responseText;
					}

				};

				xhttp.open("GET","./ajaxData.php?semester="+str,true);
				xhttp.send();
		}

		function getSection(id) {

			let xhttp = new XMLHttpRequest();

			xhttp.onreadystatechange = function(){

				if(this.readyState == 4 && this.status == 200) {

					document.getElementById("sec").innerHTML = this.responseText;
				} 

			};

			xhttp.open("GET","./ajaxData1.php?course="+id,true);
			xhttp.send();

		}


	</script>

</body>
</html>