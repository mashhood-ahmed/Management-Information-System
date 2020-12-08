<?php  

require_once("./DataManager.php"); ?>

<div id="inner-container" class="row"> 
			 
			<header class="col-md-12" id="header-section">
				<nav id="inner-menu">
					
					<div id="bar" class="w3-bar">
  						<a href="./index.php?home" class="w3-bar-item w3-button">Home</a>
  						
  
  					<div class="w3-dropdown-hover">
    					<button class="w3-button">Users</button>
    				<div class="w3-dropdown-content w3-bar-block w3-card-4">
						<a href="./index.php?viewStudent" class="w3-bar-item w3-button">View Students</a>
						<a href="./index.php?viewTeacher" class="w3-bar-item w3-button">View Teachers</a>
						
    				</div>
  					</div>

  					<div class="w3-dropdown-hover">
    					<button class="w3-button">Courses</button>
    				<div class="w3-dropdown-content w3-bar-block w3-card-4">
						<a href="./index.php?addCourse" class="w3-bar-item w3-button">Add Course</a>
						<a href="./index.php?viewCourse" class="w3-bar-item w3-button">View Courses</a>
						<a href="./index.php?assignCourse" class="w3-bar-item w3-button">Assign Course</a>
						<a href="./index.php?viewassgniedCourse" class="w3-bar-item w3-button">View Assigned</a>
						
    				</div>
  					</div>

  					<div class="w3-dropdown-hover">
    					<button class="w3-button">Students Data</button>
    				<div class="w3-dropdown-content w3-bar-block w3-card-4">
						<a href="./index.php?atten" class="w3-bar-item w3-button">View Attendance</a>
						<a href="./index.php?marks" class="w3-bar-item w3-button">View Marks</a>
						<a href="./index.php?result" class="w3-bar-item w3-button">View Results</a>
						
    				</div>
  					</div>

  					<!-- <div class="w3-dropdown-hover">
    					<button class="w3-button">Teacher Data</button>
    				<div class="w3-dropdown-content w3-bar-block w3-card-4">
						<a href="#" class="w3-bar-item w3-button">Link 1</a>
						<a href="#" class="w3-bar-item w3-button">Link 2</a>
						<a href="#" class="w3-bar-item w3-button">Link 3</a>
						
    				</div>
  					</div> -->

  					<div class="w3-dropdown-hover">
    					<button class="w3-button">Other</button>
    				<div class="w3-dropdown-content w3-bar-block w3-card-4">
						<a href="index.php?request" class="w3-bar-item w3-button">Pending Requests</a>
						<a href="index.php?complaint" class="w3-bar-item w3-button">Complaints</a>
						<a href="index.php?profile" class="w3-bar-item w3-button">My Profile</a>
						
    				</div>
  					</div>

  					<a href="./index.php?post" class="w3-bar-item w3-button">Upload Post</a>
  					<a class="w3-bar-item w3-button" href="index.php?copy">Change Copyright Text</a>
					<a class="w3-bar-item w3-button" href="./logout.php">Logout</a>


