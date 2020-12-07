<html>
<head>
<title> PGD107 Result </title>
</head>
<body>

<?php

function dataReceive(){

    $roll = $_POST["roll"];
    $name = $_POST["name"];
    
    $attend = (double)$_POST["attend"];
    $ct = (double)$_POST["class_test"];    
    $lab = (double)$_POST["lab"];
    $quiz = (double)$_POST["quiz"];
    $mid = (double)$_POST["mid"];
    $final = (double)$_POST["final"];
    
    $total =  $attend + $ct + $lab + $quiz + $mid + $final;
    
    $marks = array($roll, $name, $attend , $ct, $lab, $quiz, $mid, $final, $total);
    
    return $marks;
}

function printMarks($marks){
    echo "<h3>". $marks[1] . " Marks </h3> <br />";
    
    echo "Attend: " . $marks[2] . "<br>";
    echo "Class Test: " . $marks[3] . "<br>"; 
    echo "Final: " . $marks[7] . "<br>"; 
    
    echo "Total: " . $marks[8];
 }
 
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


function dataEntry($conn, $marks){
	
	$grade = 3.5;
	$lg = "A";
	$sql = "INSERT INTO result_details (roll, reg_no,course_id, attendance, class_test, lab, quiz, mid, final)
	VALUES ('$marks[0]',0,0, '$marks[1]', '$marks[2]','$marks[3]', '$marks[4]', '$marks[5]', '$marks[6]')";
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


$marks = dataReceive();
printMarks($marks);

$conn = databaseConnection();
dataEntry($conn, $marks);

dataView($conn);


if ($conn != null)
	mysqli_close($conn);
	
?>

</body>
</html>
