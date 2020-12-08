<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

 ?>

<?php 

	$dm = new studentManager();
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

		.searchInput {

			height: 50px;
			width: 250px;
			margin: 0px;
			font-size: 16px;
			padding-left: 10px;
			font-weight: bold;
			outline: none;
		}

		.searchButton {

			border: 0px;
			height: 50px;
			background-color: #292838;
			font-size: 16px; 
			font-weight: bold;
			color: #ffffff;
			width: 100px;
			margin:0px;
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

	<h2>View Students</h2>

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

		<div class="form-group">
			<label for="sec">Select Section</label>

			<select name="sec" id="sec" class="form-control">
				<option value="A">A</option>
				<option value="B">B</option>
			</select>

		</div>

		<input type="submit" class="btn btn-success" name="viewbtn" value="View" />

	</form>

	<div id="search-panel">

	<h2 style="text-align: center;">Search Student By Registration No</h2>

	<center>

	<form action="" method="get" class="searchBox" autocomplete="off">
	
	 <select name="year" style="width:60px;"  class="searchInput">
	 	<option value="16">16</option>
	 	<option value="17">17</option>
	 	<option value="18">18</option>
	 	<option value="19">19</option>
	 	<option value="20">20</option>
	 	<option value="21">21</option>
	 	<option value="22">22</option>
	 	<option value="23">23</option>
	 	<option value="24">24</option>
	 	<option value="25">25</option>
	 	<option value="26">26</option>
	 	<option value="27">27</option>
	 	<option value="28">28</option>
	 	<option value="29">29</option>
	 	<option value="30">30</option>
	 </select>				

<input class="searchInput" style="width:100px;" disabled type="text" name="search" value="PWBCS">	

	 <input class="searchInput" style="width: 150px;" required type="text" name="search" placeholder="XXXX" maxlength="4">
            <input type="submit" value="Search" class="searchButton" name="sbtn" />
               
            
	</form>

	</center>
	
	</div>

</body>
</html>