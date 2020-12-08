<?php 

	header("Access-Control-Allow-Origin:*");

		

			$conn = new mysqli("localhost","root","","csit");

			$query = "SELECT * FROM courses
					  WHERE c_id NOT IN (SELECT c_id FROM assigned_courses);";

			$run = mysqli_query($conn,$query);

			if($run) {

				while($row=mysqli_fetch_array($run)) {

					?>
					<option value="<?php echo $row['c_id'] ?>"><?php echo $row['title']; ?></option>
					<?php
				}

			}
			

 ?>