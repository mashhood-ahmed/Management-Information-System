<?php 

	header("Access-Control-Allow-Origin:*");

		

			$conn = new mysqli("localhost","root","","csit");

			$id = $_GET['semester'];

			$query="UPDATE students SET status='ON' WHERE std_id=$id";

			$run = mysqli_query($conn,$query);



 ?>