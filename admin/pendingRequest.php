<?php 

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}
	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<style type="text/css">
		
 		h2{
			margin-top: 0px;
			margin-bottom: 20px;
			color: #292838;
		}

 		#cross {
			margin-top: 10px;
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
 <body onload="stdCount()">
 	
 	<div id="cross">
		<a href="index.php?home">X</a>
	</div>

	<h2>
		Pending Requests
	</h2>

	<table class="table table-striped">
		<tr>
			<td><a style="font-size: 20px;" href="index.php?stdReq">Student Pending Requests</a></td>
			<td id="one"></td>
		</tr>
		<tr>
			<td><a href="index.php?teaReq" style="font-size: 20px;"> Teacher Pending Requests</a></td>
			<td id="two"></td>
		</tr>
	</table>

	<script type="text/javascript">
		
		function stdCount() {

			teaCount();

			let xhttp = new XMLHttpRequest();

			xhttp.onreadystatechange = function() {

			if(this.readyState == 4 && this.status == 200) {

				document.getElementById("one").innerHTML = this.responseText;
			}

		};

		xhttp.open('GET','./getStdReq.php',true);
		xhttp.send();

		}

		function teaCount() {

			let xhttp = new XMLHttpRequest();

			xhttp.onreadystatechange = function() {

				if(this.readyState==4 && this.status==200){

					document.getElementById("two").innerHTML = this.responseText;
				}

			};

			xhttp.open('GET','getTeaReq.php',true);
			xhttp.send();
		}

	</script>

 </body>
 </html>

