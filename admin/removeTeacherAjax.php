<?php 

	header("Access-Control-Allow-Origin:*");

		

			$conn = new mysqli("localhost","root","","csit");

			$id = $_GET['semester'];

			$query="DELETE FROM teachers WHERE t_id=$id";

			$run = mysqli_query($conn,$query);



 ?>