<?php 

	header("Access-Control-Allow-Origin:*");

		

			$conn = new mysqli("localhost","root","","csit");

			$cid = $_GET['cid'];
		
			$query1 = "DELETE FROM `courses` WHERE c_id = $cid ";
			
			$run1 = mysqli_query($conn,$query1);
			
 ?>
 