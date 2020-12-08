<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}
		
	$object = new complaint();	
	$records = $object->getComplaints();
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<style type="text/css">

 	h2{
			margin-top: 0px;
			margin-bottom: 20px;
			color: #292838;
		}	


		table {
			margin-bottom: 20px;
		}
 		
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
 	</style>
 </head>
 <body>
 	

 	<?php 

 		if(mysqli_num_rows($records) < 1) {

 			?>

 			<div class="w3-panel w3-display-container">
			<a href="index.php?home" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
		</div>

 			<?php

 		} else {

 			?>
 				<div id="cross">
					<a href="index.php?home">X</a>
				</div>
 			<?php

 			echo "<h2 class='text-center mt-3 mb-5'>Student Complaints</h2>";
 		

 	 ?>

 	

 	<table class="table table-striped text-center">
 		<tr>
 			<th>ID</th>
 			<th>TITLE</th>
 			<th>DESCRIPTION</th>
 			<th>DELETE</th>
 		</tr>

 		<?php 

 			$i = 1;

 			while($row=mysqli_fetch_array($records)) {

 				?>

 					<tr>
 						<td><?php echo $i++; ?></td>
 						<td><?php echo $row['title']; ?></td>
 						<td>
 							<?php echo substr($row['description'], 0,20); ?>
 							<a href="index.php?more=<?php echo $row['id']; ?>">Read More..</a>		
 						</td>
 						<td><a class="btn btn-danger" onclick="handle('<?php echo $row['id'] ?>')" href="">DELETE</a></td>
 					</tr>

 				<?php

 			}

 		 ?>

 	</table>

 	<?php } ?>

 	<script type="text/javascript">
		
		function handle(str) {


			let xhttp = new XMLHttpRequest();
			xhttp.open('GET','./DeleteStudentRecordAjax.php?comp='+str,true);
			xhttp.send();

		}

	</script>

 </body>
 </html>