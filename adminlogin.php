<div class="col-sm-12">
				<h2 class="text-center">Admin Login</h2>
			</div>

			<div class="col-sm-12 sec2i mt-4">
				<center>
				<img src="././resourses/admin.png">
				</center>
			</div>


			<div class="col-sm-6 sec2">
				
				

				<form action="" method="post">
					<div class="form-group">
					<label for="aduser">Username:</label>
					<input type="text" id="aduser" required class="form-control" name="user" />
					</div>

					<div class="form-group">
						<label for="adpass">Password:</label>
						<input type="password" id="adpass" required class="form-control" name="pass" />
					</div>

					<center>
					<input type="submit" name="admin" class="btn btn-success" value="Login" />
					</center>

				</form>
				
				<br>

				<center>	
				<div class="mt-5"><a class="btn btn-dark" href="./admin_forget_password1.php">Forgot password ? click here</a></div>
				</center>

			</div>

		<?php 
			
			$conn = new mysqli("localhost","root","","csit");

			if(isset($_POST['admin'])) {

				$username = strtolower($_POST['user']);
				$pass = strtolower($_POST['pass']);

				$query="SELECT * FROM admin WHERE username='$username' AND pass='$pass'";

				$run = mysqli_query($conn,$query);

				if($run) {

					if(mysqli_num_rows($run) > 0) {

						$data = mysqli_fetch_array($run);

						$_SESSION['id'] = $data['id'];
						$_SESSION['user'] = $data['username'];
						$_SESSION['f'] = $data['fname'];
						$_SESSION['l'] = $data['lname'];

						header("location: ./admin/index.php?home");
					
					} else {

						echo "<script>alert('Invalid Username Or Password ..')</script>";
					} 
				
				} else {

					echo "<script>alert('Internal Problem Occured')</script>";
				}

			}


		 ?>	