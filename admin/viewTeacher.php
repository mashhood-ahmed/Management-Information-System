<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

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

		ul {
			list-style: none;
			text-align: center;
			margin-top: 50px;
		}
		li a {
			color: #000;
		}
		li {
			display: inline-block;
			font-size: 22px;
			margin-left: 20px;
			padding: 5px 10px 5px 10px;
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

	<?php if($tm->getNoOfTeachers() < 1) {
		?>

		<div class="w3-panel w3-display-container">
			<a href="index.php?home" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
		</div>

		<?php

	}else{

		?>
			<div id="cross">
				<a href="index.php?home">X</a>
			</div>
		<?php 


		echo "<h2 class='text-center mt-3'>CS&IT Dept Faculty</h2>";
		
		if(isset($_GET['viewTeacher']) && isset($_GET['page'])) {

			$page = $_GET['page'];
		
		} else {

			$page = 1;
		}

		$no_of_rec =  $tm->getNoOfTeachers();
		$rec_per_page = 5;
		$no_of_page = ceil($no_of_rec/$rec_per_page);
		$start_page = ($page-1) * $rec_per_page;
		$data = $tm->getTeachers($start_page, $rec_per_page);
	 ?>

	<table class="table text-center table-striped mt-4">
		<tr>
			<th>ID</th>
			<th>USERNAME</th>
			<th>NAME</th>
			<th>EMAIL</th>
			<th>DISABLE</th>
			<th>DELETE</th>
		</tr>

		<?php 

			
			$serial = 1;

			while ($value=mysqli_fetch_array($data)) {
				?>
					<tr>
						<td><?php echo $serial++; ?></td>
						<td><?php echo $value['username']; ?></td>
						<td><?php echo $value['fname']." ".$value['lname'] ; ?></td>
						<td><?php echo $value['email']; ?></td>

						<td><a onclick="handle('<?php echo $value['t_id']; ?>')" class="btn btn-primary" href="index.php?viewTeacher">DISABLE</a></td>

						<td><a class="btn btn-danger" href="index.php?delTeacher=<?php echo $value['t_id']; ?>">DELETE</a></td>
					</tr>
				<?php  
			}

		 ?>

	</table>
	<ul>	
	<?php 

		for($i=1; $i<=$no_of_page; $i++) {

			?>
			<li 
			<?php
			if($page == $i)
				echo "class='bg-warning'";
			?>
			><a href="index.php?viewTeacher&page=<?php echo $i ?>"><?php echo $i; ?></a></li>
			<?php
		}	

	 ?>
	</ul>
	<?php } ?>

	<script type="text/javascript">
		
		function handle(str) {

			let xhttp = new XMLHttpRequest();
			xhttp.open('GET','./disableTeacherAjax.php?semester='+str,true);
			xhttp.send();

		}

	</script>

</body>
</html>