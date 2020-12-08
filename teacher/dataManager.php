<?php 

	//include("./gradingCriteria.php");

// database connection class

class dbCon {

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


///////////////////////////// attendanceManager Class //////////////////////////////////////////

class attendanceManager extends dbCon {

	private $query;
 	private $run;


 	// this method upload attendance to database
 		
 	public function uploadAttendance(Attendance $at) {

 		$atten =  $at->getAttendance();
 		$sec  = $at->getSection();
 		$week = $at->getWeek();
 		$sem = $at->getSemester();
 		$date = $at->getDate();
 		$cid = $at->getCid();
 		$tid = $at->getTid();
 
 		foreach ($atten as $key => $value) {
 			
 			$this->query = "INSERT INTO `attendance`(`std_id`, `t_id`,`c_id`,`std_sem`,`std_sec`, `attendance`, `week`, `date`) VALUES ($key,$tid,$cid,'$sem','$sec','$value','$week','$date')";

 			$this->run = mysqli_query($this->conn,$this->query);
 		}

 		if($this->run) {

 			echo "<script>alert('Attendance is successfully uploaded ...')</script>";
 		
 		} else {

 			echo "<script>alert('Internal Problem Occured ...')</script>";	
 		}	

 		

 	}

 	public function checkAttendance($cid, $date, $sem, $sec) {

 		$this->query="SELECT * FROM attendance WHERE c_id=$cid AND date='$date' AND std_sem='$sem' AND std_sec='$sec'";
 		$this->run = mysqli_query($this->conn, $this->query);

 		if($this->run) {

 			if(mysqli_num_rows($this->run) < 1) {

 				return false;
 			}

 			return true;
 		}
 	}

 	// this method will fetch attendance from the database

 	public function getAttendance($sem,$s,$cId,$week,$t) {

 		$this->query = "SELECT DISTINCT s.std_id, s.fname ,a.at_id, s.lname,a.a_id ,a.t_id, s.reg_no , a.attendance , a.date FROM  attendance a , students s WHERE a.std_sec = '$s' AND a.c_id = $cId AND a.week = '$week' AND a.std_sem='$sem' AND a.std_id = s.std_id AND a.t_id=$t ";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {
 			return $this->run;
 		}
 	}

 	// this method fetch student attendance based on specific id

 	public function getAttendanceOnId($id) {

 		$this->query = "SELECT DISTINCT s.std_id, s.reg_no,s.fname,s.lname,a.attendance,a.std_id,a.week,a.date,a.a_id FROM attendance a , students s WHERE at_id=$id AND s.std_id=a.std_id";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data;
 		}
 	}

 	// this method update attendance of a students

 	public function updateAttendance(Attendance $a,$id) {

 		$atten = $a->getAttendance();
 		$week  = $a->getWeek();
 		$date = $a->getDate();

 		$this->query = $this->conn->prepare("UPDATE `attendance` SET `attendance`=?,`week`=?,`date`=? WHERE at_id = $id");

 		$this->query->bind_param("sss",$atten,$week,$date);

 		if($this->query->execute()){

 			$this->query->close();

 			return true;
 		} 

 		return false;

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

 	// this method count student attended classes in terms of presents and return the figure

 	public function calStdClasses($id,$cid) {

 		$this->query="SELECT COUNT(attendance) FROM attendance WHERE attendance='Present' AND std_id=$id AND c_id=$cid";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data['COUNT(attendance)'];
 		}

 	}

 	// this method count teacher attended classes in terms of student attendance

 	public function calTeaClasses($id,$c,$s) {

 		$this->query = "SELECT COUNT(attendance) FROM attendance WHERE t_id=$id AND c_id=$c AND std_id=$s ";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data['COUNT(attendance)'];
 		}
 	}

 	// this method fetches random student in terms course , semester , section 

 	public function getRanStdRec($cId,$semester,$section) {

 		$this->query = "SELECT std_id FROM attendance WHERE c_id=$cId AND std_sem='$semester' AND std_sec='$section'";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data['std_id'];
 		}

 	}

 	// this method gets attendance date from database

 	public function getDate($sem,$sec,$cId,$week,$tid) {

 		$this->query = "SELECT DISTINCT date FROM attendance WHERE std_sem='$sem' AND std_sec='$sec' AND c_id=$cId AND week='$week' AND t_id=$tid";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return $this->run;
 		}
 	}

}


