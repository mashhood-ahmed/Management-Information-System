<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}
	
	$obj = new complaint();
	$id = $_GET['more'];
	$record = $obj->getComplaintOnId($id);

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<style type="text/css">

 		h2 , #desc {

 			margin-bottom: 20px;
 			
 		}

 		#desc {

			text-align: justify;
 			font-size: 25px;

 		}

 		#cross {
			margin-top: 10px;
			text-align: right;
			padding-right: 10px;
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
		<a title="Close" href="index.php?complaint">X</a>
	</div>	

 	<div id="content">

 		<h2><?php echo $record['title']; ?></h2>
 		<div id="desc"><?php echo $record['description']; ?></div>

 	

 	</div>



 </body>
 </html>