<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) {

	 //echo "<script>window.open('../index.php?admin','_self')</script>";
	 header("location: ../index.php?admin");

	}

 ?>

<?php 

	if(isset($_GET['updPost'])) {

		$id = $_GET['updPost'];
		$pm = new postManager();
		$p_title = $pm->getPostTitle($id);
		$p_desc = $pm->getPostDesc($id);
		$postFile = $pm->getPostFile($id);
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
		<a href="index.php?home">X</a>
	</div>


	<h2>Update Post</h2>

	<form action="" method="post" enctype="multipart/form-data">
		
		<div class="form-group">
			<label for="title">Post Title</label>
			<input value="<?php echo $p_title; ?>" type="text" id="title" class="form-control form-control-sm" name="title" required />
		</div>

		<div class="form-group">
			<label for="desc">Post Description</label>
			<textarea name="desc" rows="10" class="form-control" id="desc" required><?php echo $p_desc; ?></textarea>
		</div>

		<div class="form-group">
			<label for="img">Attach File/Photo</label>
			<input type="file" id="img" name="image" class="form-control" />
		</div>

		<input type="submit" onclick="postValidation()"  name="postbtn" value="Update Post" class="btn btn-success" />

	</form>

</body>
</html>

<?php 

	class Post {

		private $p_title;
		private $p_desc;
		private $p_file;
		private $f_temp;
		private $f_size;
		private $f_type;

		public function __construct($p_title,$p_desc,$p_file,$f_temp,$f_size,$f_type) {

			$this->p_title = $p_title;
			$this->p_desc = $p_desc;
			$this->p_file = $p_file;
			$this->f_temp = $f_temp;	
			$this->f_size = $f_size;
			$this->f_type = $f_type;
		}

		public function getTitle() {
			return $this->p_title;
		}

		public function getDesc() {
			return $this->p_desc;
		}

		public function getFile() {
			return $this->p_file;
		}

		public function getFileTempName() {
			return $this->f_temp;
		}

		public function getFileSize() {
			return $this->f_size;
		}

		public function getFileType() {

			return $this->f_type;
		}

	}

	if(isset($_POST['postbtn'])) {

		$title = $_POST['title'];
		$desc = $_POST['desc'];
		$file = $_FILES['image']['name'];
		$file_tmp = $_FILES['image']['tmp_name'];
		$file_size = $_FILES['image']['size'];
		$file_type = $_FILES['image']['type'];

		$pm = new postManager();
		$p = new Post($title,$desc,$file,$file_tmp,$file_size,$file_type);

		if($file == ""){
			$pm->updateWithOutFile($p,$id);
		} else {
			$pm->updatePost($p,$id);
		}

	}

 ?>
