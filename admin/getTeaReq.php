<?php 

	header("Access-Control-Allow-Origin:*");

		

			$conn = new mysqli("localhost","root","","csit");

			$query = "SELECT COUNT(t_id) FROM teachers WHERE status='OFF'";
			$run = mysqli_query($conn,$query);

			$data = mysqli_fetch_array($run);

			$d = $data['COUNT(t_id)'];

			echo "<span style='background-color:red;font-size:20px;color:#fff;padding:10px; border-radius:100px'>$d</span>";

 ?>