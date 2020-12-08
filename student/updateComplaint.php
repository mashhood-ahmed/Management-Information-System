<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['reg'])) {

		header("location: ../index.php");
	}

	
	$id = $_GET['upd'];
	$record = $cm->getComplaintOnId($id);

 ?>

 <!DOCTYPE html>
 <html>
 <head>

 	<style type="text/css">

 	h2 {
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
		<a title="Close" href="index.php?viewComp">X</a>
	</div>	

 	<h2 class="text-center">Update Complaint</h2>

 	<form method="post" action="">
 		
 		<div class="form-group">
 			<label for="title">Title</label>
 			<input type="text" maxlength="50" value="<?php echo $record['title']; ?>" name="title" required class="form-control" id="title" />
 		</div>

 		<div class="form-group">
 			<label for="desc">Description</label>
 			<textarea cols="20" rows="10" maxlength="500" name="desc" placeholder="Not more than 500 words" required class="form-control" id="desc"><?php echo $record['description']; ?></textarea>
 		</div>

 		<input type="submit" class="btn btn-success" name="updcomp" value="Update Complain" />

 	</form>

 </body>
 </html>

 <?php 

 	class Complaint {

 		private $title;
 		private $desc;

 		public function __construct($title,$desc) {

 			$this->title = $title;
 			$this->desc = $desc;
 		}

 		public function getTitle() {

 			return $this->title;
 		}

 		public function getDesc() {

 			return $this->desc;
 		}

 	}

 	if(isset($_POST['updcomp'])) {

 		$title = $_POST['title'];
 		$desc = $_POST['desc'];

 		$comp = new Complaint($title,$desc);
 		$res = $cm->updateComplaint($comp,$id);

 		if($res) {

 			echo "<script>alert('Complaint is successfully updated')</script>";
 		
 		} else {

 			echo "<script>alert('Internal Error Occured')</script>";	
 		}
 	}


  ?>