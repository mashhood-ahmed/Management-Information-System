<div id="inner-container" class="row"> 
			 
			<header class="col-md-12" id="header-section">
				<nav id="inner-menu">
					<div class="w3-bar">
  						<a href="./index.php?home" class="w3-bar-item w3-button">Home</a>
  						<a href="./index.php?markAttendance" class="w3-bar-item w3-button">Mark Attendance</a>
						<a href="./index.php?viewAttendance" class="w3-bar-item w3-button">View Attendance</a>
						<a href="./index.php?uploadMarks" class="w3-bar-item w3-button">Upload Marks</a>
						<a href="./index.php?viewMarks" class="w3-bar-item w3-button">View Marks</a>
						<!-- <a href="./index.php?uploadResult" class="w3-bar-item w3-button">Upload Results</a> -->
						<a href="./index.php?final" class="w3-bar-item w3-button">View Result</a>

  						<a href="./index.php?profile" class="w3-bar-item w3-button">My Profile</a>
						<a href="./logout.php" class="w3-bar-item w3-button">Logout</a>
   					 </div>


				</nav>
			</header>

			<section class="col-md-12" id="index-section">
				
				<?php 

					ob_start();

					$am = new attendanceManager();
					$mm = new marksManager();
					$dm = new dataManager();
					$rm = new resultManager();


					if(isset($_GET['home'])) {

						include("./postPage.php");
					}

					if(isset($_GET['markAttendance'])) {

						include("./selectClass.php");
					}

					if(isset($_GET['course']) && isset($_GET['semester']) && isset($_GET['section']) && isset($_GET['mbtn'])) {

						include("./markAttendance.php");
					}

					if(isset($_GET['viewAttendance'])) {

						include("./selectClassForViewAttendance.php");
					}

					if(isset($_GET['cou']) && isset($_GET['sem']) && isset($_GET['section']) && isset($_GET['mbtn']) && isset($_GET['week'])) {

						include("./viewAttendance.php");
					}

					if(isset($_GET['uploadMarks'])) {

						include("./selectClassForMarks.php");
					}

					if(isset($_GET['cou']) && isset($_GET['sem']) && isset($_GET['section']) && isset($_GET['nbtn'])) {

						include("./uploadMarks.php");	
					}

					if(isset($_GET['viewMarks'])) {

						include("./selectClassForViewMarks.php");
					}

					if(isset($_GET['abtn'])) {

							include("./viewMarks.php");		
					}

					if(isset($_GET['updAtt'])) {

						include("./updateAttendance.php");
					}

					if(isset($_GET['vmarks'])) {

						include("./viewMarks.php");
					}

					// delete attendance

					if(isset($_GET['delAtt'])) {

						$id = $_GET['delAtt'];
						$f = $am->deleteAttendance($id);

						if($f) {

							echo "<script>alert('Attendance is successfully deleted ...')</script>";
							echo "<script>window.location.assign('index.php?viewAttendance')</script>";

						} else {

							echo "
			 					<div style='margin-top: 20px;' class='alert alert-danger'>
			 					<strong>Error!</strong>&nbsp;
			 					Attendance is not deleted! Please try again deleted                                                          
			 					</div>";
						}

					}

					// update marks

					if(isset($_GET['updMark'])) {

						include("./updateMarks.php");
					}

					// delete marks

					if(isset($_GET['delMark'])) {

						$id = $_GET['delMark'];
						$f = $mm->deleteMarks($id);

						if($f) {

							echo "<script>alert('Marks is successfully deleted ...');</script>";
							echo "<script>window.location.assign('index.php?viewMarks');</script>";

						} else {

							echo "
			 					<div style='margin-top: 20px;' class='alert alert-danger'>
			 					<strong>Error!</strong>
			 					&nbsp; Marks is not deleted! Please try again </div> ";
						}
					}	

					// when graph link is active import this page

					if(isset($_GET['graph'])) {

						include("./selectClassForViewGraph.php");
					}

					// when you click on view graph
					if(isset($_GET['graphbtn'])) {

						include("./viewGraph.php");
					}

					// when distribution link is active import this page

					if(isset($_GET['dist'])) {

						include("./selectClassForViewDistribution.php");
					}	

					// when you click on view distribution
					if(isset($_GET['distbtn'])) {

						include("./viewDistribution.php");
					}

					// when calculation link is active import this page

					if(isset($_GET['cal'])) {

						include("./selectClassForViewCalculation.php");
					}

					// when you click on view calculation button
					if(isset($_GET['calbtn'])) {

						include("./viewCalculation.php");
					}					

					// when you click on final grades link this page will display

					if(isset($_GET['final'])) {

						include("./selectClassForViewFinalGrades.php");
					}

					// when you click on view grades button

					if(isset($_GET['finalbtn'])) {

						include("./viewFinalGrades.php");
					}

					// when you click on upload results
					if(isset($_GET['uploadResult'])) {

						include("./selectClassForResults.php");
					}

					// when you click on next in uploadResult page

					if(isset($_GET['course']) && isset($_GET['semester']) && isset($_GET['section'])  && isset($_GET['rbtn'])) {

						include("./uploadResults.php");	
					}

					if(isset($_GET['profile'])) {

						include('./profile.php');					
					}

			
				 ?>

			</section>

		</div>