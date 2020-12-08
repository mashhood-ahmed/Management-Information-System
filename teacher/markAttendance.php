<?php 
if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

		header("location: ../index.php");
	}
 ?>
<?php 

	if (isset($_GET['course']) && isset($_GET['semester']) && isset($_GET['section']) && isset($_GET['mbtn'])) {
		

		$semester = $_GET['semester'];
		$section = $_GET['section'];
		$course = $_GET['course'];	
		$session_class =  $dm->getSessionAndClass($course,$_SESSION['id']);
		$std_data =  $dm->getStudentsBySecAndSem($semester,$section);

	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<!-- internal css is used -->
	<style type="text/css">
		h5{

			text-align: center;
			color: grey;	
			margin-bottom: 20px;
			
		}	

		label{
			color: #17639e;
		}

		#table-box {

			width: 1000px;
			margin: 0px auto 20px auto;

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
		<a href="index.php?markAttendance">X</a>
	</div>	
  		
 	<h5>
 		<div><strong>Course:</strong> <?php echo $dm->getCourseId($course); ?></div>
 		<div><strong>Semester:</strong> <?php echo $semester; ?></div>
 		<div><strong>Section:</strong> <?php echo $section; ?></div>
 		<div><strong>Session:</strong> <span><?php echo $session_class[0]; ?></span></div>
 	</h5>

 	<div id="table-box">

  	<form action="" method="post">

 		<table class="table  table-striped text-center">
 		<tr>
 			<th>ID</th>
 			<th>REGISTRAION</th>
 			<th>NAME</th>
 			<th>ATTENDANCE</th>
 		</tr>

 		<?php 

 			$s = 1;

 			while($data = mysqli_fetch_array($std_data)) {
 				?>
 				<tr>
 					<td><?php echo $s++; ?></td>

 					<td><?php echo $data['reg_no']; ?></td>

 					<td><?php echo $data['fname'] . " " . $data['lname']; ?></td>

 					<td>
 						
 						<label><strong>P</strong></label> &nbsp;<input id="p" type="radio" name="atten[<?php echo $data['std_id']; ?>]" value="Present" required />

 						<label><strong>A</strong></label> &nbsp;<input id="a" type="radio" name="atten[<?php echo $data['std_id']; ?>]" value="Absent" required />

 						<label><strong>L</strong></label> &nbsp;<input id="l" type="radio" name="atten[<?php echo $data['std_id']; ?>]" value="Leave" required />

 					</td>

 				</tr>

 				<?php
 			}

 		 ?>

 	</table>

 		<div class="form-group">
 			<label for="week">Select Week</label>
 			<select name="week" class="form-control" id="week" required>
 				<option disabled selected value="">Select Week</option>
 				<option value="Week 1">Week 1</option>
 				<option value="Week 2">Week 2</option>
 				<option value="Week 3">Week 3</option>
 				<option value="Week 4">Week 4</option>
 				<option value="Week 5">Week 5</option>
 				<option value="Week 6">Week 6</option>
 				<option value="Week 7">Week 7</option>
 				<option value="Week 8">Week 8</option>
 				<option value="Week 9">Week 9</option>
 				<option value="Week 10">Week 10</option>
 				<option value="Week 11">Week 11</option>
 				<option value="Week 12">Week 12</option>
 				<option value="Week 13">Week 13</option>
 				<option value="Week 14">Week 14</option>
 				<option value="Week 15">Week 15</option>
 				<option value="Week 16">Week 16</option>
 				<option value="Week 17">Week 17</option>
 				<option value="Week 18">Week 18</option>
 			</select>
 		</div>

 		<div class="form-group">
 			<label for="date">Pick Date</label>
 			<input type="date" name="date" class="form-control" id="date" required />
 		</div>

 		<input type="submit" name="sub" value="Mark Attendance" class="btn btn-success" />

 		</form> 

 		</div>

 </body>
 </html>

 <?php 
 
 class Attendance {

 	private $attendance;
 	private $section;
 	private $semester;
 	private $week;
 	private $date;
 	private $courseId;
 	private $teacherId;

 	public function __construct($attendance,$sec,$sem,$week,$date,$cid,$tid) {

 		$this->attendance = $attendance;
 		$this->section = $sec;
 		$this->semester = $sem;
 		$this->week = $week;
 		$this->date = $date;
 		$this->cid = $cid;
 		$this->tid = $tid;

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

 	public function getSemester() {
 		
 		return $this->semester;
 	}

 	public function getSection() {
 		
 		return $this->section;
 	}

 	public function getCid(){

 		return $this->cid;
 	}

 	public function getTid() {

 		return $this->tid;
 	}

 }

 if(isset($_POST['sub'])) {

 	$attendance = $_POST['atten'];
 	$week = $_POST['week'];
 	$date = $_POST['date'];

 	$c_id = $_GET['course'];
	$t_id = $_SESSION['id'];
 	
 	$sec = $section;
 	$sem = $semester;

 	$atten = new Attendance($attendance,$sec,$sem,$week,$date,$c_id,$t_id);
 	
 	$flag = $am->checkAttendance($c_id, $date, $sem, $sec);	
 	
 	if(!$flag) {

 		$am->uploadAttendance($atten);
 	
 	} else {

 		echo "<script>alert('Attendance Has Been Taken On That Date ...')</script>";	
 	}

 }


  ?>