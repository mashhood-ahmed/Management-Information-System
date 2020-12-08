<?php 
	
	$record = $dm->getProfile($_SESSION['id']);

	$sems = array("1st","2nd","3rd","4th","5th","6th","7th","8th");
	$secs = array("A","B");

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
	<a href="index.php?home">X</a>
</div>
	


 <h2>My Profile</h2>

 <form action="" method="post">
 	
 	<div class="form-group">
 		<label for="user">Username:</label>
 		<input type="text" class="form-control" name="user" id="user" value="<?php echo $record['username']; ?>" />
 	</div>


 	<div class="form-group">
 		<label for="reg">Registration No:</label>
 		<input type="text" disabled class="form-control" name="reg" id="reg" value="<?php echo $record['reg_no']; ?>" />
 	</div>

 	<div class="form-group">
		<label for="f">First Name:</label>
		<input type="text" required name="fname" id="f" class="form-control" value="<?php echo $record['fname']; ?>" /> 
 	</div>

 	<div class="form-group">
		<label for="l">Last Name:</label>
		<input type="text" required name="lname" id="l" class="form-control" value="<?php echo $record['lname']; ?>" /> 
 	</div>

 	<div class="form-group">
		<label for="sem">Semester:</label>
		<select name="sem" id="sem" class="form-control">
			<option value="<?php echo $record['semester']; ?>"><?php echo $record['semester']; ?></option>
			
			<?php

				foreach($sems as $s)
					if($s != $record['semester'])
						echo "<option value='$s'>$s</option>";
			 ?>

		</select> 
 	</div>

 	<div class="form-group">
		<label for="sec">Section:</label>

		<select name="sec" id="sec" class="form-control" >
			<option value="<?php echo $record['section']; ?>"><?php echo $record['section']; ?></option>
			<?php

				foreach($secs as $s)
					if($s != $record['section'])
						echo "<option value='$s'>$s</option>";
			 ?>

		</select>

 	</div>

 	<div class="form-group">
		<label for="ema">Email:</label>
		<input type="email" name="ema" value="<?php echo $record['email']; ?>" id="ema" class="form-control"  /> 
 	</div>

 	<div class="form-group">
		<label for="new">New Password:</label>
		<input type="password" name="npass" id="new" class="form-control"  /> 
 	</div>

 	<div class="form-group">
		<label for="con">Confirm Password:</label>
		<input type="password" name="cpass" id="con" class="form-control"  /> 
 	</div>


 	<input type="submit" onclick="profileValidation()" class="btn btn-success" name="pro" value="Update Profile" />

 </form>

 <ul id="showError" style="text-align: center; margin-top: 20px; color: red; list-style: none; font-family: 'Courier New';">
 		
 	</ul>

 </body>
 </html>

 <?php 

class profile {

	private $semester;
	private $section;
	private $email;
	private $fname;
	private $lname;
	private $pass;
	private $user;

	public function __construct($user,$sem,$sec,$ema,$fname,$lname,$pass) {

		$this->semester = $sem;
		$this->section = $sec;
		$this->email = $ema;
		$this->fname = $fname;
		$this->lname = $lname;
		$this->pass = $pass;
		$this->user = $user;

		
	}

	public function getEmail() {

		return $this->email;
	}

	public function getSemester() {

		return $this->semester;
	}

	public function getUser() {

		return $this->user;
	}

	public function getSection() {

		return $this->section;
	}

	public function getFname() {

		return $this->fname;	
	}

	public function getLname() {

		return $this->lname;	
	}

	public function getPass() {

		return $this->pass;
	}
}

	if(isset($_POST['pro'])) {

		$user = $_POST['user'];
		$sem = $_POST['sem'];
		$sec = $_POST['sec'];
		$email = $_POST['ema'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$npass = $_POST['npass'];
		$cpass = $_POST['cpass'];


		$profile = "";

		if($npass == null && $cpass == null) {

			$profile = new profile($user,$sem,$sec,$email,$fname,$lname,7);
			echo $res = $dm->updateProfile($profile,$_SESSION['id']);

				if($res) {

					echo "<script>alert('Your Profile Is Successfully Updated ..')</script>";
					echo "<script>window.location.assign('index.php?profile')</script>";

				} else {

					echo "<script>alert('Internal Problem Occured')</script>";
				}			
		
		} else {

			if($npass != $cpass) {

				echo "<script>alert('Passwords Not Matched! Please Try Again')</script>";
			
			} else {

				$profile = new profile($user,$sem,$sec,$email,$fname,$lname,$npass);
				$res = $dm->updateProfile($profile,$_SESSION['id']);

				if($res) {

					echo "<script>alert('Your Profile Is Successfully Updated ..')</script>";
					echo "<script>window.location.assign('index.php?profile')</script>";

				} else {

					echo "<script>alert('Internal Problem Occured')</script>";
				}

			}

		

}
		
	}	


  ?>