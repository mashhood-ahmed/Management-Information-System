<?php 

if(!isset($_SESSION['id']) && !isset($_SESSION['username'])) {

		header("location: ../index.php");
}	


$data = $cm->getComplaints(); 

if(mysqli_num_rows($data) < 1) {

	?>

	<div class="w3-panel w3-display-container">
		<a href="index.php?home" class="w3-button w3-large w3-display-topright">X</a>
		<h3>No Records Found</h3>
	</div>

	<?php

	
} else {

?>
<div>

	<div class="mt-2 pr-2 text-right" id="cross">
		<a style="border:2px solid #c2c2a3; color:#c2c2a3; padding:5px; border-radius:20px;" href="index.php?home">X</a>
	</div>

	<div class="text-center mt-2"><h2>Student Complaints</h2></div>

	<ul class="ml-4 mt-5">
		
		<?php 

			while($row = mysqli_fetch_array($data)) {

				echo "<li><div><a style='font-size:28px;' href='index.php?ReadMore=$row[id]'>$row[title]</a></div></li>";

			}

		 ?>

	</ul>


</div>


<?php } ?>