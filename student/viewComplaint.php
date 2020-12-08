<?php

	if(!isset($_SESSION['id']) && !isset($_SESSION['reg'])) {

		header("location: ../index.php");
	}
	
	$record = $cm->getComplaintOnSpecificID($_SESSION['id']);
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<style type="text/css">
 		
 		#cross {
			margin-top: 10px;
			margin-bottom: 10px;
			text-align: right;
			padding-right: 10px;
	}

		
		#cross a {
			border: 2px solid #c2c2a3;
			padding: 5px;
			color: #c2c2a3;
			border-radius: 20px;
	}	

	h2 {
		margin-bottom: 35px;
	}

 	</style>
 </head>
 <body>
 	
 	

	<?php 

		if(mysqli_num_rows($record) < 1) {

			?>
		<div class="w3-panel w3-display-container">
			<a href="index.php?home" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
		</div>
			<?php 

		} else {

	 ?>

	 <div id="cross">
		<a title="Close" href="index.php?home">X</a>
	</div>	

 	<h2 class="text-center">Your Complaints</h2>

 	<table class="table table-striped text-center">
 		<tr>
 			<th>ID</th>
 			<th>COMPLAINT TITLE</th>
 			<th>COMPLAINT DESCRIPTION</th>
 			<th>UPDATE</th>
 			<th>DELETE</th>
 		</tr>

 		<?php 

 			$id = 1;

 			while($row = mysqli_fetch_array($record)) {

 				?>
 					<tr>
 						<td><?php echo $id++; ?></td>
 						<td><?php echo $row['title']; ?></td>
 						<td>
 							<?php echo substr($row['description'], 0,20)."..";  ?>
 							<a href="./index.php?more=<?php echo $row['id']; ?>">Read More</a>
 						</td>
 						<td><a class="btn btn-primary" href="./index.php?upd=<?php echo $row['id']; ?>">Update</a></td>
 						<td><a class="btn btn-danger" href="./index.php?del=<?php echo $row['id']; ?>">Delete</a></td>
 					</tr>
 				<?php
 			}

 		 ?>

 	</table>

 	<?php } ?>

 </body>
 </html>