<?php 

	header("Access-Control-Allow-Origin:*");

		

			$conn = new mysqli("localhost","root","","csit");

			$aid = $_GET['aid'];
			$cid = $_GET['cid'];
			$tid = $_GET['tid'];
		
			 $query1 = "DELETE FROM assigned_courses WHERE a_id=$aid";
			 $query2 = "DELETE FROM internal_marks WHERE c_id=$cid AND t_id=$tid";
			 $query3 = "DELETE FROM attendance WHERE c_id=$cid AND t_id=$tid";
				
			
			$run1 = mysqli_query($conn,$query1);
			$run2 = mysqli_query($conn,$query2);
			$run3 = mysqli_query($conn,$query3);
			
 ?>
 