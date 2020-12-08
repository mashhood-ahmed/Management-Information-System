<?php 
	//$dm = new dataManager();
	if(!isset($_SESSION['id']) && !isset($_SESSION['reg'])) {

		header("location: ../index.php");
	}

 ?>

		<footer id="footer-section" class="row">
			<div class="col-md-12"><?php echo $dm->getCopyRight(); ?></div>
		</footer>