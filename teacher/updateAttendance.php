<?php 

	if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

		header("location: ../index.php");
	}

	if(isset($_GET['updAtt'])) {

		$att = $_GET['updAtt'];
		$attendance = $am->getAttendanceOnId($att);
		$teacher = $_SESSION['id'];

	}	


 ?>

 <!DOCTYPE html>
 <html>
 <head>
<!-- internal css is used -->
	<style type="text/css">
		h2{
			margin-bottom: 20px;
			text-align: center;
			color: #292838;
		}	

		label{
			color: #17639e;
		}

		#table-box {
			width: 1000px;			
			margin: 20px auto 20px auto;
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
 <body>
 	
 	<div id="cross">
		<a href="index.php?cou=<?php echo $_GET['cou']; ?>&section=<?php echo $_GET['sec']; ?>&sem=<?php echo $_GET['sem']; ?>&week=<?php echo $_GET['wek']; ?>&mbtn=View+Attendance">X</a>
	</div>	

 	<h2>Update Attendance</h2>

 	<div id="table-box">

 	<form action="" method="post">

 		<table class="table text-center table-striped">

 			<tr>
 				<th>ID</th>

 				<th>REGISTRATION</th>

 				<th>NAME</th>

 				<th>ATTENDANCE</th>
 				
 			</tr>

 			<tr>
 				<td>1</td>

 				<td><?php echo $attendance['reg_no']; ?></td>

 				<td><?php echo $attendance['fname'] . " " . $attendance['lname']; ?></td>

 				<td>

 					<?php 

 						if($attendance['attendance'] == "Present") {

 							?>

 							<label for="p"><strong>P</strong></label> &nbsp;<input id="p" type="radio" checked name="attn" value="Present" />

 							<label for="a"><strong>A</strong></label> &nbsp;<input id="a" type="radio" name="attn" value="Absent" />

 							<label for="l"><strong>L</strong></label> &nbsp;</label><input id="l" type="radio" name="attn" value="Leave" />

 							<?php

 						} else if ($attendance['attendance'] == "Absent") {

 							?>

 							<label for="p"><strong>P</strong></label>&nbsp;<input id="p" type="radio" name="attn" value="Present" />

 							<label for="a"><strong>A</strong></label>&nbsp;<input id="a" type="radio" checked name="attn" value="Absent" />

 							<label for="l"><strong>L</strong></label>&nbsp;<input id="l" type="radio" name="attn" value="Leave" />

 							<?php
 						
 						} else {

 							?>

 							<label for="p"><strong>P</strong></label> &nbsp;<input id="p" type="radio" name="attn" value="Present" />

 							<label for="a"><strong>A</strong></label> &nbsp;<input id="a" type="radio" name="attn" value="Absent" />

 							<label for="l"><strong>L</strong></label> &nbsp;<input id="l" type="radio" checked name="attn" value="Leave" />
 							
 							<?php	

 						}

 					 ?>                 
 				</td>
 			</tr>

 		</table>

 		<div class="form-group">

 			<label for="name">Select Week</label>

 			<select name="week" class="form-control">

 				<option  selected value="<?php echo $attendance['week']; ?>"><?php echo $attendance['week']; ?></option>

 				<?php 

 					while ($row = mysqli_fetch_array($weeks)) {
					
 						if($row['week'] != $attendance['week']) {

 						?>

 						<option value="<?php echo $row['week']; ?>"><?php echo $row['week']; ?></option>

 						<?php

						}
					}
 				 ?>

 			</select>

 		</div>

 		<div class="form-group">

 			<label for="semester">Pick Date</label>

 			<select name="date" class="form-control" id="date" required>

 				<option selected value="<?php echo $attendance['date']; ?>"><?php echo $attendance['date']; ?></option>

 				<?php 

 					while($date = mysqli_fetch_array($dates)) {

 						if($date['date'] != $attendance['date']) {

 						?>

 						<option value="<?php echo $date['date']; ?>"><?php echo $date['date']; ?></option>

 						<?php

 					}

 					}

 				 ?>	

 			</select>

 		</div>

 		<input type="submit" value="Update Attendance" name="updateAtt" class="btn btn-success" />

 	</form>

 	</div>

 </body>
 </html>

 <?php 

 	class Attendance {

 		private $attendance ;
 		private $week;
 		private $date;

 		public function __construct($att,$week,$date) {

 			$this->attendance = $att;
 			$this->week = $week;
 			$this->date = $date;
 		}

 		public function getAttendance() {

 			return $this->attendance;
 		}

 		public function getWeek() {

 			return $this->week;
 		}

 		public function getDate() {

 			return $this->date;
 		}

 	}


 	if(isset($_POST['updateAtt'])) {

 		$atten = $_POST['attn'];
 		$week = $_POST['week'];
 		$date = $_POST['date'];

 		$a = new Attendance($atten,$week,$date);
 		$f = $am->updateAttendance($a,$att);	

 		if($f) {

 			echo "<script>alert('Attendance is successfully updated ...');</script>";
 		
 		
 		} else {

 			echo "
			 		<div style='margin-top: 20px;' class='alert alert-danger'>
			 		<strong>Error!</strong>
			 		&nbsp;
			 		Attendance is not updated! Please try again .. 
			 		</div>
			 	";
 		}

 		
 	}

 		

  ?>