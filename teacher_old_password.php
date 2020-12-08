<?php 
	
	$conn = new mysqli("localhost", "root", "", "csit");

	$id =  $_GET['id'];
	$query = "SELECT * FROM teachers WHERE t_id=$id";
	$run = mysqli_query($conn,$query);

	if($run) {

		if(mysqli_num_rows($run) > 0) {

			$data = mysqli_fetch_array($run);
			echo "Your Password Is: " . "<strong><u>" .  $data['password'] . "</u></strong><br><a href='./logout.php?backCode'>Back To Login</a>";
		
		} else {

			echo "Code is wrong! Please enter the valid one";
		}
	} else {

		echo "Internal Problem Occured";
	}

 ?>