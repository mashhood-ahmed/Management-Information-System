<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}


	$account = $um->getTeaPendingAccounts();


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<style type="text/css">
 		
 		h2{
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

 		if(mysqli_num_rows($account) < 1) {

 			?>
		<div class="w3-panel w3-display-container">
			<a href="index.php?request" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
			</div>
			<?php

 		} else {

 			?>
 			<div id="cross">
				<a href="index.php?request">X</a>
			</div>
 			<?php

			echo "<h2>Teacher Pending Requests</h2>"; 			

 	 ?>

 	

 	<table class="table table-striped text-center">
 		
 		<tr>
 			<th>ID</th>
 			<th>NAME</th>
 			<th>EMAIL</th>
 			<th>ACCOUNT STATUS</th>
 			<th>ACTIVATE</th>
 			<th>REMOVE</th>
 		</tr>

 		<?php 

 			$s = 1;

 			while($row=mysqli_fetch_array($account)) {

 				$id = $row['t_id'];

 				?>
 				<tr>
 					<td><?php echo $s++; ?></td>
 					<td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
 					<td><?php echo $row['email']; ?></td>
 					<td><?php echo $row['status']; ?></td>
 					<td><a href="index.php?teaReq" onclick="handle('<?php echo $id; ?>')" value="1" class="btn btn-success" >ACTIVATE</a></td>
 					<td><a href="index.php?teaReq" onclick="remove('<?php echo $id; ?>')" value="1" class="btn btn-danger" >REMOVE</a></td>
 				</tr>
 				<?php

 			}

 		 ?>

 	</table>	

 	<?php } ?>

 	<script type="text/javascript">
 		
 		function handle(str) {


				let xhttp = new XMLHttpRequest();

				xhttp.onreadystatechange = function() {

					if(this.readyState == 4 && this.status == 200) {

						document.getElementById("show").innerHTML = this.responseText;
					}

				};

				xhttp.open("GET","./activateTeacherAjax.php?semester="+str,true);
				xhttp.send();
 		}

 		function remove(str) {


				let xhttp = new XMLHttpRequest();


				xhttp.open("GET","./removeTeacherAjax.php?semester="+str,true);
				xhttp.send();
 		}

 	</script>

 </body>
 </html>

