<?php 

	header("Access-Control-Allow-Origin:*");

		

			$conn = new mysqli("localhost","root","","csit");

			// block for deleting attendence record
			if(isset($_GET['i'])) {

			$id = $_GET['i'];
			$query = "DELETE FROM attendance WHERE at_id=$id";
			$run = mysqli_query($conn,$query);
			
			}

			// block for deleteing internal marks

			if(isset($_GET['marks'])) {

				$id =  $_GET['marks'];
				$query = "DELETE FROM internal_marks WHERE m_id=$id";
				$run = mysqli_query($conn,$query);				
			}	

			// block for deleteing complaints

			if(isset($_GET['comp'])) {

				$id =  $_GET['comp'];
				$query = "DELETE FROM complaint WHERE id=$id";
				$run = mysqli_query($conn,$query);				
			}	

			// block for deleteing post

			if(isset($_GET['post'])) {

				$id =  $_GET['post'];
				$query = "DELETE FROM post WHERE id=$id";
				$run = mysqli_query($conn,$query);				
			}	
 ?>