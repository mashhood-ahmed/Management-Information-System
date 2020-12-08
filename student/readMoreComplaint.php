<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['reg'])) {

		header("location: ../index.php");
	}
	
	$id = $_GET['more'];
	$record = $cm->getComplaintOnId($id);

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<style type="text/css">

 		#cross {
			margin-top: 10px;
			text-align: right;
			padding-right: 10px;
	}

	div > p {

		font-size: 22px;
		text-align: justify;

	}


		#cross a {
			border: 2px solid #c2c2a3;
			padding: 5px;
			color: #c2c2a3;
			border-radius: 20px;
	}	

 	</style>
 </head>
 <body>
 	
 	<div id="cross">
		<a title="Close" href="index.php?viewComp">X</a>
	</div>	

 	<div>
 		<div class="mb-3"><h2><?php echo $record['title']; ?></h2></div>
 		<div><p><?php echo $record['description']; ?></p></div>
 	</div>



 </body>
 </html>