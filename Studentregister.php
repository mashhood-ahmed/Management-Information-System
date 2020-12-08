<!DOCTYPE html>
<html>
<head>

	<style type="text/css">
	
		#table-box {

			border: 0px solid black;
			width: 800px;
			margin: 30px auto;
			
		}

		#h2{
			
			margin-bottom: 20px;
			color: #292838;
		}

		label{
			color: #17639e;
		}

		#cross {
		
			text-align: right;
			padding-right: 10px;
	}

		#cross a {
			border: 2px solid #c2c2a3;
			padding: 5px;
			color: #c2c2a3;
			border-radius: 20px;
	}

	#showError {

		
		margin-top: 20px;
		text-align: center;
		font-family: "Courier New";
		color: red;
		list-style: none;

	}

	</style>

</head>
<body>

	<div id="table-box">
			
		<div id="cross">
		<a href="index.php?selectUser">X</a>
		</div>

		<h2 id="h2">Student Registration Form</h2>

		<form action="" method="post">
			
			<div class="form-group">
				<label for="user">Username</label>
				<input type="text" placeholder="e.g. ali_12" name="username" id="user" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="fname">First Name</label>
				<input type="text" placeholder="e.g. Ali" name="fname" id="fname" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="lname">Last Name</label>
				<input type="text" placeholder="e.g. umar" name="lname" id="lname" class="form-control" required />
			</div>

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

					<input style="display: inline-block; width: 610px;" type="text" id="stdreg" required class="form-control" name="reg" />

			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" placeholder="e.g. ali@example.com" name="ema" id="email" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="sem">Semester</label>
				<select name="sem" id="sem" class="form-control">
					<option disabled value="" selected>Select Semester</option>
					<option value="1st">1st</option>
					<option value="2nd">2nd</option>
					<option value="3rd">3rd</option>
					<option value="4th">4th</option>
					<option value="5th">5th</option>
					<option value="6th">6th</option>
					<option value="7th">7th</option>
					<option value="8th">8th</option>
				</select>
			</div>

			<div class="form-group">
				<label for="sec">Section</label>
				<select name="sec" id="sec" class="form-control">
					<option disabled value="" selected>Select Section</option>
					<option value="A">A</option>
					<option value="B">B</option>
				</select>
			</div>	

			<div class="form-group">
				<label for="pass">Password</label>
				<input type="password" placeholder="e.g. Test123456" name="pass" id="pass" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="cpass">Confirm Password</label>
				<input type="password" placeholder="e.g. Test123456" name="cpass" id="cpass" class="form-control" required />
			</div>

			<input type="submit" onclick="signUpValidation()" name="regist" value="Register" class="btn btn-success" />

		</form>

		<ul id="showError">
			
		</ul>

	</div>


</body>
</html>


<?php 

	if(isset($_POST['regist'])) {

		$conn = new mysqli("localhost","root","","csit");

		if(!$conn) {

			echo "<script>alert('Something went wrong while establishing connection.')</script>";
		}

			$username = strtolower($_POST['username']);
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];	
			$reg = strtoupper($_POST['reg']);
			$fullReg = $_POST['y']."pwbcs".$reg;
			$sem = $_POST['sem'];
			$sec = $_POST['sec'];	
			$ema = strtolower($_POST['ema']);
			$pass = $_POST['pass'];
			$cpass = $_POST['cpass'];
			$status = "OFF";


			if($pass == $cpass) {

				$test = checkForStudent($reg,$ema); 

				if($test) {

				$query = "INSERT INTO `students`(`username`, `fname`, `lname`, `email`, `reg_no`, `section`, `semester`, `password`, `status`) VALUES ('$username','$fname','$lname','$ema','$fullReg','$sec','$sem','$pass','$status')";

				$run = mysqli_query($conn, $query);	

				if($run) {

				echo "<script>alert('Thanks For Sign Up! Your Account Will Be Activated Soon')</script>";		

				} else {

					echo "<script>alert('Internal Problem Occured ..')</script>";	
				}

			} else {

				echo "<script>alert('You are already registered in the system')</script>";
			}	

			} else {

				echo "<script>alert('Passwords not matched! Please try again')</script>";
			}


		
	}


 ?>		
	

<script type="text/javascript">
	
	function disPro(v) {

		if(v == "teacher") {

			let reg = document.getElementById("reg").disabled="disabled";
			let sem = document.getElementById("sem").disabled="disabled";
			let sec = document.getElementById("sec").disabled="disabled";
		
		} 

		if(v == "student") {

			let reg = document.getElementById("reg").disabled="";
			let sem = document.getElementById("sem").disabled="";
			let sec = document.getElementById("sec").disabled="";


		}	

	}

</script>

<?php 

	function checkForStudent($reg,$ema) {

		global $conn;

		$query = "SELECT * FROM students WHERE reg_no = '$reg' OR email = '$ema' ";
		$run = mysqli_query($conn,$query);

		if($run) {

			if(mysqli_num_rows($run) > 0) {

				return false;

			} else {

				return true;
			}
		}

		//$con->close();
	}

	function checkForTeacher($e) {

		global $conn;

		$query = "SELECT * FROM teachers WHERE email='$e' ";
		$run = mysqli_query($conn,$query);

		if($run) {

			if(mysqli_num_rows($run) > 0) {

				return false;
			
			} else {

				return true;
			} 

		}

	}


 ?>