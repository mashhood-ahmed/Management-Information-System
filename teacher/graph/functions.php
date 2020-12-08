<?php 

$conn = new mysqli("localhost","root","","csit");

public function getStudentsBySecAndSem($sem,$sec) {

		global $conn;

 		$query = "SELECT std_id , reg_no , fname , lname FROM students WHERE semester='$sem' AND section='$sec' AND status != 'OFF' ";

 		$run = mysqli_query($conn,$query);

 		return $run;

 	}


 ?>