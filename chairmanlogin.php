<div class="col-sm-12">
				<h2 class="text-center">Chairman Login</h2>
			</div>

			<div class="col-sm-12 sec2i mt-4">
				<center>
				<img src="././resourses/chairman.jpg">
				</center>
			</div>


			<div class="col-sm-6 sec2">
				

				<form action="" method="post">
					<div class="form-group">
					<label for="ema">Username:</label>
					<input type="text" id="ema" required class="form-control" name="user" />
					</div>

					<div class="form-group">
						<label for="pass">Password:</label>
						<input type="password" id="pass" required class="form-control" name="pass" />
					</div>	

					<center>
					<input type="submit" name="chairman" class="btn btn-success" value="Login" />
					</center>

				</form>
					
				<br>

				<center>	
				<div class="mt-5"><a class="btn btn-dark" href="./chairman_forget_password.php">Forgot password ? click here</a></div>
				</center>

			</div>

<?php 

if(isset($_POST['chairman'])) {
		
		$conn = new mysqli("localhost","root","","csit");

		$username = strtolower($_POST['user']);
		$password = $_POST['pass'];

		$query = "SELECT * FROM chairman WHERE username='$username' AND pass='$password'";
		$run = mysqli_query($conn,$query);

		if($run) {

			if(mysqli_num_rows($run) > 0) {

				$data = mysqli_fetch_array($run);
			

				$_SESSION['id'] = $data['id'];
				$_SESSION['username'] = $data['username'];
				$_SESSION['first'] = $data['fname'];
				$_SESSION['last'] = $data['lname'];
				$_SESSION['email'] = $data['email'];
			
				header("Location: ./chairman/index.php?home");

			} else {

				echo "<script>alert('Username or password is wrong...')</script>";
			}
		
		} else {

			echo "<script>alert('Internal problem occured')</script>";
		} 	

	}

 ?>			