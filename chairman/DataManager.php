<?php 

// connection class

	class dbConn {

	protected $conn;
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $db = "csit";

	public function __construct() {

		$this->conn = new mysqli($this->host,$this->user,$this->pass,$this->db);

		if($this->conn->connect_error) {

			echo $this->conn->connect_error;
		}
	}

	public function __destruct() {

		$this->conn->close();
	}

	}


 ////////////////// Complaint Manager Class /////////////////////

	class ComplaintManager extends dbConn {


		public function getComplaints() {

			$query = "SELECT id, title FROM `complaint`";
			$run = mysqli_query($this->conn, $query);

			return $run;

		}

		public function getSpecificComplaint($id) {

			$query = "SELECT * FROM `complaint` WHERE id=$id";
			$run = mysqli_query($this->conn, $query);
			return $run;

		}

	}

	///////////////// Post Manager Clas //////////////////////

	class PostManager extends dbConn {


		// this method will return all posts uploaded by the admin

		public function getPosts() {

 		$query = "SELECT * FROM post";
 		$run = mysqli_query($this->conn,$query);

 		if($run) {
 			
 			return $run;
 			
 		}	

 		return false;
 	}

	}

//////////////////////// Profile Manager //////////////////////	
class ProfileManager extends dbConn {

	public function getProfile($id) {

 		$query="SELECT * FROM chairman WHERE id=$id";
 		$run = mysqli_query($this->conn,$query);

 		if($run) {

 			return $run;
 		
 		} else {

 			echo "<script>alert('Internal Problem Occured ..')</script>";
 		}
 	}

 	public function updateProfile(profile $pro,$id) {

 		$user = $pro->getUser();
 		$ema = $pro->getEmail();
 		$fname = $pro->getFname();
 		$lname = $pro->getLname();
 		$pass = $pro->getPass();

 		if($pass==7)
 			$query = "UPDATE `chairman` SET `username`='$user',`fname`='$fname',`lname`='$lname',`email`='$ema' WHERE id=$id" ;
 		else
 			$query = "UPDATE `chairman` SET `username`='$user',`fname`='$fname',`lname`='$lname',`email`='$ema', `pass`='$pass' WHERE id=$id" ;

 		

 		$run = mysqli_query($this->conn,$query);

 		if($run) {

 			return true;
 		}

 		return false;

 	}

}

//////////////// Course Manager ///////////////////////
class DataManager extends dbConn {

	public function getAssignCourses() {

			$query = "SELECT DISTINCT a.c_id , c.c_id , c.title FROM assigned_courses a , courses c WHERE a.c_id = c.c_id ";
			$run = mysqli_query($this->conn,$query);

			if($run) {

				return $run;
			}

	}

	function getRanStdRec($cId,$semester,$section) {

 		$query = "SELECT std_id FROM attendance WHERE c_id=$cId AND std_sem='$semester' AND std_sec='$section'";

 		$run = mysqli_query($this->conn,$query);

 		if($run) {

 			$data = mysqli_fetch_array($run);
 			return $data['std_id'];
 		}

 	}


 	public function getTeacherID($course) {

 		$query = "SELECT t_id FROM attendance WHERE c_id=$course";
 		$run = mysqli_query($this->conn, $query);
 		$data = mysqli_fetch_array($run);
 		return $data['t_id'];


 	}

 	public function calTeaClasses($c, $sem, $sec) {

 		$id = $this->getTeacherID($c);
 		$s = $this->getRanStdRec($c, $sem, $sec);

 		$this->query = "SELECT COUNT(attendance) FROM attendance WHERE t_id=$id AND c_id=$c AND std_id=$s ";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data['COUNT(attendance)'];
 		}
 	} 	

 	public function getCourseCredit($c) {

 		$this->query = "SELECT credit FROM courses WHERE c_id=$c";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			return $data['credit'];
 		}
 	}

	public function getDataFromAssignCourse($cid) {

		$query = "SELECT a.class, a.session, c.title FROM courses c, assigned_courses a WHERE a.c_id=$cid AND c.c_id=$cid GROUP BY a.c_id";

		$run = mysqli_query($this->conn, $query) ;

		$data = mysqli_fetch_array($run);

		return $data;

	}

	public function getCopyRight() {

		$query = "SELECT * FROM copyright";
		$run = mysqli_query($this->conn, $query);
		$data = mysqli_fetch_array($run);

		return $data['copyright'];

	}

	public function get_student_marks_data($course, $semester, $section) {

		$query = "SELECT DISTINCT * FROM internal_marks m , students s WHERE m.c_id=$course AND s.semester='$semester' AND s.section='$section' AND s.std_id=m.std_id";
		
		$run = mysqli_query($this->conn, $query);

		if($run)
			return $run;
	}

}

 ?>