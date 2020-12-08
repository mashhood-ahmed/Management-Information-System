<?php 

	header("Access-Control-Allow-Origin:*");

		

			$conn = new mysqli("localhost","root","","csit");

			$t_id = $_GET['course'];
				
			$query="SELECT section FROM assigned_courses WHERE c_id=$t_id";
			$run = mysqli_query($conn,$query);

			if($run) {

				$data= mysqli_fetch_array($run);

				if($data['section']=="Both"){
					?>
					<option value="A">A</option>
					<option value="B">B</option>
					<?php 
				} else {
					?>
					<option value="<?php echo $data['section']; ?>"><?php echo $data['section']; ?></option>
					<?php
				
				}

			}	
		
		


	



 ?>