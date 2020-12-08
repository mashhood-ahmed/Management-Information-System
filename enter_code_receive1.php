<?php 
//include("logout.php");


	$uid = @$_POST['aid']; 
	$user = @$_POST['utype'];	



?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="./css/w3.css" />
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./css/style.css" />

</head>
<body>


	<div id="main-box" class="container-fluid">
		
		<?php

			include("./includes/header.php");

		 ?>

		 <section class="row sec">
			
		 
			<div class="col-md-12">
					
				<div class="mt-3 mb-3">
		 			<a style="border:2px solid grey;padding:5px;border-radius:10px;" href="./email_pass_recover.php">X</a>
		 		</div>


		 			<div class="text-center">
		 				<h3>Enter The Code</h3>
		 			</div>

		 			<!-- code icon  -->
		 			<div class="text-center mb-5">
		 				<img src=".\resourses\codeicon.jpg" alt="code-icon" width="250" height="250" />
		 			</div>

					<div class="form-group w-50 mx-auto">
						<label>We have sent you a code to your email please enter it below:</label>
						<input type="text" required name="rcode" class="form-control" id="rcode" />
					</div>

					<center>
					<button class="btn btn-success" onclick="getData('<?php echo $uid ?>','<?php echo $user ?>')">Next</button>
					</center>
				
				<div id="passwordArea" class="mt-5 mb-3 text-center">
					
				</div>

			</div>

		</section>


		 <script type="text/javascript" src="./js/validationCode.js"></script>

		 <script type="text/javascript">
		 	
		 	function getData(data,user) {

		 		let code = document.getElementById("rcode").value;

		 		if(code == "24878") {

		 			let id = data;

		 		let httpReq = new XMLHttpRequest();
		 		httpReq.onreadystatechange = function() {

		 			if(this.readyState == 4 && this.status == 200) {

		 				document.getElementById("passwordArea").innerHTML = this.responseText;
		 			}	

		 		};

		 		if(user == "admin") {

		 			httpReq.open("GET", "./admin_old_password.php?id="+id, true);
		 			httpReq.send();		 			
		 		
		 		} else if(user == "student") {

		 			httpReq.open("GET", "./student_old_password.php?id="+id, true);
		 			httpReq.send();

		 		} else if(user == "teacher") {

		 			httpReq.open("GET", "./teacher_old_password.php?id="+id, true);
		 			httpReq.send();

		 		} else {

		 			httpReq.open("GET", "./chairman_old_password.php?id="+id, true);
		 			httpReq.send();

		 		}


		 		
		 		} else {

		 			alert("Code is wrong! Please enter the valid code");
		 		
		 		}

		 		

		 	}


		 </script>

	</div>


</body>
</html>





	

	