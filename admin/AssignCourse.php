<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 header("location: ../index.php?admin");

	}

 ?>

<?php 

	
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
<body onload="loadCourses()">

	<div id="cross">
		<a href="index.php?home">X</a>
	</div>


	<h2 class="text-center">Assign Course</h2>

	<form action="" method="post"> 


		<div class="form-group">
			<label for="course">Select Course</label>
			<select name="course" class="form-control form-control-sm" id="course">

			</select>
		</div>

		<div class="form-group">
			<label for="teacher">Select Teacher</label>
			<select name="teacher" class="form-control form-control-sm" id="teacher">
				<?php 
					foreach ($tm->getTeacherForCourse() as $key => $value) {
						?>
						<option value="<?php echo $value['t_id']; ?>"><?php echo $value['fname'] . " " . $value['lname']; ?></option>
						<?php  
					}

				 ?>
			</select>
		</div>

		
		<div class="form-group">
			<label for="semester">Select Semester</label>
			<select name="semester" class="form-control form-control-sm" id="semester">
				
				<?php 
					$students = $dm->getStudentSemester();
					
					while($row=mysqli_fetch_array($students)) {

						?>
						<option value="<?php echo $row['semester']; ?>"><?php echo $row['semester']; ?></option>
						<?php 
					}	
				 ?>
			</select>
		</div>

		<div class="form-group">
			<label for="section">Select Section</label>
			<select name="section" class="form-control form-control-sm" id="section">
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="Both">Both</option>
			</select>
		</div>

		<div class="form-group">
			<label for="session">Session</label>

			<select id="session" class="form-control" name="session">
				<option value="Fall 2020">Fall 2020</option>
				<option value="Spring 2020">Spring 2020</option>
				<option value="Fall 2021">Fall 2021</option>
				<option value="Spring 2021">Spring 2021</option>
				<option value="Fall 2022">Fall 2022</option>
				<option value="Spring 2022">Spring 2022</option>
				<option value="Fall 2023">Fall 2023</option>
				<option value="Spring 2023">Spring 2023</option>
				<option value="Fall 2024">Fall 2024</option>
				<option value="Spring 2024">Spring 2024</option>
				<option value="Fall 2025">Fall 2025</option>
				<option value="Spring 2025">Spring 2025</option>
				<option value="Fall 2026">Fall 2026</option>
				<option value="Spring 2026">Spring 2026</option>
				<option value="Fall 2027">Fall 2027</option>
				<option value="Spring 2027">Spring 2027</option>
				<option value="Fall 2028">Fall 2028</option>
				<option value="Spring 2028">Spring 2028</option>
				<option value="Fall 2029">Fall 2029</option>
				<option value="Spring 2029">Spring 2029</option>
				<option value="Fall 2030">Fall 2030</option>
				<option value="Spring 2030">Spring 2030</option>
			</select>

		</div>

		<!-- <div class="form-group">
			<label for="class">Class</label>
			<select name="class" class="form-control form-control-sm" id="class">
				<option value="Regular">Regular</option>
				<option value="Summer">Summer</option>
			</select>
		</div> -->

		<input type="submit" name="addbtn" class="btn btn-success" value="Assign Course" />

	</form>

</body>
</html>

<!-- php code to upload assigned course into database -->
<?php 

	class AssignCourse {

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
		$class = "0";
		

		$course = new AssignCourse($teacher,$cou,$semester,$section,$session,$class);

		$data = $acm->checkAssignCourse($teacher,$cou);
		
		if($data) {
					
			$f = $acm->uploadAssignCourse($course);

			if($f) {

				echo "<script>alert('Course is successfully assigned ...')</script>";
				echo "<script>window.location.assign('./index.php?assignCourse')</script>";	

			} else {

				echo "
			 		<div style='margin-top: 20px;' class='alert alert-danger'>
			 		<strong>Error!</strong>
			 		&nbsp;
			 		Course is not assigned! Please try again
			 		</div>
			 	";
			}

		}else {

			echo "<script>alert('Course is already assigned to a teacher')</script>";

		}


		

	}



 ?>

<script type="text/javascript">
	
	function loadCourses() {

		let xhttp = new XMLHttpRequest();

				xhttp.onreadystatechange = function() {

					if(this.readyState == 4 && this.status == 200) {

						document.getElementById("course").innerHTML = this.responseText;
					}

				};

				xhttp.open("GET","./get_courses_for_assign_course_ajax.php",true);
				xhttp.send();
	}


</script>

