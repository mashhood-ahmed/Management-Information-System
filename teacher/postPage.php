<?php 
if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

		header("location: ../index.php");
	}
 ?>
<?php 
	$dm = new dataManager();
	$posts = $dm->getPosts();
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

		#home {
			position: absolute;
			top: 150px;
			left: 330px;
		}

		p {
			text-align: justify;
		}

		#user {

			color: gray;
			float: right;
			padding: 5px;
			font-weight: bold;
		}

		#label{
			color: #17639e;
		}

		
	</style>
</head>
<body>

	<div id="user">Current Teacher: <?php echo $_SESSION['email']; ?></div>

		<?php 

			if(mysqli_num_rows($posts) < 1){

				echo "<h2 class='mt-3'>No Recent Posts</h2>";
				
			
			} else { 


			while($row=mysqli_fetch_array($posts)) {

				echo "<div style='margin-bottom:50px; margin-top:20px;'>";

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
					<div id="attach"><a href="../admin/uploads/<?php echo $row['file']; ?>"><?php echo "View/Download Attachment" ?></a></div>
					<?php 
				}

				echo "</div>";
			}

		}

		 ?>

</body>
</html>
