<?php 

	if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

		header("location: ../index.php");
	}	

	$record = $dm->getProfile($_SESSION['id']);
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
 		<input type="text" required class="form-control" name="user" id="user" value="<?php echo $record['username']; ?>" />
 	</div>

 	<div class="form-group">
 		<label for="ema">Email:</label>
 		<input type="email" required class="form-control" name="ema" id="ema" value="<?php echo $record['email']; ?>" />
 	</div>

 	<div class="form-group">
		<label for="fname">First Name:</label>
		<input type="text" required name="fname" id="fname" class="form-control" value="<?php echo $record['fname']; ?>" /> 
 	</div>

 	<div class="form-group">
		<label for="lname">Last Name:</label>
		<input type="text" required name="lname" id="lname" class="form-control" value="<?php echo $record['lname']; ?>" /> 
 	</div>

 	<div class="form-group">
		<label for="old">Current Password:</label>
		<input type="text" disabled name="old" id="old" class="form-control" value="<?php echo $record['password']; ?>" /> 
 	</div>

 	<div class="form-group">
		<label for="new">New Password:</label>
		<input type="password" name="npass" id="pass" class="form-control" /> 
 	</div>

 	<div class="form-group">
		<label for="con">Confirm Password:</label>
		<input type="password" name="cpass" id="cpass" class="form-control"  /> 
 	</div>


 	<input type="submit" onclick="profileValidation()" class="btn btn-success" name="pro" value="Update Profile" />

 </form>

 <ul id="showError" style="text-align: center; color: red; font-family: 'Courier New'; list-style: none;">
 	
 </ul>

 </body>
 </html>

 <?php 

class profile {

	private $user;
	private $email;
	private $fname;
	private $lname;
	private $pass;

	public function __construct($user,$a,$b,$c,$d) {

		$this->user = $user;
		$this->email = $a;
		$this->fname = $b;
		$this->lname = $c;
		$this->pass = $d;
		
	}

	public function getEmail() {

		return $this->email;
	}

	public function getUser() {

		return $this->user;
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
		$email = $_POST['ema'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$npass = $_POST['npass'];
		$cpass = $_POST['cpass'];

		$profile = "";

		if($npass == null && $cpass == null) {

			$profile = new profile($user,$email,$fname,$lname,7);
			$res = $dm->updateProfile($profile,$_SESSION['id']);

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

				$profile = new profile($user,$email,$fname,$lname,$npass);
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