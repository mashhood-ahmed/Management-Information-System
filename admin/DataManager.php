 <?php 

 	// database connection class

 	class databaseConnection {

 		protected $conn;

		public function __construct() {

			$this->conn = new mysqli("localhost","root","","csit");

			if($this->conn->connect_error) {
				die("Connection Error " . $this->conn->connect_error);
			}
		}

		public function __destruct() {

			$this->conn->close();
		}
 	}


 // class to manage student data

 class studentManager extends databaseConnection {

 	private $query;
 	private $run;

 	

		public function getStudentSemester() {

			$this->query = "SELECT DISTINCT semester FROM students ORDER BY semester ASC ";
			$this->run = mysqli_query($this->conn,$this->query);

			return $this->run;
		}


		public function getAllStudentsOnSemAndSec($sem, $sec) {

			$this->query="SELECT * FROM students WHERE semester='$sem' AND section='$sec' AND status='ON'";
			$this->run=mysqli_query($this->conn,$this->query);

			return $this->run;
		
		}

		


		public function getStdRegistrationOnId($id) {

			$this->query="SELECT reg_no FROM students WHERE std_id = $id";
			$this->run=mysqli_query($this->conn,$this->query);
			$data = mysqli_fetch_array($this->run);

			return $data['reg_no']; 
		}

		public function getNumOfStds($sem, $sec) {

			$this->query = "SELECT * FROM students WHERE semester='$sem' AND section='$sec'";
			$this->run = mysqli_query($this->conn, $this->query);
			return $count = mysqli_num_rows($this->run);
		}

		// public function getStdFNameOnId($id) {
			
		// 	$this->query="SELECT fname FROM students WHERE std_id = $id";
		// 	$this->run=mysqli_query($this->conn,$this->query);
		// 	$data = mysqli_fetch_array($this->run);

		// 	return $data['fname']; 
		// }

		// public function getStdLNameOnId($id) {
			
		// 	$this->query="SELECT lname FROM students WHERE std_id = $id";
		// 	$this->run=mysqli_query($this->conn,$this->query);
		// 	$data = mysqli_fetch_array($this->run);

		// 	return $data['lname']; 
		// }

		// public function getStdSemesterOnId($id) {
			
		// 	$this->query="SELECT semester FROM students WHERE std_id = $id";
		// 	$this->run=mysqli_query($this->conn,$this->query);
		// 	$data = mysqli_fetch_array($this->run);

		// 	return $data['semester']; 
		// }

		// public function getStdSectionOnId($id) {
			
		// 	$this->query="SELECT section FROM students WHERE std_id = $id";
		// 	$this->run=mysqli_query($this->conn,$this->query);
		// 	$data = mysqli_fetch_array($this->run);

		// 	return $data['section']; 
		// }

		// public function getStdEmailOnId($id) {
			
		// 	$this->query="SELECT email FROM students WHERE std_id = $id";
		// 	$this->run=mysqli_query($this->conn,$this->query);
		// 	$data = mysqli_fetch_array($this->run);

		// 	return $data['email']; 
		// }

		// public function getStdPasswordOnId($id) {
			
		// 	$this->query="SELECT password FROM students WHERE std_id = $id";
		// 	$this->run=mysqli_query($this->conn,$this->query);
		// 	$data = mysqli_fetch_array($this->run);

		// 	return $data['password']; 
		// }

		public function getStdOnRegNo($reg) {

			$this->query = "SELECT * FROM students WHERE reg_no='$reg' AND status='ON' ";
			$this->run = mysqli_query($this->conn,$this->query);

			if(mysqli_num_rows($this->run) > 0 ) {

				$data = mysqli_fetch_array($this->run);
				return $data;	
			}

			return false;
			
		}

		public function youCan($reg) {
			$this->query="SELECT * FROM students WHERE reg_no = '$reg'";
			$this->run = mysqli_query($this->conn,$this->query);

			if(mysqli_num_rows($this->run) > 0){
				return false;
			}
			return true;
		}

		public function updateStudent(UpdateStudent $std,$id) {

			 $reg = $std->getRegNo();		
			 $fname = $std->getFirstName();
			 $lname = $std->getLastName();
			 $email = $std->getEmail();
			 $semester = $std->getSemester();
			 $section = $std->getSection();
			 $pass = $std->getPassOne();

			 $this->query=$this->conn->prepare("UPDATE `students` SET `reg_no`=?,`fname`=?,`lname`=?,`semester`=?,`section`=?,`email`=?,`password`=? WHERE std_id=$id ");

			 $this->query->bind_param("sssssss",$reg,$fname,$lname,$semester,$section,$email,$pass);

			 if($this->query->execute()){

			 	
			 	return true;
			 	
			 }

			 return false;
			 
			 $this->query->close();
		}

		public function delStudent($id) {
			

			$this->query="DELETE FROM students WHERE std_id=$id";
			$this->run = mysqli_query($this->conn,$this->query);

			if($this->run) {

				return true;
			}

			return false;
			

		}


 }

 // class to manage teacher data
 class teacherManager extends databaseConnection {

 	private $query;
 	private $run;

 	
		// public function youCan($e) {

		// 	$this->query="SELECT * FROM teachers WHERE email = '$e'";
		// 	$this->run = mysqli_query($this->conn,$this->query);

		// 	if(mysqli_num_rows($this->run) > 0){

		// 		return false;
		// 	}

		// 	return true;
		// }

 		public function getNoOfTeachers() {

 			$this->query="SELECT * FROM teachers WHERE status='ON'";

			$this->run=mysqli_query($this->conn,$this->query);

			return mysqli_num_rows($this->run);	

 		}

		public function getTeachers($s, $e) {

			$this->query="SELECT * FROM teachers WHERE status='ON' LIMIT $s, $e";

			$this->run=mysqli_query($this->conn,$this->query);

			if(mysqli_num_rows($this->run) > 0) {

				return $this->run;
			}	

			header("location index.php?viewTeacher&page=1");
		}

		public function getTeacherForCourse() {

			$this->query = "SELECT * FROM teachers";
			$this->run = mysqli_query($this->conn, $this->query);

			return $this->run;
		}

		public function delStudent($id) {

			$this->query="DELETE FROM `students` WHERE std_id=$id";
			$this->run=mysqli_query($this->conn,$this->query);

			if($this->run) {
				echo "
			 		<div style='margin-top: 20px;' class='alert alert-success'>
			 		<strong>Success!</strong>
			 		&nbsp;
			 		Student record is successfully deleted
			 		</div>
			 	";

			}

		}

		public function getTeacherFnameOnId($id) {

			$this->query = "SELECT fname FROM teachers WHERE t_id=$id";
			$this->run = mysqli_query($this->conn,$this->query);
			$record = mysqli_fetch_array($this->run);
			return $record['fname'];
		}

		public function getTeacherLnameOnId($id) {

			$this->query = "SELECT lname FROM teachers WHERE t_id=$id";
			$this->run = mysqli_query($this->conn,$this->query);
			$record = mysqli_fetch_array($this->run);
			return $record['lname'];	
		}

		// public function getTeacherEmailOnId($id) {

		// 	$this->query = "SELECT email FROM teachers WHERE t_id=$id";
		// 	$this->run = mysqli_query($this->conn,$this->query);
		// 	$record = mysqli_fetch_array($this->run);
		// 	return $record['email'];	
		// }

		// public function getTeacherPasswordOnId($id) {

		// 	$this->query = "SELECT password FROM teachers WHERE t_id=$id";
		// 	$this->run = mysqli_query($this->conn,$this->query);
		// 	$record = mysqli_fetch_array($this->run);
		// 	return $record['password'];	

		// }

		public function updTeacher(updateTeacher $teacher,$id) {

			 $fname = $teacher->getFirstName();
			 $lname = $teacher->getLastName();
			 $email = $teacher->getEmail();
			 $pass = $teacher->getPassOne();

			 $this->query=$this->conn->prepare("UPDATE `teachers` SET `fname`=?,`lname`=?,`email`=?,`password`=? WHERE t_id=$id");

			 $this->query->bind_param("ssss",$fname,$lname,$email,$pass);

			 if($this->query->execute()) {

			 	$this->query->close();
			 	return true;
	
			 } 
			 
			 return false;
		}

		public function delTeacher($id) {

			$this->query="DELETE FROM teachers WHERE t_id=$id";
			$this->run = mysqli_query($this->conn,$this->query);


			if($this->run) {

				return true;
			}

			return false;
 		}
}

 		// class to manage course data

 		class courseManager extends databaseConnection {

 			private $query;
 			private $run;

 			public function uploadCourse(addCourse $course){

			 $title = $course->getTitle();
			 $code = $course->getCode();
			 $credit = $course->getCredit();

			 $this->query=$this->conn->prepare("INSERT INTO `courses`(`title`, `code`, `credit`) VALUES (?,?,?)");
			 $this->query->bind_param("ssi",$title,$code,$credit);

			 if($this->query->execute()){

			 	return true;

			 }

			 return false;

			 $this->query->close();
		}

		public function getSpecificCourse() {

			$this->query="SELECT t1.c_id,t1.title
					FROM courses t1
					LEFT JOIN assigned_courses t2 ON t2.c_id = t1.c_id
					WHERE t2.c_id IS NULL";
			$this->run = mysqli_query($this->conn,$this->query);

			if($this->run) {

				return $this->run;
			}

		}

		public function youCan($c) {
			$this->query="SELECT * FROM courses WHERE code = '$c'";
			$this->run = mysqli_query($this->conn,$this->query);

			if(mysqli_num_rows($this->run) > 0){
				return false;
			}
			return true;
		}


		public function getCourses($s,$e) {

			$this->query="SELECT * FROM `courses` LIMIT $s, $e";
			$this->run=mysqli_query($this->conn,$this->query);
			
			if(mysqli_num_rows($this->run) > 0) {

				return $this->run;
			} 

			header("location: index.php?viewCourse&page=1"); 	
		}

		public function getNoOfCourses() {

			$this->query = "SELECT * FROM courses";
			$this->run = mysqli_query($this->conn, $this->query);

			return mysqli_num_rows($this->run);
		}

		public function getCourseTitleOnId($id) {

 			$this->query = "SELECT title FROM courses WHERE c_id = $id ";
 			$this->run = mysqli_query($this->conn,$this->query);
 			$record = mysqli_fetch_array($this->run);

 			return $record['title'];

 		}

 		public function getCourseCodeOnId($id) {

 			$this->query = "SELECT `code` FROM `courses` WHERE c_id = $id ";
 			$this->run = mysqli_query($this->conn,$this->query);
 			$record = mysqli_fetch_array($this->run);

 			return $record['code'];	
 		}
 

 		public function getCourseCreditId($id) {

 			$this->query = "SELECT credit FROM courses WHERE c_id = $id ";
 			$this->run = mysqli_query($this->conn,$this->query);
 			$record = mysqli_fetch_array($this->run);

 			return $record['credit'];
 		}

 		public function updateCourse(updCourse $course,$id) {

 			 $title = $course->getTitle();
			 $credit = $course->getCredit();

			 $this->query = $this->conn->prepare("UPDATE `courses` SET `title`=?, `credit`=? WHERE c_id=$id");
			 $this->query->bind_param("si",$title,$credit);

			 if($this->query->execute()) {

			 	$this->query->close();

			 	return true;
			 }	

			 $this->query->close();
			 return false;	
 		}

 		public function deleteCourse($id) {

 			$this->query = "DELETE FROM `courses` WHERE c_id = $id ";
 			$this->run = mysqli_query($this->conn,$this->query);

 			if($this->run) {

 				return true;
 			}

 			return false;
 		}

 		}

 		
 	// class to manage assigned course data

 	class assignCourseManager extends databaseConnection {

 		private $query;
 		private $run;

 		public function uploadAssignCourse(AssignCourse $a) {

			 $teacher =  $a->getTeacher();
			 $course =  $a->getCourse();
			 $semester = $a->getSemester();
			 $section = $a->getSection();
			 $session = $a->getSession();
			 $class =  $a->getClass();

			 $this->query=$this->conn->prepare("INSERT INTO `assigned_courses`(`t_id`, `c_id`, `semester`, `section`, `session`, `class`) VALUES (?,?,?,?,?,?)");

			 $this->query->bind_param("iissss",$teacher,$course,$semester,$section,$session,$class);

			 if($this->query->execute()) {

			 	$this->query->close();

			 	return true;
			 }

			 $this->query->close();

			 return false;

		}


		public function checkAssignCourse($t,$c) {

			$this->query="SELECT * FROM `assigned_courses` WHERE c_id=$c ";
			$this->run=mysqli_query($this->conn,$this->query);

			if(mysqli_num_rows($this->run) > 0) {
				return false;
			}

			return true;
		}

		public function getRecord($id) {

			$this->query="SELECT t.fname,t.lname,c.c_id,t.t_id,c.title,a.semester,a.section,a.session,a.class FROM teachers t , courses c , assigned_courses a WHERE a.a_id=$id AND a.c_id=c.c_id AND a.t_id=t.t_id"; 

			$this->run = mysqli_query($this->conn,$this->query);

			if($this->run){
				$data = mysqli_fetch_array($this->run);
				return $data;
			}
		}

		public function getAssignCourseBySemester($semester) {

 			$this->query = "SELECT * FROM assigned_courses WHERE semester = '$semester'";
 			$this->run = mysqli_query($this->conn,$this->query);

 			return $this->run;
 		}

 		public function getAcourseById($c_id) {

 			$this->query = "SELECT c.title FROM courses c , assigned_courses a WHERE a.c_id=$c_id";
 			$this->run = mysqli_query($this->conn,$this->query);
 			$data = mysqli_fetch_array($this->run);

 			return $data['title'];
 		}


		public function getAcourseTeacherById($c_id) {

			$this->query = "SELECT t.fname , t.lname FROM teachers t , assigned_courses  WHERE t.t_id = $c_id ";
 			$this->run = mysqli_query($this->conn,$this->query);
 			$data = mysqli_fetch_array($this->run);

 			return $data['fname'] . " " . $data['lname'];
		}

		public function getAcourseSemesterById($c_id) {

			$this->query = "SELECT semester FROM assigned_courses WHERE a_id = $c_id";
			$this->run = mysqli_query($this->conn,$this->query);
			$data = mysqli_fetch_array($this->run);

			return $data['semester'];
		}
		
		public function getAcourseSectionById($c_id) {

			$this->query = "SELECT section FROM assigned_courses WHERE a_id = $c_id";
			$this->run = mysqli_query($this->conn,$this->query);
			$data = mysqli_fetch_array($this->run);

			return $data['section'];
		}

		public function getAcourseSessionById($c_id) {

			$this->query = "SELECT session FROM assigned_courses WHERE a_id = $c_id";
			$this->run = mysqli_query($this->conn,$this->query);
			$data = mysqli_fetch_array($this->run);

			return $data['session'];
		}

		public function getAcourseClassById($c_id) {

			$this->query = "SELECT class FROM assigned_courses WHERE a_id = $c_id";
			$this->run = mysqli_query($this->conn,$this->query);
			$data = mysqli_fetch_array($this->run);

			return $data['class'];
		}	

		public function updateAssignCourse(updateAssignCourse $a , $id) {

			 $teacher =  $a->getTeacher();
			 $course =  $a->getCourse();
			 $semester = $a->getSemester();
			 $section = $a->getSection();
			 $session = $a->getSession();
			 $class =  $a->getClass();

			 $this->query = $this->conn->prepare("UPDATE `assigned_courses` SET `t_id`=?,`c_id`=?,`semester`=?,`section`=?,`session`=?,`class`=? WHERE a_id = $id ");
			 $this->query->bind_param("iissss",$teacher,$course,$semester,$section,$session,$class);

			 if($this->query->execute()) {

			 	$this->query->close();

			 	return true;
			 }

			 $this->query->close();

			 return false;

		}

		public function getAssignCourses() {

			$this->query = "SELECT DISTINCT a.c_id , c.c_id , c.title FROM assigned_courses a , courses c WHERE a.c_id = c.c_id ";
			$this->run = mysqli_query($this->conn,$this->query);

			if($this->run) {

				return $this->run;
			}

		}

 	}

 	// class to manage copyright text

 	class copyRight extends databaseConnection {

 		private $query;
 		private $run;

 		public function getCopyRight() {

 			$this->query = "SELECT * FROM copyright";
 			$this->run = mysqli_query($this->conn,$this->query);

 			if($this->run) {
 				$data = mysqli_fetch_array($this->run);
 				return $data['copyright'];
 			}
 		}

 		public function updateCopyRight(copyText $c) {

 			$data = $c->getText();
 			$this->query = $this->conn->prepare("UPDATE `copyright` SET `copyright`=? WHERE id=1 ");
 			$this->query->bind_param("s",$data);

 			if($this->query->execute()) {

 				echo "<script>window.open('index.php?copy','_self')</script>";
 			}

 		}

 	}	

 	// class to manipulate posts

 	class postManager extends databaseConnection {

 		private $query;
 		private $run;

 		public function uploadWithOutFile(Post $p) {

 			$title = $p->getTitle();
 			$desc = $p->getDesc();	

 			$this->query = $this->conn->prepare("INSERT INTO `post`(`title`,  `description`) VALUES (?,?)");
 			$this->query->bind_param("ss",$title,$desc);

 				if($this->query->execute()) {

 					echo "<script>alert('Post is successfully uploaded ..')</script>";
 				} else {
 					echo "<script>alert('Internal problem occurred')</script>";
 				}
 			
 			$this->query->close();

 		}


 		public function uploadPost(Post $p) {

 			$title = $p->getTitle();
 			$file = $p->getFile();
 			$desc = $p->getDesc();
 			$tmp = $p->getFileTempName();
 			$size = $p->getFileSize();
 			$type = $p->getFileType();
			
 			$jpg = "image/jpeg";
 			$png = "image/png";
 			$pdf = "application/pdf";
 			$word = "application/msword";
 			$excel = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
 			$plain = "text/plain";

 			$SetSize = 10000000;

 			if($size < $SetSize) {

 			if($type==$jpg || $type==$png || $type==$pdf || $type==$word || $type==$excel || $type==$plain) {

 				move_uploaded_file($tmp, "./uploads/$file");

 				
 			$this->query=$this->conn->prepare("INSERT INTO `post`(`title`, `description`, `file`) VALUES (?,?,'$file')");
 			$this->query->bind_param("ss",$title,$desc);

 				if($this->query->execute()) {

 					echo "<script>alert('Post is successfully uploaded ..')</script>";
				
 				} else {

 					echo "<script>alert('Internal Problem Occured ..')</script>";
 				}
 			
 			} else {

 				echo "
			 		<div style='margin-top: 20px;' class='alert alert-danger'>
			 		<strong>Error!</strong>
			 		&nbsp;
			 		Only jpg,png,pdf,word,excel file formats allowed
			 		</div>
			 	";		
 			}

 			} else {

 				echo "
			 		<div style='margin-top: 20px;' class='alert alert-danger'>
			 		<strong>Error!</strong>
			 		&nbsp;
			 		File size is not supported
			 		</div>
			 	";	
 			}

 			$this->query->close();	
 		}	


 		public function getPosts() {

 			$this->query = "SELECT * FROM post";
 			$this->run = mysqli_query($this->conn,$this->query);

 			return $this->run;
 		}

 		public function getPostTitle($id) {

 			$this->query = "SELECT title FROM post WHERE id=$id";
 			$this->run = mysqli_query($this->conn,$this->query);

 			if($this->run) {

 				$data = mysqli_fetch_array($this->run);
 				return $data['title'];
 				exit();
 			}

 			return "Nothing Found";

 		}

 		public function getPostDesc($id) {

 			$this->query = "SELECT `description` FROM `post` WHERE id=$id";
 			$this->run = mysqli_query($this->conn,$this->query);

 			if($this->run) {

 				$data = mysqli_fetch_array($this->run);
 				return $data['description'];
 				exit();
 			}

 			return "Nothing Found";

 		}

 		public function getPostFile($id) {

 			$this->query = "SELECT file FROM post WHERE id=$id";
 			$this->run = mysqli_query($this->conn,$this->query);

 			if($this->run) {

 				$data = mysqli_fetch_array($this->run);
 				return $data['file'];
 				exit();
 			}	

 			return "Nothing Found";

 		}

 		public function updateWithOutFile(Post $p,$id) {

 			$title = $p->getTitle();
 			$desc = $p->getDesc();


 			$this->query = $this->conn->prepare("UPDATE `post` SET `title`=?,`description`=? WHERE id=$id");
 			$this->query->bind_param("ss",$title,$desc);

 				if($this->query->execute()) {

 				echo "<script>alert('Post is successfully updated ..')</script>";
 				
 				} else {

 				echo "<script>alert('Internal problem Occured ..')</script>";
 				}

 				$this->query->close();
 		}

 		
 		public function updatePost(Post $p ,$id) {

 			$title = $p->getTitle();
 			$file = $p->getFile();
 			$desc = $p->getDesc();
 			$tmp = $p->getFileTempName();
 			$size = $p->getFileSize();
 			$type = $p->getFileType();

 			$jpg = "image/jpeg";
 			$png = "image/png";
 			$pdf = "application/pdf";
 			$word = "application/msword";
 			$excel = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
 			$plain = "text/plain";

 			$SetSize = 1000000;

 			if($size < $SetSize) {

 			if($type==$jpg || $type==$png || $type==$pdf || $type==$word || $type==$excel || $type==$plain) {

 				move_uploaded_file($tmp, "./uploads/$file");

 				
 			$this->query=$this->conn->prepare("UPDATE `post` SET `title`=?,`description`=?,`file`='$file' WHERE id=$id");
 			$this->query->bind_param("ss",$title,$desc);

 				if($this->query->execute()) {

 					echo "<script>alert('Post is successfully updated ..')</script>";	
 				} else {

 					echo "<script>alert('Internal Problem Occured')</script>";
 				}
 			
 			} else {

 				echo "<script>alert('File Size Is Too Large ..')</script>";
	
 			}

 			} else {

 				echo "
			 		<div style='margin-top: 20px;' class='alert alert-danger'>
			 		<strong>Error!</strong>
			 		&nbsp;
			 		File size is not supported
			 		</div>
			 	";	
 			}

 		}	

 		public function deletePost($id) {

 			$this->query = "DELETE FROM `post` WHERE id=$id";
 			$this->run = mysqli_query($this->conn,$this->query);

 			if($this->run) {
 				echo "<script>
 				alert('Post is successfully deleted ..')
 				window.location.assign('index.php?home')
 				</script>
			 		
			 	";	
 			}
 		}


 		}

 	///////////////// Attendance manager class ////////////////////////////

 		class attendanceManager extends databaseConnection {

 			private $query;
 			private $run;

 			public function getAttendanceBy($c,$sec,$sem,$week) {

 				$this->query = "SELECT DISTINCT s.std_id,a.at_id, s.fname , s.lname,a.a_id, s.reg_no , a.attendance , a.date FROM  attendance a , students s WHERE a.std_sec = '$sec' AND a.c_id = $c AND a.week = '$week' AND a.std_sem='$sem' AND a.std_id = s.std_id";

 				$this->run = mysqli_query($this->conn,$this->query);

 				if($this->run) {

 					return $this->run;
 				}
 			}

 			// this method count teacher attended classes in terms of student attendance

 	public function calTeaClasses($c,$s) {

 		$this->query = "SELECT COUNT(attendance) FROM attendance WHERE c_id=$c AND std_id=$s ";

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

 	public function getCourseTitle($id) {

 		$this->query = "SELECT title FROM courses WHERE c_id=$id";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);

 			return $data['title'];
 		}

 	}

 	public function getSessionAndClass($id) {

 		$this->query= "SELECT session,class FROM assigned_courses WHERE c_id=$id"; 
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$row = mysqli_fetch_array($this->run);
 			return array(0=>$row['session'],1=>$row['class']);
 		}
 	}

 		}

