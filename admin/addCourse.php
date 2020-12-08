<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 header("location: ../index.php?admin");

	}


 ?>

<!DOCTYPE html>
<html>
<head>
	
	<!-- internal css is used -->
	<style type="text/css">
		h2{
			margin-top: 10px;
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

	<h2 class="text-center">Register New Course</h2>

	<form action="" method="post"> 


		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" placeholder="e.g. OOP" name="title" id="title" class="form-control form-control-sm" />
		</div>

		<div class="form-group">
			<label for="code">Code</label>
			<input type="text" name="code" placeholder="e.g. CS-1" class="form-control form-control-sm" id="code" />
		</div>

		
		<div class="form-group">
			<label for="credit">Credit</label>
			<input type="number" placeholder="3" name="credit" class="form-control form-control-sm" id="credit" />
		</div>


		<input type="submit" onclick="courseValidation()" name="addbtn" class="btn btn-success" value="Register Course" />

	</form>

	<div style="text-align: center; color: red; list-style: none; font-family: 'Courier New'" id="showError">
		
	</div>

</body>
</html>

<!-- php code to upload course data into database -->
<?php 

	class addCourse {

		private $title;
		private $code;
		private $credit;	


		public function __construct($title,$code,$credit){

			$this->title = $title;
			$this->code = $code;
			$this->credit = $credit;
		}

		public function getTitle(){
			return $this->title;
		}

		public function getCode(){
			return $this->code;
		}

		public function getCredit(){
			return $this->credit;
		}

	}

	// if submit button is click run the following code

	if(isset($_POST['addbtn'])){

		$title = $_POST['title'];
		$code = $_POST['code'];
		$credit = $_POST['credit'];	


		$course = new addCourse($title,$code,$credit);
		
		
		if($cm->youCan($code)){
		
		$f = $cm->uploadCourse($course);

		if($f) {

			echo "<script>alert('Course is successfully registered ... ')</script>";

		} else {

			echo "
			 		<div style='margin-top: 20px;' class='alert alert-danger'>
			 		<strong>Error!</strong>
			 		&nbsp;
			 		Course is not uploaded! Please try again
			 		</div>
			 	";
		}
		
		}else{
			echo "<script>alert('Course is already registered')</script>";	
		}


	}

 ?>