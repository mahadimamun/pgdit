<?php
	function databaseConnection(){		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pgdit";
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if (!$conn) {
			echo "Connection failed: " . mysqli_connect_error();
			return null;
		}		
		return $conn;
	}
	$conn = databaseConnection();
	function dataReceive(){
		$course = $_POST["course"];
		$batch = $_POST["batch"];		
		$reg = $_POST["reg"];
		$session = $_POST["session"];    
		$roll = $_POST["roll"];
		$subjectid = $_POST["subjectid"];
		$attendance = (double)$_POST["attendance"];
		$classTest = (double)$_POST["classTest"];	
		$lab = (double)$_POST["lab"];
		$midTerm = (double)$_POST["midTerm"];
		$final = (double)$_POST["final"];		
		$total =  $attendance + $classTest + $lab + $midTerm + $final;
		$stdsl = "select std_sl sl from student_info where course_id = '$course' and batch= '$batch' and reg_no='$reg' ";
		$conn = databaseConnection();
		$slno = mysqli_query($conn, $stdsl);
		while($row = mysqli_fetch_assoc($slno)) {
			$id = $row['sl'] ;			
		}
		$marks = array($id, $course, $batch, $reg , $session, $roll, $subjectid, $attendance, $classTest, $lab, $midTerm, $final, $total);		
		return $marks;
	}
	function dataEntry($conn, $marks){
		$sql = "INSERT INTO result_details (std_sl, subject_id, attendance, class_test, lab, mid, final)
		VALUES ('$marks[0]', '$marks[6]', '$marks[7]','$marks[8]', '$marks[9]', '$marks[10]', '$marks[11]')";
		$_SESSION['insert'] = "Yes";
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	function dataView($conn){
		$sql = "SELECT * FROM result_details";
		$result = mysqli_query($conn, $sql);
		
		echo "<table border='1'>";
		echo "<tr>";
		echo "<th>Roll</th><th>Total</th>";
		echo "</tr>";
		
		if (mysqli_num_rows($result) > 0) {
		// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . $row['roll'] . "</td>";
				echo "<td>" . $row['final']  + $row['lab'] + $row['class_test'] + $row['mid'] + $row['attendance'] + $row['quiz'] . "</td>";
				echo "</tr>";
			}
		} else {
			echo "0 results";
		}

	}
	
	if (array_key_exists('submitBtn', $_POST)) {
		$marks = dataReceive();
		//$conn = databaseConnection();
		dataEntry($conn, $marks);
		//dataView($conn);
		header("location: marks.php");
	} else {
		header("location: home.php");
	}
	if ($conn != null)
		mysqli_close($conn);
	
	
?>
