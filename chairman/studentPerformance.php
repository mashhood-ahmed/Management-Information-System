<?php 
	
	if(!isset($_SESSION['id']) && !isset($_SESSION['username'])) {

		header("location: ../index.php");
	}	
	
	if(isset($_GET['cou']) && isset($_GET['section']) && isset($_GET['sem']) && isset($_GET['pbtn'])) {

			$course = $_GET['cou'];
			$section = $_GET['section'];
			$semester = $_GET['sem'];

		$row = $dm->getDataFromAssignCourse($course);
		$records =  $dm->get_student_marks_data($course, $semester, $section);
		
		$courseCreditHr = $dm->getCourseCredit($course);
		$teaClasses = $dm->calTeaClasses($course, $semester, $section) * $courseCreditHr;

	}

	if(mysqli_num_rows($records) > 0) {	

 ?>

 <div>

 	<div class="mt-2 pr-2 text-right" id="cross">
		<a style="border:2px solid #c2c2a3; color:#c2c2a3; padding:5px; border-radius:20px;" href="index.php?performance">X</a>
	</div>

 	<div style="color: grey;" class="text-center">
 		<div><h5><?php echo "<strong>Course:</strong>&nbsp;$row[title]"; ?></h5></div>
 		<div><h5><?php echo "<strong>Semester:</strong>&nbsp;$semester"; ?></h5></div>
 		<div><h5><?php echo "<strong>Section:</strong>&nbsp;$section"; ?></h5></div>
 		<div><h5><?php echo "<strong>Session:</strong>&nbsp;$row[session]"; ?></h5></div>
  	</div>
 	
 	<div style="color: grey;">
 		<div>Credit Hour = <span><strong><?php echo $courseCreditHr; ?></strong></span></div>
 		<div>Total Classes = <span><strong>(48 Cr.Hours)</strong></span></div>
 		<div>Total Classes Taken By Teacher = <span><strong><?php echo "(" . $teaClasses . " Cr.Hours" . ")"; ?></strong></span></div>
 	</div>

 	<div>
 		
 		<table class="table text-center mt-5 table-responsive">
 			<tr>
 				<th>Reg #</th>
 				<th>Name</th>
 				<th>Assignment 1</th>
 				<th>Assignment 2</th>
 				<th>Assignment 3</th>
 				<th>Assignment 4</th>
 				<th>Assignment 5</th>
 				<th>Assignment 6</th>
 				<th>Quiz 1</th>
 				<th>Quiz 2</th>
 				<th>Quiz 3</th>
 				<th>Quiz 4</th>
 				<th>Quiz 5</th>
 				<th>Quiz 6</th>
 				<th>Participation</th>
 				<th>Presentation</th>
 				<th>Midterm</th>
 				<th>Finalterm</th>
 			</tr>

 			<?php 

 			while($data = mysqli_fetch_array($records)) {

 				echo "<tr>";

				echo "<td>$data[reg_no]</td>";
 				echo "<td>$data[fname]&nbsp;$data[lname]</td>";

 				echo "<td>$data[a1]</td>";
 				echo "<td>$data[a2]</td>";
 				echo "<td>$data[a3]</td>";
 				echo "<td>$data[a4]</td>";
 				echo "<td>$data[a5]</td>";
 				echo "<td>$data[a6]</td>";

 				echo "<td>$data[q1]</td>";
 				echo "<td>$data[q2]</td>";
 				echo "<td>$data[q3]</td>";
 				echo "<td>$data[q4]</td>";
 				echo "<td>$data[q5]</td>";
 				echo "<td>$data[q6]</td>";

 				echo "<td>$data[participation]</td>";
 				echo "<td>$data[presentation]</td>";
 				echo "<td>$data[mid]</td>";
 				echo "<td>$data[final]</td>";
 				echo "</tr>";
 			}


 			 ?>
 		

 		</table>


 	</div>	


 </div>

 <?php } else { ?>

 <div class="w3-panel w3-display-container">
		<a href="index.php?home" class="w3-button w3-large w3-display-topright">X</a>
		<h3>No Records Found</h3>
</div>


 <?php } ?>
