<?php 
	
	//session_start();

	if(!isset($_SESSION['id']) || !isset($_SESSION['reg'])) {

		header("Location: ../index.php");
	}

 ?>

<div id="inner-container" class="row"> 
			 
			<header class="col-md-12" id="header-section">
				<nav id="inner-menu">

					<div class="w3-bar">
  						<a href="./index.php?home" class="w3-bar-item w3-button">Home</a>
  						<a href="./index.php?viewAttendance" class="w3-bar-item w3-button">View Attendance</a>
						<a href="./index.php?viewMark" class="w3-bar-item w3-button">View Marks</a>
						<a href="./index.php?viewResult" class="w3-bar-item w3-button">View Results</a>
						
						<div class="w3-dropdown-hover">
    					<button class="w3-button">Complaint</button>
    					<div class="w3-dropdown-content w3-bar-block w3-card-4">
						<a href="./index.php?newComp" class="w3-bar-item w3-button">New Complaint</a>
						<a href="./index.php?viewComp" class="w3-bar-item w3-button">View Complaints</a>
   						</div>
  						</div>
  						<a href="./index.php?profile" class="w3-bar-item w3-button">My Profile</a>
						<a href="./logout.php" class="w3-bar-item w3-button">Logout</a>
   					 </div>


				</nav>
			</header>

			<section class="col-md-12" id="index-section">
				
				<?php 

					ob_start();

					$mm = new marksManager();
					$dm = new dataManager();
					$rm = new resultManager();
					$cm = new complaintManager();

					if(isset($_GET['home'])) {

						include('./postPage.php');
					}

					if(isset($_GET['viewAttendance'])) {

						include('./selectClassForViewAttendance.php');
					}

					if(isset($_GET['viewMark'])) {

						include('./selectClassForViewMark.php');
					}

					if(isset($_GET['viewResult'])) {

						include('./selectClassForViewResult.php');
					}

					if(isset($_GET['choose']) && isset($_GET['atten'])) {

						include('./viewAttendance.php');
					}

					if(isset($_GET['choose']) && isset($_GET['mark'])) {

						include('./viewMarks.php');
					}

					if(isset($_GET['choose']) && isset($_GET['result'])) {

						include('./viewResult.php');
					}

					if(isset($_GET['newComp'])) {

						include('./newComplaint.php');
					}

					if(isset($_GET['viewComp'])) {

						include('./viewComplaint.php');
					}

					if(isset($_GET['upd'])) {

						include('./updateComplaint.php');
					}

					if(isset($_GET['del'])) {

						$res = $cm->deleteComplaint($_GET['del']);

						if($res) {

							echo "<script>alert('Complaint is successfully deleted')</script>";

							echo "<script>window.location.assign('index.php?viewComp')</script>";

						} else {

							echo "<script>alert('Complaint is successfully deleted')</script>";
						}
					}

					if(isset($_GET['more'])) {

						include('./readMoreComplaint.php');
					}

					if(isset($_GET['profile'])) {

						include('./profile.php');
					}

					?>




			</section>

		</div>