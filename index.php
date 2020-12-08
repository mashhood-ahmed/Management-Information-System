<?php 
	
	ob_start();
	session_start();

	if(isset($_SESSION['user']) && isset($_SESSION['id'])) {

		header("location: ./admin/index.php?home");
	}

	if(isset($_SESSION['id']) && isset($_SESSION['email'])) {

		header("location: ./teacher/index.php?home");
	}

	if(isset($_SESSION['id']) && isset($_SESSION['reg'])) {

		header("location: ./student/index.php?home");
	}

	if(isset($_SESSION['id']) && isset($_SESSION['username'])) {

		header("location: ./chairman/index.php?home");
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
			include("./includes/section.php");

		 ?>

		 <script type="text/javascript" src="./js/validationCode.js"></script>
		 <script type="text/javascript" src="./js/signUpForm.js"></script>
	</div>


</body>
</html>

<?php 

	

	