</div>
				
				</nav>
			</header>

			<section class="col-md-12" id="index-section">
				
				<?php 

					$dm = new studentManager();
					$cm = new courseManager();
					$tm = new teacherManager();
					$acm = new assignCourseManager();
					$am = new attendanceManager();
					$mm = new marksManager();
					$um = new userManager();
					$rm = new resultManager();
					$km = new dataManager();
				
					// if add course button is active 
					if(isset($_GET['addCourse'])){
						include("addCourse.php");	
					}

					// if assign course button is active
					if(isset($_GET['assignCourse'])){
						include("AssignCourse.php");
					}

					// if view student button is active
					if(isset($_GET['viewStudent'])){
						include("SelectSemesterViewStudents.php");
					}

					if(isset($_GET['viewbtn'])) {

						include("viewStudents.php");
					}

					// if view teacher button is active
					if(isset($_GET['viewTeacher'])){
						include("viewTeacher.php");
					}

					// if view course button is active
					if(isset($_GET['viewCourse'])){
						include("viewCourse.php");
					}

					// if assigned courses button is active
					if(isset($_GET['viewassgniedCourse'])){
						include("searchAssignCourse.php");	
					}

					if(isset($_GET['semester']) && isset($_GET['viewCoursebtn'])) {
						include("viewAssignedCourses.php");
					}

					// if student data button is active 
					if(isset($_GET['studentData'])){

					}

					// update student 
					if(isset($_GET['updStd'])) {
						include("updateStudent.php");
					} 

					// delete student 
					if(isset($_GET['delStd'])) {

						$f = $dm->delStudent($_GET['delStd']);
						
						if($f) {

							echo "<script>alert('Student is successfully deleted ...')</script>";
							echo "<script>window.location.assign('index.php?viewStudent')</script>";

						} else {

							echo "
			 					<div style='margin-top: 20px;' class='alert alert-danger'>
			 					<strong>Error!</strong>
			 					&nbsp;
			 					Student is not deleted! Please try again
			 					</div>";
						}	 
						
					}

					// update teacher
					if(isset($_GET['updTeacher'])) {
						include("updateTeacher.php");	
					}
					// delete teacher
					if(isset($_GET['delTeacher'])) {
						$dm = new teacherManager();
						$f = $dm->delTeacher($_GET['delTeacher']);

						if($f) {

							echo "<script>alert('Teacher is successfully deleted ...')</script>";
							echo "<script>window.location.assign('index.php?viewTeacher')</script>";

						} else {

							echo "
			 					<div style='margin-top: 20px;' class='alert alert-danger'>
			 					<strong>Error!</strong>
			 					&nbsp;
			 					Teacher is not deleted! Please try again
			 					</div>";	
						}

					}
					
					// update course 
					if(isset($_GET['updCou'])) {
						include("updateCourse.php");
					}

					
					// update assign course
					if(isset($_GET['updac'])) {
						include("updateAssignCourse.php");
					}

					

					// if change copyright button is clicked
					if(isset($_GET['copy'])) {
						include("copyright.php");
					}

					// if do post button is clicked 
					if(isset($_GET['post'])) {
						include("post.php");
					}

					// if home button is clicked
					if(isset($_GET['home'])) {
						include("home.php");
					}

					// find students by registration number
					if(isset($_GET['search']) && isset($_GET['sbtn'])) {

						include("searchResultStudent.php");
					}

					// if update post button is clicked
					if(isset($_GET['updPost'])) {
						include("updatePost.php");
					}

					// if delete post button is active
					if(isset($_GET['delPost'])) {
						$pm = new postManager();
						$pm->deletePost($_GET['delPost']);
					}

					// if view attendance button is active

					if(isset($_GET['atten'])) {

						include('./selectClassForViewAttendance.php');
					}

					if(isset($_GET['cou']) && isset($_GET['section']) && isset($_GET['sem']) && isset($_GET['week']) && isset($_GET['mbtn'])) {

						include('viewAttendance.php');
					}

					// when view marks link is active
					if(isset($_GET['marks'])) {

						include('./selectClassForViewMarks.php');
					}

					// when viewMarks button is pressed
					if(isset($_GET['cou']) && isset($_GET['section']) && isset($_GET['sem'])  && isset($_GET['abtn'])) {

						include('./viewMarks.php');
					}

					// when view result link is pressed
					if(isset($_GET['result'])) {

						include('./selectClassForResults.php');
					}

					// when viewResult button is pressed
					if(isset($_GET['cou']) && isset($_GET['section']) && isset($_GET['sem']) && isset($_GET['rbtn'])) {

						include('./viewFinalGrades.php');
					}


					// when you click on next in uploadResult page

					if(isset($_GET['course']) && isset($_GET['semester']) && isset($_GET['section'])  && isset($_GET['rbtn'])) {

						include("./viewFinalGrades.php");	
					}

					// when account request link is active ..

					if(isset($_GET['request'])) {

						include('./pendingRequest.php');
					}

					if(isset($_GET['stdReq'])) {

						include('./accountRequest.php');
					}

					if(isset($_GET['teaReq'])) {

						include('./accountRequest1.php');
					}

					if(isset($_GET['complaint'])) {

						include('./viewComplaints.php');
					}

					if(isset($_GET['complaint']) && isset($_GET['del'])) {

						$obj = new complaint();
						$obj->deleteComplaint($_GET['del']);
					}

					if(isset($_GET['more'])) {

						include('./readMoreComplaint.php');
					}

					if(isset($_GET['profile'])) {

						include('./myprofile.php');
					}

				 ?>


			</section>

		<script type="text/javascript" src="./js/validationCode.js"></script>	

		</div>