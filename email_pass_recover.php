<?php 
session_start(); 

if(isset($_SESSION['adminid'])) {

	$id = $_SESSION['adminid'];
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];      
	$uType = "admin";

}

if(isset($_SESSION['studentid'])) {

	$id = $_SESSION['studentid'];
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
	$uType = "student";
}

if(isset($_SESSION['teacherid'])) {

	$id = $_SESSION['teacherid'];
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
	$uType = "teacher";
}

if(isset($_SESSION['chairmanid'])) {

	$id = $_SESSION['chairmanid'];
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
	$uType = "chairman";
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

			<div class="col-md-12">
				
				<div class="mt-3 mb-3">
		 			<a style="border:2px solid gray; border-radius: 10px;padding:5px;" href="./admin_forget_password1.php?backAd">X</a>	
		 		</div>

				<div class="text-center">
					<?php echo "Are you " . "<strong><u>" . $fname . " " . $lname . " </strong></u>?"; ?>
					&nbsp;
					<a href="./logout.php?backCode">No</a>
				</div>

				<!-- email icon -->
				<div class="text-center mt-5 mb-3">
					<img src=".\resourses\emailIcon.jpg" width="150" height="100" alt="email icon" />
				</div>

				<form action="./enter_code_receive1.php" method="post" class="w-50 mx-auto">
					<div class="form-group">
						<label for="ema">Enter Your Email Address:</label>
						<input type="hidden" name="utype" value="<?php echo $uType; ?>" />
						<input type="hidden" value="<?php echo $id; ?>" name="aid" />
						<input type="email" required class="form-control" name="ema" id="ema" />
					</div>

					<center>
					<input type="submit" name="adEmail" value="Next" class="btn btn-success" />
					</center>
				</form>
			</div>

				
		</section>


		 <script type="text/javascript" src="./js/validationCode.js"></script>

	</div>


</body>
</html>

<?php 

	

	