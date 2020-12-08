<?php 

if(!isset($_SESSION['id']) && !isset($_SESSION['username'])) {

		header("location: ../index.php");
}	

if(isset($_GET['ReadMore'])) {

	$id = $_GET['ReadMore'];
	$data = $cm->getSpecificComplaint($id);
	$row = mysqli_fetch_array($data);
}


?>

<div>
	
<div class="mt-2 pr-2 text-right" id="cross">
		<a style="border:2px solid #c2c2a3; color:#c2c2a3; padding:5px; border-radius:20px;" href="index.php?complaint">X</a>
</div>

<div class="p-1 mt-2"><h2><?php echo $row['title']; ?></h2></div>
<div>
	<div style="font-size:20px;" class="text-justify p-1 mt-2"><?php echo $row['description']; ?></div>
</div>


</div>