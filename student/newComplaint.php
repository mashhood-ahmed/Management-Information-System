<?php 

	if(!isset($_SESSION['id']) && !isset($_SESSION['reg'])) {

		header("location: ../index.php");
	}
	
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
		<a title="Close" href="index.php?home">X</a>
	</div>	

 	<h2 class="text-center">New Complaint</h2>

 	<form method="post" action="">
 		
 		<div class="form-group">
 			<label for="title">Title</label>
 			<input maxlength="50" placeholder="Maximum 50 Characters" type="text" name="title" required class="form-control" id="title" />
 		</div>

 		<div class="form-group">
 			<label for="desc">Description</label>
 			<textarea maxlength="500" cols="20" rows="10" name="desc" placeholder="Maximum 500 Characters" required class="form-control" id="desc"></textarea>
 		</div>

 		<input type="submit" onclick="complaintValidation()" class="btn btn-success" name="comp" value="Post Complain" />

 	</form>

 	<ul id="showError" style="text-align: center; margin-top: 20px; color: red; list-style: none; font-family: 'Courier New';">
 		
 	</ul>

 </body>
 </html>

 <?php 

 	class Complaint {

 		private $std_id;
 		private $title;
 		private $desc;

 		public function __construct($sid,$title,$desc) {

 			$this->std_id = $sid;
 			$this->title = $title;
 			$this->desc = $desc;
 		}

 		public function getID() {

 			return $this->std_id;
 		}

 		public function getTitle() {

 			return $this->title;
 		}	

 		public function getDesc() {

 			return $this->desc;
 		}

 	}

 	if(isset($_POST['comp'])) {

 		$title = $_POST['title'];
 		$desc = $_POST['desc'];

 		$complain = new Complaint($_SESSION['id'],$title,$desc);
 		$res = $cm->uploadComplaint($complain);

 		if($res) {

 			echo "<script>alert('Complaint is successfully uploaded')</script>";
 		
 		} else {

 			echo "<script>alert('Internal Error Occured')</script>";
 		}
 	}	

  ?>