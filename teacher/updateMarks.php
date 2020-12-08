<?php 


	if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

		header("location: ../index.php");
	}


	if(isset($_GET['updMark'])) {

		$teacher = $_SESSION['id'];
		$course = $_GET['cou'];
		$semester = $_GET['sem'];
		$session_class =  $dm->getSessionAndClass($course,$_SESSION['id']);
		$section = $_GET['sec'];

		$id = $_GET['updMark'];

		$rec = $mm->getMarksById($id);

	}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<!-- internal css is used -->
	<style type="text/css">
		h5{

			
			text-align: center;
			color: grey;	
			margin-bottom: 20px;
		
		}	

		label{
			color: #17639e;
		}

		#table-box {

			

		}

		input[type=number] {

		width: 50px;
		-moz-appearance: textfield;
		
		}

		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {

			-webkit-appearance: none;
			margin: 0;
		}

		#cross {
			margin-top: 10px;
			text-align: left;
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
		<a href="index.php?cou=<?php echo $course; ?>&section=<?php echo $section; ?>&sem=<?php echo $semester; ?>&abtn=View+Marks">X</a>
	</div>
  		
 	<h5>
 		
 		<div><strong>Course:</strong> <?php echo $dm->getCourseId($course); ?></div>
 		<div><strong>Semester:</strong> <?php echo $semester; ?></div>
 		<div><strong>Section:</strong> <?php echo $section; ?></div>
		<div><strong>Session:</strong> <span><?php echo $session_class[0]; ?></span></div>
 	</h5>

 	<div id="table-box">

  	<form action="" method="post">

 	<table class="table table-striped text-center">
 		<tr>
 			<th>REG #</th>
 			<th>NAME</th>
 			<th>QUIZ 1</th>
 			<th>QUIZ 2</th>
 			<th>QUIZ 3</th>
 			<th>QUIZ 4</th>
 			<th>QUIZ 5</th>
 			<th>QUIZ 6</th>
 			<th>ASSIGNMENT 1</th>
 			<th>ASSIGNMENT 2</th>
 			<th>ASSIGNMENT 3</th>
 			<th>ASSIGNMENT 4</th>
 			<th>ASSIGNMENT 5</th>
 			<th>ASSIGNMENT 6</th>
 			<th>PARTICIPATION</th>
 			<th>PRESENTATION</th>
 			<th>MIDTERM</th>
 			<th>FINALTERM</th>
 		</tr>


 				<tr>
 					<td><?php echo $rec['reg_no']; ?></td>
 					<td><?php echo $rec['fname'] . " " . $rec['lname']; ?></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['q1']; ?>" name="q1" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['q2']; ?>" name="q2" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['q3']; ?>" name="q3" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['q4']; ?>" name="q4" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['q5']; ?>" name="q5" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['q6']; ?>" name="q6" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['a1']; ?>" name="a1" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['a2']; ?>" name="a2" /></td>

 					<td><input  type="number" step="0.01" min="0" size="2" value="<?php echo $rec['a3']; ?>" name="a3" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['a4']; ?>" name="a4" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['a5']; ?>" name="a5" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['a6']; ?>" name="a6" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['participation']; ?>" name="par" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['presentation']; ?>" name="pre" /></td>

 					<td><input type="number" step="0.01" min="0" size="2" value="<?php echo $rec['mid']; ?>" name="mid" /></td>

 					<td><input type="number" step="0.01" size="2" min="0" value="<?php echo $rec['final']; ?>" name="final" /></td>
 				</tr>

 	</table>	


 	<input type="submit" name="sub" value="Update Marks" class="btn btn-success" />

 	</form> 

 	<ul id="showError" style="list-style: none; color: red; font-family: 'Courier New';text-align: center;">
 		
 	</ul>

 	</div>

 </body>
 </html>


<?php


	class Marks {

		private $q1,$q2,$q3,$q4,$q5,$q6;
		private $a1,$a2,$a3,$a4,$a5,$a6;
		private $par , $pre;
		private $mid , $final;

		public function __construct($q1,$q2,$q3,$q4,$q5,$q6,$a1,$a2,$a3,$a4,$a5,$a6,$par,$pre,$mid,$final) {

			$this->q1 = $q1;
			$this->q2 = $q2;
			$this->q3 = $q3;
			$this->q4 = $q4;
			$this->q5 = $q5;
			$this->q6 = $q6;

			$this->a1 = $a1;
			$this->a2 = $a2;
			$this->a3 = $a3;
			$this->a4 = $a4;
			$this->a5 = $a5;
			$this->a6 = $a6;

			$this->par = $par;
			$this->pre = $pre;

			$this->mid = $mid;
			$this->final = $final;
		}

		public function getQuizOne() {

			return $this->q1;
		}

		public function getQuizTwo() {

			return $this->q2;
		}

		public function getQuizThree() {

			return $this->q3;
		}

		public function getQuizFour() {

			return $this->q4;
		}

		public function getQuizFive() {

			return $this->q5;
		}

		public function getQuizSix() {

			return $this->q6;
		}

		public function getAssOne() {

			return $this->a1;
		}

		public function getAssTwo() {

			return $this->a2;
		}

		public function getAssThree() {

			return $this->a3;
		}

		public function getAssFour() {

			return $this->a4;
		}

		public function getAssFive() {

			return $this->a5;
		}

		public function getAssSix() {

			return $this->a6;
		}

		public function getPart() {

			return $this->par;
		}

		public function getPres() {

			return $this->pre;
		}

		public function getMid() {

			return $this->mid;
		}

		public function getFinal() {

			return $this->final;
		}
	}



	if(isset($_POST['sub'])) {

		$conn = new mysqli("localhost","root","","csit");

		   $q1 = $_POST['q1'];
		   $q2 = $_POST['q2'];
		   $q3 = $_POST['q3'];
		   $q4 = $_POST['q4'];
		   $q5 = $_POST['q5'];
		   $q6 = $_POST['q6'];

		   $a1 = $_POST['a1'];
		   $a2 = $_POST['a2'];
		   $a3 = $_POST['a3'];
		   $a4 = $_POST['a4'];
		   $a5 = $_POST['a5'];
		   $a6 = $_POST['a6'];
		   $par = $_POST['par'];
		   $pre = $_POST['pre'];

		   $mid = $_POST['mid'];
		   $final = $_POST['final'];

		$marks = new Marks($q1,$q2,$q3,$q4,$q5,$q6,$a1,$a2,$a3,$a4,$a5,$a6,$par,$pre,$mid,$final);


		$res = $mm->updateMarks($marks,$id);

		if($res) {

			echo "<script>alert('Marks Is Successfully Updated ..')</script>";
			
		} else {

			echo "<script>alert('Internal Problem Occurred ..')</script>";
		}	

	}


 ?>