///////////////////////////// marksManager Class //////////////////////////////////////////


class marksManager extends dbCon {

	private $query;
 	private $run;


 	// this method uploads student marks to database

 	public function uploadMarks(Marks $marks) {

 		$q1 = $marks->getQuizOne();
		$q2 = $marks->getQuizTwo();
		$q3 = $marks->getQuizThree();
		$q4 = $marks->getQuizFour();
		$q5 = $marks->getQuizFive();
		$q6 = $marks->getQuizSix();
		$a1 = $marks->getAssOne();
		$a2 = $marks->getAssTwo();
		$a3 = $marks->getAssThree();
		$a4 = $marks->getAssFour();
		$a5 = $marks->getAssFive();
		$a6 = $marks->getAssSix();
		$par = $marks->getPart();
		$pre = $marks->getPres();

		$sem = $marks->getSemester();
		$sec = $marks->getSection();

		$tid = $marks->getTid();
		$cid = $marks->getCid();
		
		$mid = $marks->getMid();
		$final = $marks->getFinal();
		
		foreach($q1 as $sid=>$marks) {

			$this->query="INSERT INTO `internal_marks`(`c_id`, `t_id`, `std_id`, `std_sem`, `std_sec`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `participation`, `presentation`, `mid`, `final`) VALUES ($cid, $tid, $sid,'$sem', '$sec', $a1[$sid], $a2[$sid], $a3[$sid], $a4[$sid], $a5[$sid], $a6[$sid],$marks, $q2[$sid], $q3[$sid], $q4[$sid], $q5[$sid], $q6[$sid], $par[$sid], $pre[$sid], $mid[$sid], $final[$sid])";

			$this->run = mysqli_query($this->conn,$this->query);

		}

		if($this->run) {

			return true;
		
		 } 

		 return false;
 	}

 	public function checkMarks($cid, $sem, $sec) {

 		$this->query = "SELECT * FROM internal_marks WHERE c_id=$cid AND std_sem='$sem' AND std_sec='$sec' ";
 		$this->run = mysqli_query($this->conn, $this->query);

 		return mysqli_num_rows($this->run);
 	}

 	// this method gets all marks type e.g. quiz,assignment,midterm etc

 	// public function getMarkType($id) {

 	// 	$this->query = "SELECT DISTINCT mark_type FROM marks WHERE t_id=$id";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		return $this->run;
 	// 	}
 	// }

 	// this method fetch students marks from database

