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

	// complaint class

	class complaintManager extends dbConn {

		public function uploadComplaint(Complaint $comp) {

		$id = $comp->getID();	
 		$title = $comp->getTitle();
 		$desc = $comp->getDesc();

 		$this->query = $this->conn->prepare("INSERT INTO `complaint`(`std_id`, `title`, `description`) VALUES (?,?,?)");

 		$this->query->bind_param("iss",$id,$title,$desc);

 		if($this->query->execute()) {

 			return true;
 		}

 		return false;

 	}

 	public function getComplaintOnSpecificID($id) {

 		$this->query = "SELECT * FROM complaint WHERE std_id=$id";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return $this->run;
 		}
 	}

 	public function getComplaintOnId($id) {

 		$this->query = "SELECT * FROM complaint WHERE id=$id";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data;
 		}

 	}

 	public function updateComplaint(Complaint $comp,$id) {

 		$title = $comp->getTitle();
 		$desc = $comp->getDesc();

 		$this->query = $this->conn->prepare("UPDATE `complaint` SET `title`=?,`description`=? WHERE id=$id");

 		$this->query->bind_param("ss",$title,$desc);

 		if($this->query->execute()) {

 			return true;
 		} 

 		return false;
 	}

 	public function deleteComplaint($id) {

 		$this->query = "DELETE FROM complaint WHERE id=$id";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return true;
 		}

 		return false;
 	}


	}

	// marks manager class

	class marksManager extends dbConn {

		// this method will get marks by student id and course id ..

 	public function getMarks($s,$cid) {

 		$sid = $s;

 		$this->query = "SELECT * FROM internal_marks WHERE std_id=$sid AND c_id=$cid";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return $this->run;
 		}	
 	}
 
 	// this method calculates sessional marks of particular student

 	public function getSessional($s,$c) {

 		$this->query = "SELECT q1,q2,q3,q4,q5,q6,a1,a2,a3,a4,a5,a6,participation,presentation FROM internal_marks WHERE std_id=$s AND c_id=$c";
 		$this->run = mysqli_query($this->conn,$this->query);	

 		if($this->run) {

 			$r = mysqli_fetch_array($this->run);

 			return $r['q1']+$r['q2']+$r['q3']+$r['q4']+$r['q5']+$r['q6']+$r['a1']+$r['a2']+$r['a3']+$r['a4']+$r['a5']+$r['a6']+$r['participation']+$r['presentation']+$this->getAttenMarks($s,$c);
 		}

 	}

 	// this method will get mid term marks

 	public function getMidTerm($sid,$c) {

 		$s = $sid;

 		$this->query = "SELECT mid FROM internal_marks WHERE std_id=$s AND c_id=$c";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$row = mysqli_fetch_array($this->run) ;

 			return $row['mid'];
 		}

 	}

 	// this method will return final term marks of particular student

 	public function getFinalTerm($s,$c) {

 		$this->query = "SELECT final FROM internal_marks WHERE std_id=$s AND c_id=$c";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$row = mysqli_fetch_array($this->run) ;

 			return $row['final'];
 		}
 	}

 	 // this method fetch particular course credit hour from database on id

 	public function getCourseCredit($c) {

 		$this->query = "SELECT credit FROM courses WHERE c_id=$c";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			return $data['credit'];
 		}
 	}

 	// this method count teacher attended classes in terms of student attendance

 	public function calTeaClasses($c,$sid) {

 		$s = $sid;

 		$this->query = "SELECT COUNT(attendance) FROM attendance WHERE c_id=$c AND std_id=$s ";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data['COUNT(attendance)'];
 		}
 	}

 	// this method count student attended classes in terms of presents and return the figure

 	public function calStdClasses($sid,$cid) {

 		$id = $sid;

 		$this->query="SELECT COUNT(attendance) FROM attendance WHERE attendance='Present' AND std_id=$id AND c_id=$cid";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data['COUNT(attendance)'];
 		}

 	}	


 	// this method will get attendance marks 

 	public function getAttenMarks($sid,$c) {

 			$s = $sid;

 			$credit = $this->getCourseCredit($c);
 			$teaherClasses = $this->calTeaClasses($c,$s) * $credit;

 			if($teaherClasses == 0) {$teaherClasses = 1;}

 			$stdC = $this->calStdClasses($s,$c) * $credit;
 			$prcn = ceil($stdC/$teaherClasses*100);

 			$marks = 0;

 		if($prcn >= 95) {

 			$marks = 5;
 		
 		} else if($prcn >= 90 && $prcn < 95) {

 			$marks = 4.5;
 		
 		}else if($prcn >= 85 && $prcn < 90) {

 			$marks = 4;

 		} else if($prcn >= 80 && $prcn < 85) {

 			$marks = 3.5;

 		} else if($prcn >= 75 && $prcn < 80) {

 			$marks = 3;

 		} else if($prcn >= 70 && $prcn < 75) {

 			$marks = 2.5;
 		
 		} else if($prcn >= 65 && $prcn < 70) {

 			$marks = 2;
 		
 		}else if($prcn >= 60 && $prcn < 65) {

 			$marks = 1.5;
 		
 		}else if($prcn >= 55 && $prcn < 60) {

 			$marks = 1;
 		
 		}else if($prcn >= 50 && $prcn < 55) {

 			$marks = 0.5;
 		
 		} else {

 			$marks = 0;
 		}

 		return $marks;
 	}
 

	}

	// result manager class

	class resultManager extends dbConn {

		// this method will get normalized score ..

 	public function getNormalizeScore($max,$fscore) {

 		return ($fscore * 100) / $max;
 	}

 	// get final score 

 	// this method will return final score of a particular student

 	public function finalScore($sess,$mid,$final) {

 		// grading criteria .. 
 		$ass = 100;
 		$qui = 0;
 		$part = 0;
 		$med = 100;
 		$fi = 100;

 		$total = $ass+$qui+$part+$mid+$fi;

 		$fscore = 0;

 		$fscore=($sess*$ass/100)+(0*$qui/100)+(0*$part/100)+($mid*$med/100)+($final*$fi/100);

 		return $fscore;
 	
 	}

 	// this method will get grade ..

 	public function getGrade($g) {

 		$grade = "";

 		if($g >= 95.00) {

 			$grade = "A";
 		
 		} else if($g >= 90.00) {

 			$grade = "A-";
 		
 		} else if($g >= 85.00) {

 			$grade = "B+";
 		
 		} else if($g >= 80.00) {

 			$grade = "B";
 		
 		} else if($g >= 75.00) {

 			$grade = "B-";
 		
 		} else if($g >= 70.00) {

 			$grade = "C+";
 		
 		} else if($g >= 65.00) {

 			$grade = "C";
 		
 		} else if($g >= 60.00) {

 			$grade = "C-";
 		
 		} else if($g >= 55.00) {

 			$grade = "D+";
 		
 		} else if($g >= 50) {

 			$grade = "D";
 		
 		} else {

 			$grade = "F";
 		}

 		return $grade;

 	}

 	// this method will get GPA ..

 	public function getGpa($gpa) {

 		$g = 0.0;

 		if($gpa == "A") {

 			$g = 4.0;
 		
 		} else if($gpa == "A-") {

 			$g = 3.67;
 		
 		} else if($gpa == "B+") {

 			$g = 3.33;
 		
 		} else if($gpa == "B") {

 			$g = 3.00;
 		
 		} else if($gpa == "B-") {

 			$g = 2.67;
 		
 		} else if($gpa == "C+") {

 			$g = 2.33;
 		
 		} else if($gpa == "C") {

 			$g = 2.00;
 		
 		} else if($gpa == "C-") {

 			$g = 1.67;
 		
 		} else if($gpa == "D+") {

 			$g = 1.33;
 		
 		} else if($gpa == "D") {

 			$g = 1.00;
 		
 		} else {

 			$g = 0.0;
 		} 

 		return $g;
 	}

	}


	// data manager class

	class dataManager extends dbConn {

		private $query;
		private $run;

  		// this method will return all posts uploaded by the admin

		public function getPosts() {

 		$this->query = "SELECT * FROM post";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {
 			
 			return $this->run;
 			
 		}	

 		return false;
 	}


 	public function getStudentSection($id) {

 		$this->query = "SELECT section FROM students WHERE std_id=$id";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {
 			$data = mysqli_fetch_array($this->run);
 			return $data['section'];
 		}

 	}

 	public function is_DataAvaliable($sid,$cid) {

 		$atten = false;
 		$mark  = false;
 		$result = false;

 		$this->query = "SELECT * FROM attendance WHERE std_id=$sid AND c_id=$cid";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			if(mysqli_num_rows($this->run) > 0) {

 				$atten = true;
 			}
 		}

		$this->query = "SELECT * FROM internal_marks WHERE std_id=$sid AND c_id=$cid";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			if(mysqli_num_rows($this->run) > 0) {

 				$mark = true;
 			}
 		}

 		
 		return $atten && $mark;
 	}

 	public function getProfile($id) {

 		$this->query="SELECT * FROM students WHERE std_id=$id";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			return $data;
 		
 		} else {

 			echo "<script>alert('Internal Problem Occured ..')</script>";
 		}
 	}

 	public function updateProfile(profile $pro,$id) {

 		$user = $pro->getUser();
 		$sem = $pro->getSemester();
 		$sec = $pro->getSection();
 		$ema = $pro->getEmail();
 		$fname = $pro->getFname();
 		$lname = $pro->getLname();
 		$pass = $pro->getPass();

 		if($pass==7)
 			$this->query = "UPDATE `students` SET `username`='$user', `fname`='$fname',`lname`='$lname',`semester`='$sem',`section`='$sec',`email`='$ema' WHERE std_id=$id" ;
 		else
 			$this->query = "UPDATE `students` SET `username`='$user', `fname`='$fname',`lname`='$lname',`semester`='$sem',`section`='$sec',`email`='$ema',`password`='$pass' WHERE std_id=$id" ;

 		

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return true;
 		}

 		return false;

 	}

 	// this method will get copyright text from db...

 	public function getCopyRight() {

 		$this->query = "SELECT * FROM copyright";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			return $data['copyright'];
 		}
 	}

 	// this method will get data from course and attendance by student id ..

 	public function getCourseOnStudent($sem, $sec) {


 		$this->query = "SELECT c.c_id, c.title, a.c_id, a.semester, a.section FROM courses c, assigned_courses a WHERE c.c_id=a.c_id AND a.semester='$sem' ";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return $this->run;
 		
 		} else {

 			return "Error Occured";
 		}

 	}

 	// this method will get attendance by student and course id ..

 	public function getAttendance($s,$cid) {

 		$sid = $s;

 		$this->query = "SELECT * FROM attendance WHERE c_id=$cid AND std_id=$sid";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return $this->run;
 		}
 	}

 	// this method will calculate total student classes

 	public function studentClasses($s,$cid,$c) {

 		$sid = $s;

 		$this->query = "SELECT COUNT(attendance) FROM attendance WHERE std_id=$sid AND c_id=$cid AND attendance='Present'";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			return $data['COUNT(attendance)'] * $c;
 		}
 	}

 	// this method will get course credit hour

 	public function getCourseCredit($cid) {

 		$this->query="SELECT credit FROM courses WHERE c_id=$cid";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			return $data['credit'];
 		}

 	}

 	// this method will calucate total teacher classes

 	public function teacherClasses($s,$cid,$c) {

 		$sid = $s;

 		$this->query = "SELECT COUNT(attendance) FROM attendance WHERE std_id=$sid AND c_id=$cid";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			return $data['COUNT(attendance)'] * $c;
 		}
 	}

 	// this method will get data from courses and assigned courses by course id ..

 	public function getCourseData($cid) {

 		$this->query = "SELECT * FROM courses c , assigned_courses a WHERE c.c_id=$cid AND a.c_id=$cid GROUP BY a.c_id";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data;
 		}
 	}

 	
 	

 	
	}
 
 ?>