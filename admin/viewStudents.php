<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

	if(isset($_GET['semester']) && isset($_GET['sec']) && isset($_GET['viewbtn'])) {

	 		$sem = $_GET['semester'];
	 		$sec = $_GET['sec'];	

			$data = $dm->getAllStudentsOnSemAndSec($sem, $sec);

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

		ul {
			text-align: center;
			list-style: none;
			margin-top: 50px;
		}
		li {
			display: inline;
			font-size: 22px;
			padding: 5px 10px 5px 10px;
			margin-left: 20px;
		}
		li a {
			color: #000;
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

 		if(mysqli_num_rows($data) < 1) {

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

 			echo "<h2 class='text-center mb-4'>$sem Semester Students</h2>";

 		 
 		?> 

 	<table class="table table-striped text-center">
 		<tr>
 	
 			<th>REGISTRATION</th>
 			<th>USERNAME</th>
 			<th>NAME</th>
 			<th>SEMESTER</th>
 			<th>SECTION</th>
 			<th>EMAIL</th>
 			<th>DISABLE ACCOUNT</th>
 			<th>DELETE</th>
 		</tr>

 		<?php 

 			while($row=mysqli_fetch_array($data)) {

 				?>
 				<tr>
 					<td><?php echo $row['reg_no']; ?></td>
 					<td><?php echo $row['username']; ?></td>
 					<td><?php echo $row['fname']." ".$row['lname']; ?></td>
 					<td><?php echo $row['semester']; ?></td>
 					<td><?php echo $row['section']; ?></td>
 					<td><?php echo $row['email']; ?></td>

 					<td><a onclick="handle('<?php echo $row['std_id']; ?>')" href="index.php?semester=<?php echo $sem; ?>&sec=<?php echo $sec; ?>&viewbtn=View" class="btn btn-primary" href="">DISABLE</a></td>

 					<td><a href="index.php?delStd=<?php echo $row['std_id']; ?>">
 						<button class="btn btn-danger">DELETE</button></a></td>
 				</tr>

 				<?php  
 			}

 		 ?>

 	</table>


  	<?php } } ?>	

 	<script type="text/javascript">
 		
 		function handle(str) {

			let xhttp = new XMLHttpRequest();

			xhttp.open('GET','./disableRequestAjax.php?semester='+str,true);
			xhttp.send();
 		}

 	</script>


 </body>
 </html>