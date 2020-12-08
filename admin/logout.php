<?php 
	
	session_start();
	session_destroy();
	
	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");


 ?>