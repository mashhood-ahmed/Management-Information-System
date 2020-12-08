<?php 


	if(!isset($_SESSION['id']) && !isset($_SESSION['email'])) {

		header("location: ../index.php");
	}


	if(isset($_GET['cou']) && isset($_GET['sem']) && isset($_GET['section']) && isset($_GET['nbtn'])) {

		$teacher = $_SESSION['id'];
		$course = $_GET['cou'];
		$semester = $_GET['sem'];
		$session_class =  $dm->getSessionAndClass($course,$_SESSION['id']);
		$section = $_GET['section'];


		$records = $dm->getStudentsBySecAndSem($semester,$section);

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

		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {

			-webkit-appearance: none;
			margin: 0;
		}

		#table-box {

			

		}

		input[type=number] {

		width: 50px;
		-moz-appearance: textfield;
		
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
		<a href="index.php?uploadMarks">X</a>
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

 		<?php 

 			while($row=mysqli_fetch_array($records)) {

 				?>

 				<tr>
 					<td><?php echo $row['reg_no']; ?></td>
 					<td><?php echo $row['fname'] . " " . $row['lname']; ?></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="q1[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="q2[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="q3[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="q4[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="q5[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="q6[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="a1[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="a2[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input  type="number" min="0" step="0.01" required size="2" name="a3[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="a4[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="a5[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="a6[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="par[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="pre[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="mid[<?php echo $row['std_id']; ?>]" /></td>

 					<td><input type="number" min="0" step="0.01" required size="2" name="final[<?php echo $row['std_id']; ?>]" /></td>
 				</tr>

 				<?php
 			}


 		 ?>

 	</table>	


 	<input type="submit" name="sub" value="Upload Marks" class="btn btn-success" />

 	</form> 

 	<ul id="showError" style="list-style: none; color: red; font-family: 'Courier New';text-align: center;">
 		
 	</ul>


 	</div>

 </body>
 </html>


<?php


	class Marks {

		private $cid;
		private $tid;
		private $sem, $sec;
		private $q1,$q2,$q3,$q4,$q5,$q6;
		private $a1,$a2,$a3,$a4,$a5,$a6;
		private $par , $pre;
		private $mid , $final;

		public function __construct($cid,$tid,$sem,$sec,$q1,$q2,$q3,$q4,$q5,$q6,$a1,$a2,$a3,$a4,$a5,$a6,$par,$pre,$mid,$final) {

			$this->sem = $sem;
			$this->sec = $sec;

			$this->cid = $cid;
			$this->tid=  $tid;

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

		public function getSection() {

			return $this->sec;
		}

		public function getSemester() {

			return $this->sem;
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

		public function getCid() {

			return $this->cid;
		}

		public function getTid() {

			return $this->tid;
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
		   
		$marks = new Marks($course,$teacher,$semester,$section,$q1,$q2,$q3,$q4,$q5,$q6,$a1,$a2,$a3,$a4,$a5,$a6,$par,$pre,$mid,$final);


		$rows = $mm->checkMarks($course, $semester, $section);

		if($rows < 1) {

			$res = $mm->uploadMarks($marks);

		if($res) {

			echo "<script>alert('Marks Is Successfully Uploaded ..')</script>";

		} else {

			echo "<script>alert('Internal Problem Occurred ..')</script>";
		}	

		} else {

			echo "<script>alert('You have already uploaded the marks...')</script>";

		}

	}


 ?>