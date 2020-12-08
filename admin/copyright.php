<?php 
	

	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

 ?>

<?php 

	$copy = new copyRight();
	$text = $copy->getCopyRight();

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
		<a href="index.php?home">X</a>
	</div>

	<h2>Change Copyright Text</h2>

	<form action="" method="post">
		
		<div class="form-group">
			<label for="copy">Update Text</label>
			<input type="text" class="form-control form-control-sm" id="copy" name="copy" value="<?php echo $text; ?>" />
		</div>

		<input type="submit" class="btn btn-success" name="updbtn" value="Update Text" />

	</form>

</body>
</html>

<?php 

	class copyText {

		private $text;

		public function __construct($text) {

			$this->text = $text;
		}

		public function getText() {

			return $this->text;
		}
	}

	if(isset($_POST['updbtn'])) {

		$text = $_POST['copy'];

		$c = new copyText($text);
		$copy->updateCopyRight($c);
	}

 ?>