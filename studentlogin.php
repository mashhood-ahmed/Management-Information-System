<div class="col-sm-12">
				<h2 class="text-center">Student Login</h2>
			</div>

			<div class="col-sm-12 sec2i mt-4">
				<center>
				<img src="././resourses/student.png">
				</center>
			</div>


			<div class="col-sm-6 sec2">
				
				

				<form action="" method="post">
					
					<div class="form-group">
					<label style="display: block;" for="stdreg">Registration No:</label>
					<select name="y" style="width: 100px; display: inline-block;" class="form-control">
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
					</select>

					<input style="width: 80px; display: inline-block;" type="text" value="PWBCS" disabled class="form-control" name="">

					<input style="display: inline-block; width: 280px;" type="text" id="stdreg" required class="form-control" name="reg" />
					</div>

					<div class="form-group">
						<label for="stdpass">Password:</label>
						<input type="password" id="stdpass" required class="form-control" name="pass" />
					</div>

					<center>
					<input type="submit" name="std" class="btn btn-success" value="Login" />
					</center>

				</form>
				
				<br>

				<center>	
				<div class="mt-5"><a class="btn btn-dark" href="./student_forget_password.php">Forgot password ? click here</a></div>
				</center>

			</div>

<?php 

if(isset($_POST['std'])) {
		
		$conn = new mysqli("localhost","root","","csit");

		$year = $_POST['y'];
		$reg = strtoupper($_POST['reg']);
		$fullReg = $year."pwbcs".$reg;
		$pass = $_POST['pass'];

		$query = "SELECT * FROM students WHERE reg_no='$fullReg' AND password='$pass' AND status = 'ON'";
		$run = mysqli_query($conn,$query);

		if($run) {

			if(mysqli_num_rows($run) > 0) {

				$data = mysqli_fetch_array($run);
			

				$_SESSION['id'] = $data['std_id'];
				$_SESSION['reg'] = $data['reg_no'];
				$_SESSION['first'] = $data['fname'];
				$_SESSION['last'] = $data['lname'];
				$_SESSION['email'] = $data['email'];
				$_SESSION['semester'] = $data['semester'];
				$_SESSION['section'] = $data['section']; 

				header("Location: ./student/index.php?home");

			} else {

				echo "<script>alert('Invalid Registration No Or Password ..')</script>";
			}
		
		} else {

			echo "<script>alert('Internal problem occured')</script>";
		} 	

	}

 ?>