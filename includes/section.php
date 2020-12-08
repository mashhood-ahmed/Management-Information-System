<section class="row sec">
	
	<div class="col-sm-12 sec1">
				
		<div class="w3-bar dd">
  			<a href="./index.php" class="w3-bar-item w3-button">Home</a>
  			<a href="./index.php?about=ab" class="w3-bar-item w3-button">About</a>
  		
  		<div class="w3-dropdown-hover dd">
    		<button class="w3-button">Sign in</button>
    
    	<div class="w3-dropdown-content w3-bar-block w3-card-4 dd">
      		<a href="./index.php?teacher" class="w3-bar-item w3-button">Teacher Login</a>
      		<a href="./index.php?chairman" class="w3-bar-item w3-button">Chairman Login</a>
      		<a href="./index.php?admin" class="w3-bar-item w3-button">Admin Login</a>
    </div>
  </div>
  			<a href="./index.php?selectUser" class="w3-bar-item w3-button">Sign up</a>  
</div>
			</div>

			<?php 

				if(!isset($_GET['teacher']) && !isset($_GET['chairman']) && !isset($_GET['admin']) && !isset($_GET['about']) && !isset($_GET['register']) && !isset($_GET['selectUser'])&& !isset($_GET['registerStudent'])&& !isset($_GET['registerTeacher'])) {

					include("./studentlogin.php");
				}


				if(isset($_GET['teacher'])) {

					include("./teacherlogin.php");
				}

				if(isset($_GET['chairman'])) {

					include("./chairmanlogin.php");
				}

				if(isset($_GET['admin'])) {

					include("./adminlogin.php");
				}

				if(isset($_GET['selectUser'])) {

					include("./selectUser.php");

				}

				if(isset($_GET['registerStudent'])) {

					include("./Studentregister.php");
				}

				if(isset($_GET['registerTeacher'])) {

					include("./Teacherregister.php");
				}


			 ?>


 
</section>
