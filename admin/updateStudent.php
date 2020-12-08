<?php 
	

	if(!isset($_SESSION['admin'])) {

	 echo "<script>window.open('../index.php','_self')</script>";

	}

 ?>

<?php 

	if(isset($_GET['updStd'])) {

		$std_id = $_GET['updStd'];
		$dm = new studentManager();
		$std_reg  = $dm->getStdRegistrationOnId($std_id);
		$std_fname = $dm->getStdFNameOnId($std_id);
		$std_lname = $dm->getStdLNameOnId($std_id);
		$std_semester = $dm->getStdSemesterOnId($std_id);
		$std_section = $dm->getStdSectionOnId($std_id);
		$std_email = $dm->getStdEmailOnId($std_id);
		$std_pass = $dm->getStdPasswordOnId($std_id);

		$sem = array($std_semester,"1st","2nd","3rd","4th","5th","6th","7th","8th");
		$sec = array($std_section,"A","B");
		

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
		<a href="index.php?semester=<?php echo $std_semester; ?>&viewbtn=View">X</a>
</div>


<h2>Update Student Record</h2>

<form action="" method="post"> 

		<div class="form-group">
			<label for="reg_no">Registration No</label>
			<input type="text" name="reg" value="<?php echo $std_reg;  ?>" class="form-control form-control-sm" id="reg_no" />
		</div>


		<div class="form-group">
			<label for="fname">First Name</label>
			<input type="text" name="fname" value="<?php echo $std_fname;?>" id="fname" class="form-control form-control-sm" />
		</div>

		<div class="form-group">
			<label for="lname">Last Name</label>
			<input type="text" name="lname" value="<?php echo $std_lname;?>" class="form-control form-control-sm" id="lname" />
		</div>

		<div class="form-group">
			<label>Semester</label>
			<select name="semester" class="form-control">
				<option selected value="<?php echo $sem[0] ?>"><?php echo $sem[0]; ?></option>
				<?php 
					foreach($sem as $d){
						
						if($d != $std_semester)
							echo "<option value='$d'>$d</option>";	
					}
				 ?>
				
			</select>
		</div>

		<div class="form-group">
			<label>Section</label>
			<select name="section" class="form-control">
				<option selected value="<?php echo $sec[0]; ?>"><?php echo $sec[0]; ?></option>
				<?php 
				foreach ($sec as $d) {
					if($d != $std_section) {
						echo "<option value='$d'>$d</option>";
					}
				}
				 ?>
			</select>
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" value="<?php echo $std_email;?>" class="form-control form-control-sm" id="email" />
		</div>

		<div class="form-group">
			<label for="pass1">New Password</label>
			<input type="password" name="pass1" value="<?php echo $std_pass;?>" class="form-control form-control-sm" id="pass1" />
		</div>

		<div class="form-group">
			<label for="pass2">Confirm Password</label>
			<input type="password" name="pass2" value="<?php echo $std_pass;?>" class="form-control form-control-sm" id="pass2" />
		</div>

	
		<input type="submit" name="addbtn" class="btn btn-success" value="Update" />


	</form>



</body>
</html>

<?php 

	class UpdateStudent {

		private $_regNo;
		private $_fname;
		private $_lname;
		private $_semester;
		private $_section;
		private $_email;
		private $_pass1;
		private $_pass2;

		public function __construct($reg,$fname,$semester,$section,$lname,$email,$pass1,$pass2){

			$this->_regNo = $reg;
			$this->_fname = $fname;
			$this->_lname = $lname;
			$this->_semester = $semester;
			$this->_section = $section;
			$this->_email = $email;
			$this->_pass1 = $pass1;
			$this->_pass2 = $pass2;
		}

		public function getRegNo(){
			return $this->_regNo;
		}

		public function getFirstName(){
			return $this->_fname;
		}

		public function getLastName(){
			return $this->_lname;
		}

		public function getSemester(){
			return $this->_semester;
		}

		public function getSection(){
			return $this->_section;
		}

		public function getEmail(){
			return $this->_email;
		}

		public function getPassOne(){
			return $this->_pass1;
		}

		public function getPassTwo(){
			return $this->_pass2;
		}

	}

	// if submit button is click run the following code

	if(isset($_POST['addbtn'])){

		$reg = $_POST['reg'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$semester = $_POST['semester'];
		$section = $_POST['section'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];

		if($pass1 == $pass2) {
			$student = new UpdateStudent($reg,$fname,$semester,$section,$lname,$email,$pass1,$pass2);

			if($dm->youCan($reg) || $reg == $std_reg){

			$f = $dm->updateStudent($student,$std_id);

			if($f) {

				echo "<script>alert('Student is successfully updated ...')</script>";
				echo "<script>window.location.assign('index.php?viewStudent')</script>";

			} else {

				echo "
			 		<div style='margin-top: 20px;' class='alert alert-danger'>
			 		<strong>Error!</strong>
			 		&nbsp;
			 		Student is not updated! Please try again
			 		</div>
			 	";
			}

			} else {
			echo "<script>alert('Student is already exists')</script>";				
			}
		
		} else {

			echo "<script>alert('Passwords not matched! Try Again')</script>";
		}

		
		

	}
	

 ?>