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
	
	function dataReceive(){
		$course = $_POST["course"];
		$batch = $_POST["batch"];		
		$reg = $_POST["reg"];
			
		$conn = databaseConnection();
		$stdsl = "select std_sl sl from student_info where course_id = '$course' and batch= '$batch' and reg_no='$reg' ";
		$slno = mysqli_query($conn, $stdsl);
		while($row = mysqli_fetch_assoc($slno)) {
			$sl = $row['sl'] ;			
		}
		$tmsl = "select nvl(max(tmsl),0)+1 sl from testimonial_info ";
		$tm = mysqli_query($conn, $tmsl);
		while($row = mysqli_fetch_assoc($tm)) {
			$tmsl = $row['sl'] ;			
		}
		$marks = array($sl, $course, $batch, $reg , $tmsl);		
		return $marks;
	}
	function dataEntry($conn, $marks){
		$conn = databaseConnection();
		$sql = "INSERT INTO testimonial_info (std_sl, apply_date,tmsl)
		VALUES ('$marks[0]', '','$marks[4]')";
	
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	
	if (array_key_exists('submitBtn', $_POST)) {
		$marks = dataReceive();
		$conn = databaseConnection();
		dataEntry($conn, $marks);
		//dataView($conn);
		header("location: application.php");
	} else if (array_key_exists('exit', $_POST)) {
		header("location: home.php");
	}
	
?>
