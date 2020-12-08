<?php 

// session_start();
// session_destroy();
// header("location: http://localhost/copy1Updated");

if(isset($_GET['backAd'])) {

	session_start();
	session_destroy();
}

if(isset($_GET['backCode'])) {

		session_start();
	session_destroy();
	header("location: ./index.php");

}


 ?>