 	public function getMarks($tid,$cid,$sec,$sem) {

 	
 		$this->query = "SELECT DISTINCT * FROM internal_marks m , students s WHERE m.t_id=$tid AND m.c_id=$cid AND s.semester='$sem' AND s.section='$sec' AND s.std_id=m.std_id";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return $this->run;
 		
 		} else {

 			echo "<script>alert('Internal Problem Occured ..')</script>";
 		}
 	}


 	// this method fetches particular student marks on specific id

 	public function getMarksById($id) {

 		$this->query = "SELECT DISTINCT * FROM students s , internal_marks m WHERE s.std_id=m.std_id AND m.m_id=$id ";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data;
 		
 		} else {

 			echo "<script>alert('Internal Error Occured..')</script>";
 		}

 	}

 	// this method updates student marks

 	public function updateMarks(Marks $marks,$id) {

 		$q1 = $marks->getQuizOne();
		$q2 = $marks->getQuizTwo();
		$q3 = $marks->getQuizThree();
		$q4 = $marks->getQuizFour();
		$q5 = $marks->getQuizFive();
		$q6 = $marks->getQuizSix();

		$a1 = $marks->getAssOne();
		$a2 = $marks->getAssTwo();
		$a3 = $marks->getAssThree();
		$a4 = $marks->getAssFour();
		$a5 = $marks->getAssFive();
		$a6 = $marks->getAssSix();

		$part = $marks->getPart();
		$pres = $marks->getPres();

		$mid = $marks->getMid();
		$final = $marks->getFinal();

		// $this->query = $this->conn->prepare(

		// "UPDATE `internal_marks` SET `a1`=?,`a2`=?,`a3`=?,`a4`=?,`a5`=?,`a6`=?,`q1`=?,`q2`=?,`q3`=?,`q4`=?,`q5`=?,`q6`=?,`participation`=?,`presentation`=?,`mid`=?,`final`=? WHERE m_id=$id"
		// );

		$this->query= "UPDATE `internal_marks` SET `a1`='$a1', `a2`='$a2', `a3`='$a3', `a4`='$a4', `a5`='$a5', `a6`='$a6', `q1`='$q1', `q2`='$q2', `q3`='$q3', `q4`='$q4', `q5`='$q5',`q6`='$q6',`participation`='$part',`presentation`='$pres',`mid`='$mid',`final`='$final' WHERE m_id=$id";

		$this->run = mysqli_query($this->conn, $this->query);

		if($this->run) {
			return true;
		}

		return false;

 		// $this->query = $this->conn->prepare("UPDATE `internal_marks` SET `q1`=?,`q2`=?,`q3`=?,`q4`=?,`q5`=?,`q6`=?,`a1`=?,`a2`=?,`a3`=?,`a4`=?,`a5`=?,`a6`=?,`participation`=?,`	presentation`=?,`mid`=?, `final`=? WHERE m_id=$id");

 		// $this->query->bind_param("iiiiiiiiiiiiiiii",$a1,$a2,$a3,$a4,$a5,$a6,$q1,$q2,$q3,$q4,$q5,$q6,$part,$pres,$mid,$final);

 		// if($this->query->execute()) {

 		// 	$this->query->close();

 		// 	return true;
 		// }

 		// return false;
 	}

}



	


