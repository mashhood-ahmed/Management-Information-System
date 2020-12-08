<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

 ?>

<?php 
	$pm = new postManager();
	$posts = $pm->getPosts();
 ?>
<!DOCTYPE html>
<html>
<head>
<!-- internal css is used -->
	<style type="text/css">
		#h{
			margin-top: 20px;
			margin-bottom: 20px;
			color: #292838;
		}	

		p {
			text-align: justify;
		}

		#user {

			float: right;
			padding: 5px;
			font-weight: bold;
			color: gray;
		}

		#label{
			color: #17639e;
		}

		
	</style>
</head>

<body>

	<div id="user">
		Current Admin: <?php echo $_SESSION['f'] . " " . $_SESSION['l']; ?>
	</div>

	<h2 id="h">
		<?php if(mysqli_num_rows($posts) < 1){
			echo "No Post is uploaded";
		
		} else { 
	?>
	</h2>

	
		<?php 

			while($row=mysqli_fetch_array($posts)) {

				echo "<div style='margin-bottom:50px;'>";

				?>
					<h2 id="label"><?php echo $row['title']; ?></h2>
				<?php  

				if($row['description'] != "") {

					?>
					<p><?php echo $row['description']; ?></p>
					<?php  
				}

				if($row['file'] != "") {
					?>
					<div id="attach"><a href="./uploads/<?php echo $row['file']; ?>"><?php echo "View/Download Attachment" ?></a></div>
					<?php 
				}

				?>
				
				<div class="mt-1">
					<a class='btn btn-light' href='index.php?updPost=<?php echo $row['id']; ?>'>Update</a>&nbsp; <a class='btn btn-light' href="" onclick="deletePost('<?php echo $row['id'] ?>')" >Delete</a>
				</div>
		

				<?php  
				echo "</div>";
			}


		}
		 ?>

		 <script type="text/javascript">
		
		function deletePost(str) {

			let xhttp = new XMLHttpRequest();
			xhttp.open('GET','./DeleteStudentRecordAjax.php?post='+str,true);
			xhttp.send();

		}

	</script>

</body>
</html>