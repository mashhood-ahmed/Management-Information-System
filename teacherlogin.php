<div class="col-sm-12">
				<h2 class="text-center">Teacher Login</h2>
			</div>

			<div class="col-sm-12 sec2i mt-4">
				<center>
				<img src="././resourses/teacher.png">
				</center>
			</div>


			<div class="col-sm-6 sec2">
				
				

				<form action="" method="post">
					<div class="form-group">
					<label for="teaemail">Email:</label>
					<div style="color: red" id="emailer"></div>
					<input type="email" id="teaemail" required class="form-control" name="email" />
					</div>

					<div class="form-group">
						<label for="teapass">Password:</label>
						<div style="color: red" id="passer"></div>
						<input type="password" id="teapass" required class="form-control" name="pass" />
					</div>

					<center>
					<input type="submit" name="teacher" class="btn btn-success" value="Login" />
					</center>

				</form>

				<br>			

				<center>	
				<div class="mt-5"><a class="btn btn-dark" href="./teacher_forget_password.php">Forgot password ? click here</a></div>
				</center>

			</div>

	<?php 
	
		if(isset($_POST['teacher'])) {

			$conn = new mysqli("localhost","root","","csit");

			$email = strtolower($_POST['email']);
			$pass = strtolower($_POST['pass']);

			$query = "SELECT * FROM teachers WHERE email='$email' AND password='$pass' AND status = 'ON'";

			$run = mysqli_query($conn,$query);

			if($run) {

				if(mysqli_num_rows($run) > 0) {

					$data = mysqli_fetch_array($run);

					
					$_SESSION['id'] = $data['t_id'];
					$_SESSION['email'] = $data['email'];
				

					header("location: ./teacher/index.php?home");

				} else {

					echo "<script>alert('Invalid Email Or Password ..')</script>";

				} 
			}

		}

	 ?>		