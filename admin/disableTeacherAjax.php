<?php 

	header("Access-Control-Allow-Origin:*");

		

			$conn = new mysqli("localhost","root","","csit");

			$id = $_GET['semester'];

			$query="UPDATE teachers SET status='OFF' WHERE t_id=$id";

			$run = mysqli_query($conn,$query);


 ?>