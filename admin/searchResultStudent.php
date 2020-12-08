<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

 ?>

<?php 

	if(isset($_GET['sbtn']) && isset($_GET['search'])) {

		$p3 =  @$_GET['search'];
		$p1 = @$_GET['year'];
		$p2 = "PWBCS";

		$d = $p1."".$p2."".$p3;
		

		$data = $dm->getStdOnRegNo($d);
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<!-- internal css is used -->
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

 		if($data === false) {

 			?>
 			
 			<div class="w3-panel w3-display-container">
			<a href="index.php?viewStudent" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
			</div>

 			<?php
 		
 		} else {

 			?>
 			<div id="cross">
				<a href="index.php?viewStudent">X</a>
			</div>
 			<?php 

 			echo "<h2 class='text-center mt-3 mb-3'>Found Record</h2>";
 		


 	 ?>

 	<table class="table table-striped text-center ">
 		
 		<tr>
 
 			<th>REGISTRAION</th>
 			<th>NAME</th>
 			<th>SEMESTER</th>
 			<th>SECTION</th>
 			<th>EMAIL</th>
 			<th>DISABLE ACCOUNT</th>
 			<th>DELETE</th>
 		</tr>

 		<?php 

 			$s = 1;

 			?>

 		 	<tr>
 		 		<td><?php echo $data['reg_no']; ?></td>
 		 		<td><?php echo $data['fname'] . " " . $data['lname'] ; ?></td>
 		 		<td><?php echo $data['semester']; ?></td>
 		 		<td><?php echo $data['section']; ?></td>
 		 		<td><?php echo $data['email']; ?></td>

 		 		<td><a onclick="handle('<?php echo $data['std_id']; ?>')" href="index.php?search=<?php echo $d; ?>&sbtn=Search" class="btn btn-primary">DISABLE</a></td>

 		 		<td><a class="btn btn-danger" href="index.php?delStd=<?php echo $data['std_id']; ?>">DELETE</a></td>
 		 	</tr>	



 	</table>

 	<?php } ?>

 	<script type="text/javascript">
 		
 		function handle(str) {

 			let xhttp = new XMLHttpRequest();

 	
			xhttp.open('GET','./disableRequestAjax.php?semester='+str,true);
			xhttp.send();
 		}

 	</script>

 </body>
 </html>