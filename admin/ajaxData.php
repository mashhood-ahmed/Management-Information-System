<?php 

	header("Access-Control-Allow-Origin: *");

	if(isset($_GET['semester'])) {

		$conn = new mysqli("localhost","root","","csit");
		$sem =  $_GET['semester'];

		$query = "SELECT c_id FROM courses WHERE c_id = $sem ";
		$run = mysqli_query($conn,$query);

		$data = mysqli_fetch_array($run);

		$cId =  $data['c_id'];

		$query2 = "SELECT semester FROM assigned_courses WHERE c_id = $cId";
		$run2 = mysqli_query($conn,$query2);

		$data2 = mysqli_fetch_array($run2);

		echo $data2['semester'];
		
	}

 ?>