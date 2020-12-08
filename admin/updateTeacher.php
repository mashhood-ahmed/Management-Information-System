<?php 
	

	if(!isset($_SESSION['admin'])) {

	 echo "<script>window.open('../index.php','_self')</script>";

	}

 ?>

<?php 
	if(isset($_GET['updTeacher'])) {

		$t_id = $_GET['updTeacher'];
		$dm = new teacherManager();
		$f_name =  $dm->getTeacherFnameOnId($t_id);
		$l_name =  $dm->getTeacherLnameOnId($t_id);
		$email_name =  $dm->getTeacherEmailOnId($t_id);
		$pass_name =  $dm->getTeacherPasswordOnId($t_id);
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
		<a href="index.php?viewTeacher">X</a>
	</div>

	<h2>Update Teacher Record</h2>

	<form action="" method="post"> 

		<div class="form-group">
			<label for="fname">First Name</label>
			<input value="<?php echo $f_name; ?>" type="text" name="fname" id="fname" class="form-control form-control-sm" />
		</div>

		<div class="form-group">
			<label for="lname">Last Name</label>
			<input value="<?php echo $l_name; ?>" type="text" name="lname" class="form-control form-control-sm" id="lname" />
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input value="<?php echo $email_name; ?>" type="email" name="email" class="form-control form-control-sm" id="email" />
		</div>

		<div class="form-group">
			<label for="pass1">New Password</label>
			<input value="<?php echo $pass_name; ?>" type="password" name="pass1" class="form-control form-control-sm" id="pass1" />
		</div>

		<div class="form-group">
			<label for="pass2">Confirm Password</label>
			<input value="<?php echo $pass_name; ?>" type="password" name="pass2" class="form-control form-control-sm" id="pass2" />
		</div>

		
		<input type="submit" name="addbtn" class="btn btn-success" value="Update Teacher" />

	</form>

</body>
</html>

<?php

	class updateTeacher { 

		private $_fname;
		private $_lname;
		private $_email;
		private $_pass1;
		private $_pass2;

		public function __construct($fname,$lname,$email,$pass1,$pass2){

			$this->_fname = $fname;
			$this->_lname = $lname;
			$this->_email = $email;
			$this->_pass1 = $pass1;
			$this->_pass2 = $pass2;
		}

		public function getFirstName(){
			return $this->_fname;
		}

		public function getLastName(){
			return $this->_lname;
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

	if(isset($_POST['addbtn'])) {

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];

		if($pass1 == $pass2) {

			$teacher = new updateTeacher($fname,$lname,$email,$pass1,$pass2);

			if($dm->youCan($email) || $email_name == $email) {

			$f = $dm->updTeacher($teacher,$t_id);

			if($f) {

				echo "<script>alert('Teacher is updated successfully ...')</script>";
				echo "<script>window.location.assign('index.php?viewTeacher')</script>";

			} else {

				echo "
			 		<div style='margin-top: 20px;' class='alert alert-danger'>
			 		<strong>Error!</strong>
			 		&nbsp;
			 		Teacher is not updated! Please try again
			 		</div>
			 	";
			}

			} else {

			echo "<script>alert('Teacher is already exists')</script>";				
			}	  
		
		} else {
			echo "<script>alert('Passwords not matched! Try Again')</script>";
		}

	}


 ?>

