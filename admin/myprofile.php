<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

	//echo "you are on my profile page";
	$dm = new dataManager();
	$rec = $dm->getProfile();
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
 		<input type="text" required value="<?php echo $rec['username']; ?>" name="user" id="user" class="form-control" />
 	</div>

 	<div class="form-group">  
 		<label for="fname">First Name:</label>
 		<input type="text" required value="<?php echo $rec['fname']; ?>" name="fname" id="fname" class="form-control" />
 	</div>

 	<div class="form-group"> 
 		<label for="lname">Last Name:</label>
 		<input type="text" required value="<?php echo $rec['lname']; ?>" name="lname" id="lname" class="form-control" />
 	</div>

 	<div class="form-group">
 		<label for="ema">Email Address:</label>
 		<input type="email" required value="<?php echo $rec['email']; ?>" name="ema" id="ema" class="form-control" />
 	</div>

 	<div class="form-group">
 		<label for="old">Current Password:</label>
 		<input type="text" disabled value="<?php echo $rec['pass']; ?>" name="opass" id="old" class="form-control" />
 	</div>

	<div class="form-group">
 		<label for="new">New Password:</label>
 		<input type="password" name="npass" id="new" class="form-control" />
 	</div>

 	<div class="form-group">
 		<label for="conf">Confirm Password:</label>
 		<input type="password" name="cpass" id="conf" class="form-control" />
 	</div> 	

 	<input type="submit" onclick="profileValidation()" name="pro" value="Update Info" class="btn btn-success" />

 </form>

 <ul style="list-style: none; color: red; text-align: center; margin-top: 20px;" id="showError">
 	
 </ul>

 </body>
 </html>

 <?php 

class profile {

	private $user;
	private $fname;
	private $lname;
	private $email;
	private $pass;

	public function __construct($a,$b,$c,$d,$e) {

		$this->user = $a;
		$this->fname = $b;
		$this->lname = $c;
		$this->email = $d;
		$this->pass = $e;
		
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

	public function getEmail() {

		return $this->email;
	}

	public function getPass() {

		return $this->pass;
	}
}

	if(isset($_POST['pro'])) {

		$user = $_POST['user'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['ema'];
		$npass = $_POST['npass'];
		$cpass = $_POST['cpass'];

		$profile = "";

		if($npass == null && $cpass == null) {

			$profile = new profile($user,$fname,$lname,$email,7);
			$res = $dm->updateProfile($profile);

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

				$profile = new profile($user,$fname,$lname,$email,$npass);
				$res = $dm->updateProfile($profile);

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