
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

		font-family: "Courier New";
		margin-top: 20px;
		list-style: none;
		text-align: center;
		color: red;

	}

	</style>

</head>
<body>

	<div id="table-box">
			
		<div id="cross">
		<a href="index.php?selectUser">X</a>
		</div>

		<h2 id="h2">Teacher Registration Form</h2>

		<form action="" method="post">
			
			<div class="form-group">
				<label for="user">Username</label>
				<input type="text" placeholder="e.g. Ali_12" name="username" id="user" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="fname">First Name</label>
				<input type="text" placeholder="e.g. Ali" name="fname" id="fname" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="lname">Last Name</label>
				<input type="text" placeholder="e.g. Umar" name="lname" id="lname" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" placeholder="e.g. Ali@example.com" name="ema" id="email" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="pass">Password</label>
				<input type="password" placeholder="e.g.Test123456" name="pass" id="pass" class="form-control" required />
			</div>

			<div class="form-group">
				<label for="cpass">Confirm Password</label>
				<input type="password" placeholder="e.g.Test123456" name="cpass" id="cpass" class="form-control" required />
			</div>

			<input type="submit" onclick="teacherSignUpValidation()" name="regist" value="Register" class="btn btn-success" />

		</form>

		<ul id="showError">
			
		</ul>

	</div>


</body>
</html>


<?php 

	if(isset($_POST['regist'])) {

		$conn = new mysqli("localhost","root","","csit");

			$username = $_POST['username'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];		
			$ema = strtolower($_POST['ema']);
			$pass = $_POST['pass'];
			$cpass = $_POST['cpass'];
			$status = "OFF";

			if($pass == $cpass) {

				$test = checkForTeacher($ema);

				if($test) {

				$query = "INSERT INTO `teachers`(`username`, `fname`, `lname`, `email`, `password`, `status`) VALUES ('$username','$fname','$lname','$ema','$pass','$status')";

				$run = mysqli_query($conn, $query);

				if($run) {

					echo "<script>alert('Thanks For Sign Up! Your Account Will Be Activated Soon')</script>";	
				} else {

					echo "<script>alert('Internal error occured ..')</script>";	
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