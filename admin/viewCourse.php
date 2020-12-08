<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}
 ?>

<?php 
	
	//$records = $cm->getCourses();
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

	ul{
		list-style: none;
		text-align: center;
		margin-top: 80px;
	}
	li {
		display: inline;
		font-size: 22px;
		padding: 5px 10px 5px 10px;
		margin-left: 20px;
	}

	a {
		color: #000;
	}

	</style>

</head>
<body>

	<!-- <div id="cross">
		<a href="index.php?home">X</a>
	</div> -->


	<?php

	$no = $cm->getNoOfCourses();
	
	if($no < 1) {

		?>

		<div class="w3-panel w3-display-container">
			<a href="index.php?home" class="w3-button w3-large w3-display-topright">X</a>
			<h3>No Records Found</h3>
		</div>
		<?php

		} else {

			echo "<h2 class='text-center mt-3'>Registered Courses</h2>";
		
		if(isset($_GET['viewCourse']) && isset($_GET['page'])) {

			$page = $_GET['page'];
		
		} else {

			$page = 1;
		}

		$no_of_rec =  $cm->getNoOfCourses();
		$rec_per_page = 5;
		$no_of_page = ceil($no_of_rec/$rec_per_page);
		$start_page = ($page-1) * $rec_per_page;
		$data = $cm->getCourses($start_page, $rec_per_page);
	?>




	<table class="table table-striped text-center mt-4">
		<tr>
			<th>ID</th>
			<th>TITLE</th>
			<th>CODE</th>
			<th>CREDIT HR</th>
			<th>UPDATE</th>
			<th>DELETE</th>
		</tr>

		<?php 

			
			$serial = 1;

			while ($value=mysqli_fetch_array($data)) {
				?>
				<tr>
					<td><?php echo $serial++; ?></td>
					<td><?php echo $value['title']; ?></td>
					<td><?php echo $value['code']; ?></td>
					<td><?php echo $value['credit']; ?></td>
					<td><a class="btn btn-primary" href="index.php?updCou=<?php echo $value['c_id']; ?>">UPDATE</a></td>
					<td><a onclick="deleteCourse('<?php echo $value['c_id'] ?>')" class="btn btn-danger" href="index.php?viewCourse">DELETE</a></td>
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
			><a href="index.php?viewCourse&page=<?php echo $i ?>"><?php echo $i; ?></a></li>
			<?php
		}	

		 ?>
	</ul>


	<?php } ?>

	<script type="text/javascript">
			
		function deleteCourse(id) {

			let xhttp = new XMLHttpRequest();

			xhttp.open("GET","./deleteCourse.php?cid="+id,true);
			xhttp.send();

		}

	</script>

</body>
</html>