///////////////////////////// dataManager Class //////////////////////////////////////////

 class dataManager extends dbCon {

 	private $query;
 	private $run;

 	// method to get posts from database
 	public function getPosts() {

 		$this->query = "SELECT * FROM post";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {
 			return $this->run;
 			exit();
 		}	

 		return false;
 	}

 	public function getSessionAndClass($c,$t) {

 		$this->query = "SELECT session , class FROM assigned_courses WHERE c_id=$c AND t_id=$t";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 		}

 		return array(0=>$data['session'],1=>$data['class']);
 	}

 	public function getProfile($id) {

 		$this->query="SELECT * FROM teachers WHERE t_id=$id";
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
 		$ema = $pro->getEmail();
 		$fname = $pro->getFname();
 		$lname = $pro->getLname();
 		$pass = $pro->getPass();

 		if($pass==7)
 			$this->query = "UPDATE teachers SET `username`='$user', fname='$fname', lname='$lname', email='$ema' WHERE t_id=$id" ;
 		else
 			$this->query = "UPDATE teachers SET `username`='$user', fname='$fname', lname='$lname', email='$ema', password='$pass' WHERE t_id=$id" ;

 		

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return true;
 		}

 		return false;

 	}

 	// public function stuffExistanceByTeacherId($table,$id) {

 	// 	$this->query = "SELECT * FROM  ".$table." WHERE a_id=$id";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		if(mysqli_num_rows($this->run) > 0) {

 	// 			return true;
 	// 		} else {

 	// 			return false;
 	// 		}
 	// 	}
 	// }

 	// public function getFromAssignCourseIdById($id) {

		// $this->query = "SELECT c_id FROM assigned_courses WHERE t_id=$id";
		// $this->run = mysqli_query($this->conn,$this->query);
		
		// $ids = array();

		// while($row = mysqli_fetch_array($this->run)) {
		// 	array_push($ids, $row['c_id']);
		// } 		

		// $titles = array();

		// foreach($ids as $data) {

		// 	$this->query = "SELECT title FROM courses WHERE c_id = $data";
		// 	$this->run = mysqli_query($this->conn,$this->query);
		// 	$rows = mysqli_fetch_array($this->run);

		// 	array_push($titles, $rows['title']);
		// 	//$titles[$data] = $rows;
		// }

		// return $titles;
 
 	// }

 	// public function getAssignCourses($id) {

		// 	$this->query = "SELECT DISTINCT a.c_id, a.session, a.class c.c_id , c.title FROM assigned_courses a , courses c WHERE a.c_id = c.c_id GROUP BY a.t_id=$id ";
		// 	$this->run = mysqli_query($this->conn,$this->query);

		// 	if($this->run) {

		// 		return $this->run;
		// 	}

		// }


 	public function assignCourseByTeacherId($id) {

 		$this->query = "SELECT c.c_id,c.title,a.semester,a.section,a.class FROM assigned_courses a , courses c  WHERE c.c_id = a.c_id AND a.t_id=$id" ;
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {
 			return $this->run;
 		}
 	}

 	

 	public function getStudentsBySecAndSem($sem,$sec) {

 		$this->query = "SELECT std_id , reg_no , fname , lname FROM students WHERE semester='$sem' AND section='$sec' AND status != 'OFF' ";

 		$this->run = mysqli_query($this->conn,$this->query);

 		return $this->run;

 	}

 	

 	public function getCourseId($id) {

 		$this->query = "SELECT title FROM courses WHERE c_id=$id";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			return $data['title'];
 		}

 	}


 	

 	// public function getStudentNameById($id) {

 	// 	$this->query = "SELECT fname , lname FROM students WHERE std_id=$id";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {
 	// 		$data = mysqli_fetch_array($this->run);
 	// 		return $data['fname'] . " " . $data['lname'];
 	// 	}

 	// }

 	// public function getStudentRegById($id) {

 	// 	$this->query = "SELECT reg_no FROM students WHERE std_id=$id";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {
 	// 		$data = mysqli_fetch_array($this->run);
 	// 		return $data['reg_no'];
 	// 	}
 	// }

 	// public function getUniqueWeeks($a,$t) {

 	// 	$this->query = "SELECT DISTINCT week FROM attendance WHERE a_id=$a AND t_id=$t";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		return $this->run;
 	// 	}
 	// }

 	// public function getUniqueDates($a,$t) {

 	// 	$this->query = "SELECT DISTINCT date FROM attendance WHERE t_id=$t AND a_id=$a ";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		return $this->run;
 	// 	}  
 	// }

 	
 	public function getCopyRight() {

 		$this->query = "SELECT * FROM copyright";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			return $data['copyright'];
 		}
 	}

 	
}

////////////////////////////// RESULTS MANAGER CLASS /////////////////////////////////

class resultManager extends dbCon {

	private $query;
 	private $run;



 	// this method will return final score of a particular student

