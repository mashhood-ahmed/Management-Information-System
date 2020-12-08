
<?php 

	session_start();

if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

		header("location: ../index.php");
	}

require_once("./dataManager.php"); 


?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome | Admin</title>
	<!-- w3css import	 -->
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

	<script type="text/javascript" src="./js/validationCode.js"></script>

</body>
</html>