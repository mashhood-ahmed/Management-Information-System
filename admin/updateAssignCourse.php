<?php 
	

	if(!isset($_SESSION['admin'])) {

	 echo "<script>window.open('../index.php','_self')</script>";

	}

 ?>

<?php 

	if(isset($_GET['updac'])) {

		$c_id = $_GET['updac'];
		$c = $cm->getCourses(); // get all courses
		$c1 = $cm->getSpecificCourse();
		$t = $tm->getTeachers(); // get all teachers
		$record = $acm->getRecord($c_id); // get required record from DataManager file

		// $c_title = $cm->getAcourseById($c_id);
		// $t_name = $cm->getAcourseTeacherById($c_id);
		// $s_semester = $cm->getAcourseSemesterById($c_id);
		// $a_section = $cm->getAcourseSectionById($c_id);
		// $a_session = $cm->getAcourseSessionById($c_id);
		// $a_class = $cm->getAcourseClassById($c_id);

	}	

 ?>

<!DOCTYPE html>
<html>
<head>
	<!-- internal css is used -->
	<style type="text/css">
		h2{
			margin-top: 0px;
			margin-bottom: 20px;
			color: #292838;
		}	

		label{
			color: #17639e;
		}

		form {
			margin-bottom: 20px;
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
		<a href="index.php?viewassgniedCourse">X</a>
	</div>

	<h2>Update Assigned Course</h2>

	<form action="" method="post"> 


		<div class="form-group">

			<label for="course">Select Course</label>

			<select  name="course" required class="form-control form-control-sm" id="course">
				
				<option selected disabled value=""><?php echo $record['title']; ?></option>

				<?php 

					while($row=mysqli_fetch_array($c1)) {

						?>
						<option><?php echo $row['title']; ?></option>
						<?php

					}

				 ?>

			</select>

		</div>

		<div class="form-group">

			<label for="teacher">Select Teacher</label>

			<select name="teacher" class="form-control form-control-sm" id="teacher">

				<option value="<?php $record['t_id']; ?>" selected><?php echo $record['fname']." ".$record['lname']; ?></option>

				<?php 

					while($row=mysqli_fetch_array($t)) {

						if($record['t_id'] != $row['t_id']) {

							?>

							<option value="<?php echo $row['t_id']; ?>"><?php echo $row['fname'] . " " . $row['lname']; ?></option>

							<?php  	
						}

						
					}

				 ?>
			</select>
		</div>

		
		<div class="form-group">

			<label for="semester">Select Semester</label>
			
			<select name="semester" class="form-control form-control-sm" id="semester">
				
				<option selected ><?php echo $record['semester']; ?></option>
				
				<?php $sem=array("1st"=>"1st","2nd"=>"2nd","3rd"=>"3rd","4th"=>"4th",
								 "5th"=>"5th","6th"=>"6th","7th"=>"7th","8th"=>"8th",);

					foreach ($sem as $key => $value) {

						if($record['semester'] != $key && $record['semester'] != $value){

							echo "<option value='$key'>$value</option>";
						}
					}

				 ?>

			</select>
		</div>

		<div class="form-group">

			<label for="section">Select Section</label>
			
			<select name="section" class="form-control form-control-sm" id="section">
				
				<option selected ><?php echo $record['section']; ?></option>
				
				<?php 

					$sec=array("A"=>"A","B"=>"B","Both"=>"Both");
					
					foreach ($sec as $key => $value) {
						
						if($record['section'] != $key && $record['section'] != $value) {

							echo "<option value='$key'>$value</option>";
						}
					}
				 ?>
			</select>

		</div>

		<div class="form-group">
			
			<label for="session">Session</label>
			
			<input required value="<?php echo $record['session']; ?>" type="text" name="session" id="session" class="form-control form-control-sm" />

		</div>

		<div class="form-group">

			<label for="class">Class</label>
			
			<select name="class" class="form-control form-control-sm" id="class">
				
				<option selected><?php echo $record['class']; ?></option>
				
				<?php 

					if($record['class'] != "Regular"){

						echo "<option value='Regular'>Regular</option>";

					} else {

						echo "<option value='Summer'>Summer</option>";
					}
				 ?>

			</select>
		</div>

		<input type="submit" name="addbtn" class="btn btn-success" value="Update Course" />

	</form>


</body>
</html>

<?php 

	class updateAssignCourse {

		private $teacher;
		private $course;
		private $semester;
		private $section;
		private $session;
		private $class;

		public function __construct($teacher,$course,$semester,$section,$session,$class){

			$this->teacher = $teacher;
			$this->course = $course;
			$this->semester =$semester;
			$this->section = $section;
			$this->session = $session;
			$this->class = $class;

		}

		public function getTeacher() {
			return $this->teacher;
		}

		public function getCourse() {
			return $this->course;
		}

		public function getSemester() {
			return $this->semester;
		}

		public function getSection() {
			return $this->section;
		}

		public function getSession() {
			return $this->session;
		}

		public function getClass() {
			return $this->class;
		}

	}

	// if submit button is click run the following code

	if(isset($_POST['addbtn'])){

		$teacher = $_POST['teacher'];
		$cou = $_POST['course'];
		$semester = $_POST['semester'];
		$section = $_POST['section'];
		$session = $_POST['session'];
		$class = $_POST['class'];
		

		$course = new updateAssignCourse($teacher,$cou,$semester,$section,$session,$class);

		
		
			$f = $cm->updateAssignCourse($course,$c_id);

			if($f) {

				echo "<script>alert('Record is successfully updated ...')</script>";
				echo "<script>window.location.assign('index.php?updac='+$c_id)</script>";

			} else {

				echo "
			 		<div style='margin-top: 20px;' class='alert alert-success'>
			 		<strong>Success!</strong>
			 		&nbsp;
			 		Record is successfully updated
			 		</div>
			 	";	
			}

	
		

	}



 ?>