//////////////////// Marks manager Class //////////////////////////////////
 		class marksManager extends databaseConnection {

 			private $query;
 			private $run;

 			public function getStudentsBy($course,$sec,$sem) {

 				$this->query = "SELECT s.std_id , m.c_id, m.std_id , s.fname , s.lname , s.reg_no , s.semester , s.section FROM students s , marks m WHERE m.std_id=s.std_id AND m.c_id=$course AND s.section='$sec' AND s.semester='$sem' GROUP BY m.std_id ";

 				$this->run = mysqli_query($this->conn,$this->query);

 				if($this->run) {

 					return $this->run;
 				}
 			}

 			public function getCourseId($id) {

 				$this->query = "SELECT title FROM courses WHERE c_id=$id";
 				$this->run = mysqli_query($this->conn,$this->query);

 				if($this->run) {

 					$data = mysqli_fetch_array($this->run);

 					return $data['title'];
 				}

 			}

 			// this method checks for the existance of quiz marks that marks is already uploaded or not 

 			public function quizMarksExistance($cId,$sem,$sec) {

 				$this->query = "SELECT * FROM marks WHERE c_id=$cId  AND mark_type='Quiz' AND std_sec='$sec' AND std_sem='$sem'";

 				$this->run = mysqli_query($this->conn,$this->query);

 				if($this->run) {

 					if(mysqli_num_rows($this->run) > 0) {
 						return true;
 					}

 						return false;
 				}
 			}

 	// this method checks for the existance of assignment marks that marks is already uploaded or not 

 	public function assignmentMarksExistance($cId,$sem,$sec) {

 		$this->query = "SELECT a_id,t_id,c_id,mark_type FROM marks WHERE c_id=$cId  AND mark_type='Assignment' AND std_sec='$sec' AND std_sem='$sem'";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			if(mysqli_num_rows($this->run) > 0) {
 				return true;
 			}

 			return false;
 		}
 	}
 	
 	// this method gets quiz , assignment number e.g. quiz 1... , assignment 1... etc

 	public function getNum($cId,$type,$sem,$sec) {

 		$this->query = "SELECT DISTINCT num,t_id,c_id FROM marks WHERE c_id=$cId AND mark_type='$type' AND std_sec='$sec' AND std_sem='$sem'";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return $this->run;
 		}
 	}

 	// this method fetch students marks from database

 	public function getMarks($cid,$sec,$sem) {

 	
 		$this->query = "SELECT DISTINCT * FROM internal_marks m , students s WHERE m.c_id=$cid AND s.semester='$sem' AND s.section='$sec' AND s.std_id=m.std_id";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return $this->run;
 		
 		} else {

 			echo "<script>alert('Internal Problem Occured ..')</script>";
 		}
 	}

 			public function getMarksBy($c,$sec,$sem,$type) {

 				$this->query = "SELECT  * FROM marks m, students s WHERE m.c_id=$c AND m.std_sec='$sec' AND m.mark_type='$type' AND m.std_sem='$sem' AND m.std_id=s.std_id ";
 				$this->run = mysqli_query($this->conn,$this->query);

 				if($this->run) {

 					return $this->run;
 				}

 			}	

 		}

 	//////////////// result manager class ////////////////////////
 	class resultManager extends databaseConnection {

 		private $query;
 		private $run;

 		public function getStudents($sec,$sem) {

 		$this->query = "SELECT * FROM students WHERE semester='$sem' AND section='$sec'";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			return $this->run;
 		}

 	}

 	public function is_DataAvailiableOnSec($cid,$sem,$sec) {

 		$atten = false;
 		$mark = false;
 		$result = false;

 		$this->query = "SELECT * FROM attendance WHERE c_id=$cid AND std_sem='$sem' AND std_sec='$sec'";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			if(mysqli_num_rows($this->run) < 1) {

 				$atten = true;
 			}
 		}

 		$this->query = "SELECT * FROM marks WHERE c_id=$cid AND std_sem='$sem' AND std_sec='$sec'";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			if(mysqli_num_rows($this->run) < 1) {

 				$mark = true;
 			}
 		}

 		$this->query = "SELECT * FROM result WHERE c_id=$cid AND std_sem='$sem' AND std_sec='$sec'";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			if(mysqli_num_rows($this->run) < 1) {

 				$result = true;
 			}
 		}

 		return $atten || $mark || $result;
 	}	

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

 	public function getNormalizeScore($max,$fscore) {

 		return ($fscore * 100) / $max;
 	}

 	// this method will return final term marks of a student

 	public function getFinalTerm($s,$c) {

 		$this->query = "SELECT final FROM internal_marks WHERE std_id=$s AND c_id=$c";
 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$f = mysqli_fetch_array($this->run) ;
 			return $f['final'];
 		}
 	}

 	// this method calculates sessional marks of particular student

 	public function getSessional($s,$c) {

 		$this->query = "SELECT q1,q2,q3,q4,q5,q6,a1,a2,a3,a4,a5,a6,participation,presentation FROM internal_marks WHERE std_id=$s AND c_id=$c";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$r = mysqli_fetch_array($this->run) ;

 			return $r['q1']+$r['q2']+$r['q3']+$r['q4']+$r['q5']+$r['q6']+$r['a1']+$r['a2']+$r['a3']+$r['a4']+$r['a5']+$r['a6']+$r['participation']+$r['presentation']+$this->getAttenMarks($s,$c);
 		}
 	}

 	public function getMidTerm($s,$c) {

 		$this->query = "SELECT mid FROM internal_marks WHERE std_id=$s AND c_id=$c";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$row = mysqli_fetch_array($this->run) ;

 			return $row['mid'];
 		}


 	}

 	// this method count teacher attended classes in terms of student attendance

 	public function calTeaClasses($c,$s) {

 		$this->query = "SELECT COUNT(attendance) FROM attendance WHERE c_id=$c AND std_id=$s ";

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

 	// this method count student attended classes in terms of presents and return the figure

 	public function calStdClasses($id) {

 		$this->query="SELECT COUNT(attendance) FROM attendance WHERE attendance='Present' AND std_id=$id";

 		$this->run = mysqli_query($this->conn,$this->query);

 		if($this->run) {

 			$data = mysqli_fetch_array($this->run);
 			return $data['COUNT(attendance)'];
 		}

 	}


 	public function getAttenMarks($s,$c) {

 			$cm = new courseManager();
 			$credit = $cm->getCourseCreditId($c);
 			$teaherClasses = $this->calTeaClasses($c,$s) * $credit;
 			$stdC = $this->calStdClasses($s) * $credit;
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
}

///////////////// 	User Accounts Manager //////////////////////////////

class userManager extends databaseConnection {

	private $query;
	private $run;

	public function getPendingAccounts() {

		$this->query = "SELECT DISTINCT * FROM students WHERE status='OFF'  GROUP BY std_id";

		$this->run = mysqli_query($this->conn,$this->query);

		if($this->run) {

			return $this->run;
		}

	}

	public function getTeaPendingAccounts() {

		$this->query = "SELECT DISTINCT * FROM teachers WHERE status='OFF' GROUP BY t_id";

		$this->run = mysqli_query($this->conn,$this->query);

		if($this->run) {

			return $this->run;
		}

	}
}

////////////////////// Complaint manager class //////////////////////////////////

class complaint extends databaseConnection {

	private $query;
	private $run;

	public function getComplaints() {

		$this->query = "SELECT * FROM complaint";
		$this->run = mysqli_query($this->conn,$this->query);

		if($this->run) {

			return $this->run;
		}
	}

	public function deleteComplaint($id) {

		$this->query = "DELETE FROM complaint WHERE id=$id";
		$this->run = mysqli_query($this->conn,$this->query);

		if($this->run) {

			echo "<script>alert('Complaint is successfully deleted ..')</script>";
			echo "<script>window.open('index.php?complaint','_self')</script>";
		
		} else {

			echo "<script>alert('Internal Problem Occured')</script>";	
		}
	}

	public function getComplaintOnId($id) {

		$this->query=  "SELECT * FROM complaint WHERE id=$id";
		$this->run = mysqli_query($this->conn,$this->query);

		if($this->run) {

			$data = mysqli_fetch_array($this->run);
			return $data;
		
		} else {

			echo "<script>alert('Internal Problem Occured')</script>";	
		}
	}
} 

//////////////////////// dataManager class ////////////////////////
class dataManager extends databaseConnection {

	private $query;
	private $run;

	public function getProfile() {

		$this->query = "SELECT * FROM admin";
		$this->run = mysqli_query($this->conn,$this->query);

		if($this->run) {

			$data = mysqli_fetch_array($this->run);
			return $data;
		
		} else {

			echo "<script>alert('Internal Problem Occured')</script>";	
		}

	}

	public function checkMarks($cid) {

		$this->query = "SELECT * FROM internal_marks WHERE c_id=$cid";
		$this->run = mysqli_query($this->conn,$this->query);

		if($this->run) {

			if(mysqli_num_rows($this->run) < 1) {

				return false;
			}

			return true;
		}
	}

	public function checkStuff($cid) {

		$marks = false;
		$attendance = false;

		$this->query = "SELECT * FROM internal_marks WHERE c_id=$cid";
		$this->run = mysqli_query($this->conn, $this->query);

		if($this->run) {

			if(mysqli_num_rows($this->run) < 1) {

				$marks = true;
			}
		}

		$this->query = "SELECT * FROM attendance WHERE c_id=$cid";
		$this->run = mysqli_query($this->conn, $this->query);

		if($this->run) {

			if(mysqli_num_rows($this->run) < 1) {

				$attendance = true;
			}
		}

		if($marks || $attendance) {

			return true;
		}
	}

	public function updateProfile(profile $p) {

		$user =  $p->getUser();
		$fname =  $p->getFname();
		$lname =  $p->getLname();
		$email =  $p->getEmail();
		$pass =  $p->getPass();

		if($pass == 7)
		$this->query = "UPDATE admin SET username='$user', fname='$fname', lname='$lname',  email='$email' WHERE id=1";
		else
			$this->query = "UPDATE admin SET username='$user', fname='$fname', lname='$lname',  email='$email', pass='$pass' WHERE id=1";

		$this->run = mysqli_query($this->conn,$this->query);

		if($this->run) {

			return true;
		}

		return false;
	}

}
 
  ?>