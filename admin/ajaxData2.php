<?php 

	header("Access-Control-Allow-Origin:*");

		

			$conn = new mysqli("localhost","root","","csit");

			$t_id = $_GET['course'];
				
			$query="SELECT DISTINCT week FROM attendance WHERE c_id=$t_id";
			$run = mysqli_query($conn,$query);

			if($run) {

				while($row = mysqli_fetch_array($run)) {

					echo "<option value='$row[week]'>$row[week]</option>";

				}

			}	
		
		


	



 ?>