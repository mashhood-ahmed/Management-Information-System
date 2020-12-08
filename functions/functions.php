<?php 

	$con = new mysqli("localhost","root","","csit");	

	function checkForStudent($reg) {

		global $con;

		$query = "SELECT * FROM students WHERE reg_no = '$reg' ";
		$run = mysqli_query($con,$query);

		if($run) {

			if(mysqli_num_rows($run) > 0) {

				return true;

			} else {

				return false;
			}
		}

		$con->close();
	}

 ?>