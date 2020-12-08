<?php 
	
	//session_start();

	if(!isset($_SESSION['id']) || !isset($_SESSION['username'])) {

		header("Location: ../index.php");
	}

 ?>

<div id="inner-container" class="row"> 
			 
			<header class="col-md-12" id="header-section">
				<nav id="inner-menu">

					<div class="w3-bar">
  						<a href="./index.php?home" class="w3-bar-item w3-button">Home</a>
  						<a href="./index.php?complaint" class="w3-bar-item w3-button">Student Complaints</a>
  						<a href="./index.php?performance" class="w3-bar-item w3-button">View Class Performance</a>
						</a>
						<a href="./index.php?profile" class="w3-bar-item w3-button">My Profile</a>
						<a href="./logout.php" class="w3-bar-item w3-button">Logout</a>
   					 </div>


				</nav>
			</header>

			<section class="col-md-12" id="index-section">
				
				<?php 

				$cm = new ComplaintManager();	
				$pm = new PostManager();
				$pr = new ProfileManager();
				$dm = new DataManager();


				// if home button is active
				if(isset($_GET['home'])) {

					include('./postPage.php');
				}

				// if view complaint button is active
				if(isset($_GET['complaint'])) {

					include('./viewComplaint.php');
				}

				// if one of the complaint title is active
				if(isset($_GET['ReadMore'])) {

					include('./read_more_complaint.php');
				}

				// if profile button is active
				if(isset($_GET['profile'])) {

					include('./profile.php');

				}

				// if performance link is active 
				if(isset($_GET['performance'])) {

					include('selectClass.php');

				}

				// if button in select class page is active
				if(isset($_GET['cou']) && isset($_GET['section']) && isset($_GET['sem']) && isset($_GET['pbtn'])) {

					include('studentPerformance.php');
				}

				 ?>
				
			</section>

		</div>