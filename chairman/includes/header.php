<?php 

	if(!isset($_SESSION['id']) && !isset($_SESSION['username'])) {

		header("location: ../index.php");
	}	

 ?>

<div id="menu" class="row">

<nav class="col-md-12" >
		
				<div id="logo"><img src="./resources/admin-panel.jpg"></div>
			
				<!-- <div id="links">
					<a class="btn btn-dark" href="index.php?home">Home</a>
					<a class="btn btn-dark" href="">Logout</a>
				</div> -->
</nav>

</div>