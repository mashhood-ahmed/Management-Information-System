<?php 
include("./logout.php");
session_start(); 

if(isset($_SESSION['adminid'])) {

	echo "<script>alert('session is set')</script>";

	$adminID = $_SESSION['adminid'];
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];

}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="./css/w3.css" />
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./css/style.css" />

</head>
<body>


	<?php 

	 ?>

	<div id="main-box" class="container-fluid">
		
		<?php

			include("./includes/header.php");

		 ?>

		 <section class="row sec">

            <!-- start of the row  -->

			<div class="col-md-12">
			
			<!-- close the current page	 -->

			<div class="mt-3 mb-3">
			<a  style="border:2px solid grey; padding:5px; border-radius: 100px;" href="./index.php?admin">X</a>
			</div>

			<!-- heading of the page -->

			<div class="text-center">
				<h3>Recover Password</h3>
			</div>

			<!-- password recovering icon -->
			<div class="text-center">
				<img src=".\resourses\recovericon.png" width="200" height="200" alt="recovering icon" />
			</div>

			<!-- form of the page -->

			<form action="" method="post" class="w-50 mx-auto">

			<div class="form-group">
				<label for="user">Enter Your Username:</label>
				<input type="text" id="user" name="user" class="form-control" />
			</div>

			<center>
				<input type="submit" name="adminForget" value="Next" class="btn btn-success" />
			</center>

			</form>

	</div>
				
		</section>


		 <script type="text/javascript" src="./js/validationCode.js"></script>

	</div>


</body>
</html>

<?php 

$conn = new mysqli("localhost","root","","csit");

if(isset($_POST['adminForget'])) {

	$username = $_POST['user'];

	$query = "SELECT * FROM admin WHERE username='$username'";
	$run = mysqli_query($conn,$query);

	if(mysqli_num_rows($run) > 0) {

		$data = mysqli_fetch_array($run);

		session_start();
		$_SESSION['adminid'] = $data['id'];
		$_SESSION['fname'] = $data['fname'];
		$_SESSION['lname'] = $data['lname'];
		header("location: ./email_pass_recover.php");

	} else {

		echo "<script>alert('We did\'nt found your account .. ')</script>";
	}

}



 ?>
 

	

	