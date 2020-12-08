<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
		
		#tt {
			margin-bottom: 250px;
			width: 900px;
			
		}

		#tt > div {

			font-size: 25px;
			margin-bottom: 20px;
			
		}

		#cross::after {

			content: "";
			display: block;
			clear: both;
		}

		#cross a {
			border: 2px solid #c2c2a3;
			padding: 2px;
			color: #c2c2a3;
			border-radius: 20px;
			float: right;
	}

		#tt a {
			margin-left: 10px;
			text-decoration: none;
		}

	</style>

</head>
<body>

<div id="tt" class="text-center mx-auto">
	
	<div id="cross">
		<a href="index.php?home">X</a>
		</div>

	<div class="w3-tangerine">Be Our User</div>
	<a href="./index.php?registerStudent" class="w3-btn w3-round-large w3-border w3-border-blue w3-xlarge w3-white">Are You Student ?</a>

	<a href="./index.php?registerTeacher" class="w3-btn w3-round-large w3-border w3-border-red w3-xlarge w3-white">Are You Teacher ?</a>

</div>


</body>
</html>