 	public function finalScore($s,$c,$t,$sess,$mid,$final) {

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

 	public function checkFinalGrades($cid) {

 		$atten = false;
 		$marks = false;

 		$this->query = "SELECT c_id FROM attendance WHERE c_id=$cid";
 		$this->run = mysqli_query($this->conn, $this->query);

 		if($this->run) {

 			if(mysqli_num_rows($this->run) > 0)
 				$atten = true;
 		}

 		$this->query = "SELECT c_id FROM internal_marks WHERE c_id=$cid";
 		$this->run = mysqli_query($this->conn, $this->query);

 		if($this->run) {

 			if(mysqli_num_rows($this->run) > 0)
 				$marks = true;
 		}

 		if(!$atten || !$marks) {

 			return true;
 		}

 		return false;
 	}

 	// public function is_DataAvailiable() {

 	// 	$atten = false;
 	// 	$mark = false;
 	// 	$result = false;

 	// 	$this->query = "SELECT * FROM attendance";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		if(mysqli_num_rows($this->run) < 1) {

 	// 			$atten = true;
 	// 		}
 	// 	}

 	// 	$this->query = "SELECT * FROM marks";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		if(mysqli_num_rows($this->run) < 1) {

 	// 			$mark = true;
 	// 		}
 	// 	}

 	// 	$this->query = "SELECT * FROM result";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		if(mysqli_num_rows($this->run) < 1) {

 	// 			$result = true;
 	// 		}
 	// 	}

 	// 	if($atten || $mark || $result) {

 	// 		return true;
 	// 	}

 	// }

 	// public function is_DataAvailiableOnSec($sec) {

 	// 	$atten = false;
 	// 	$mark = false;
 	// 	$result = false;

 	// 	$this->query = "SELECT * FROM attendance WHERE std_sec='$sec'";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		if(mysqli_num_rows($this->run) < 1) {

 	// 			$atten = true;
 	// 		}
 	// 	}

 	// 	$this->query = "SELECT * FROM marks WHERE std_sec='$sec'";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		if(mysqli_num_rows($this->run) < 1) {

 	// 			$mark = true;
 	// 		}
 	// 	}

 	// 	$this->query = "SELECT * FROM result WHERE std_sec='$sec'";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		if(mysqli_num_rows($this->run) < 1) {

 	// 			$result = true;
 	// 		}
 	// 	}

 	// 	if($atten || $mark || $result) {

 	// 		return true;
 	// 	}

 	// }

 	// public function checkResult($tid,$cid,$sem,$sec) {

 	// 	$this->query = "SELECT * FROM result WHERE c_id=$cid AND t_id=$tid AND  std_sec='$sec' AND std_sem='$sem'";
 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		if(mysqli_num_rows($this->run) > 0) {

 	// 			return true;
 	// 		}

 	// 		return false;
 	// 	}
 	// }

 	// this method calculates sessional marks of particular student

 	public function getSessional($s,$c,$t) {

 		$this->query = "SELECT `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `participation`, `presentation` FROM `internal_marks` WHERE std_id=$s AND c_id=$c AND t_id=$t";
 		$this->run = mysqli_query($this->conn,$this->query);

 		$attenMarks = $this->getAttenMarks($s,$c,$t);

 		

 		$total = 0;

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			$total = $data['q1'] + $data['q2'] + $data['q3'] + $data['q4'] + $data['q5'] + $data['q6'] + $data['a1'] +$data['a2'] + $data['a3'] + $data['a4'] + $data['a5'] + $data['a6'] + $data['participation'] + $data['presentation'] + $attenMarks ;
 		}

 		return $total ;
 	}

 	// this method will return mid term marks of a particular student

 	public function getMidTerm($s,$c,$t) {

 		$this->query = "SELECT mid FROM internal_marks WHERE std_id=$s AND t_id=$t AND c_id=$c";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$row = mysqli_fetch_array($this->run) ;

 			return $row['mid'];
 		}
 	}

 	// this method will return final term marks of particular student

 	public function getFinalTerm($s,$c,$t) {

 		$this->query = "SELECT final FROM internal_marks WHERE std_id=$s AND t_id=$t AND c_id=$c";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$row = mysqli_fetch_array($this->run) ;

 			return $row['final'];
 		}
 	}

 	public function getAttenMarks($s,$c,$t) {

 			$am = new attendanceManager();
 			$credit = $am->getCourseCredit($c);
 			$teaherClasses = $am->calTeaClasses($t,$c,$s) * $credit;
 			$stdC = $am->calStdClasses($s,$c) * $credit;
 			if($teaherClasses == 0) {$teaherClasses = 1;}
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

 	// public function getResult($tid,$cid,$sec,$sem) {

 	// 	$this->query = "SELECT * FROM students s , result r WHERE r.t_id=$tid AND r.c_id=$cid AND r.std_id = s.std_id AND s.section='$sec' AND s.semester='$sem'";

 	// 	$this->run = mysqli_query($this->conn,$this->query);

 	// 	if($this->run) {

 	// 		return $this->run;
 	// 	}

 	// }

 	public function getNormalizeScore($max,$fscore) {

 		return ($fscore * 100) / $max;
 	}

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

 
} // end 


 ?>