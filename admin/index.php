<?php 
	
	ob_start();	
	session_start();

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

 ?>

<!DOCTYPE html>
<html>
<head> 
	<title>Welcome | Admin</title>

	<!-- w3css import -->
	<link rel="stylesheet" type="text/css" href="./css/w3.css" />
	<!-- bootstrap import -->
	<link rel="stylesheet" type="text/css" href="./bootstrap/bootstrap.min.css" />
	<!-- css import -->
	<link rel="stylesheet" type="text/css" href="./css/style.css" />

</head>
<body>

	<div id="index-container" class="container-fluid">
		
		<?php include("./includes/header.php"); ?>
		<?php include("./includes/section.php"); ?>
		<?php include("./includes/footer.php"); ?>
		

	</div>

</body>
</html>