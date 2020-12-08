<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

 ?>

<?php 

	if(isset($_GET['updCou'])) {

		$c_id = $_GET['updCou'];

		$title = $cm->getCourseTitleOnId($c_id);
		$codee = $cm->getCourseCodeOnId($c_id);
		$credit = $cm->getCourseCreditId($c_id);

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
		<a href="index.php?viewCourse">X</a>
	</div>

	<h2>Update Course</h2>

	<form action="" method="post"> 


		<div class="form-group">
			<label for="title">Title</label>
			<input value="<?php echo $title; ?>" type="text" name="title" id="title" class="form-control form-control-sm" />
		</div>

		<div class="form-group">
			<label for="code">Code</label>
			<input value="<?php echo $codee; ?>" type="text" disabled name="code" class="form-control form-control-sm" id="code" />
		</div>

		
		<div class="form-group">
			<label for="credit">Credit</label>
			<input value="<?php echo $credit; ?>" type="number" name="credit" class="form-control form-control-sm" id="credit" />
		</div>

		<input type="submit" onclick="courseValidation()" name="caddbtn" class="btn btn-success" value="Update Course" />

	</form>


</body>
</html>

<?php 

	class updCourse {

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

	if(isset($_POST['caddbtn'])){

		$title = @$_POST['title'];
		$code = @$_POST['code'];
		$credit = @$_POST['credit'];	


		$course = new updCourse($title,$code,$credit);

		if($cm->youCan($code) || $code == $codee) {

		$f = $cm->updateCourse($course,$c_id);

		if($f) {

			echo "<script>alert('Course is successfully updated ...')</script>";
			echo "<script>window.location.assign('index.php?viewCourse')</script>";

		} else {

			echo "
			 		<div style='margin-top: 20px;' class='alert alert-danger'>
			 		<strong>Error!</strong>
			 		&nbsp;
			 		Course is not updated! Please try again
			 		</div>
			 	";	
		}

		} else {

			echo "<script>alert('Course is already exists')</script>";
		} 



	}

 ?>

