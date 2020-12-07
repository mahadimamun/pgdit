
<?php
	if (array_key_exists('exitBtn', $_POST)) {
		header("location: login.html");
	} else {
		function dataReceive(){		
			$roll     =  $_POST["roll"];
			$regNo    =  $_POST["regNo"];
			$courseid =  $_POST["course"];
			$batch    =  $_POST["batch"];
			$fname    =  $_POST["fName"];
			$lname    =  $_POST["lName"];
			$faname   =  $_POST["faName"];
			$moname   =  $_POST["moName"];
			$padd     =  $_POST["preAddress"];
			$add      =  $_POST["address"];
			$dob      =  $_POST["dob"];
			$religion =  $_POST["religion"];
			$gender   =  $_POST["gender"];
			$nid      =  $_POST["nid"];
			$emailId  =  $_POST["emailId"];
			$mobile   =  $_POST["mobile"];	
			$upload   =  $_POST["upload"];
			$userid   =  $_POST["userid"];
			$password =  $_POST["password"];
			
			$userInfo = array($roll, $regNo, $courseid, $batch, $fname, $lname, $faname, $moname, $padd, $add, $dob, $religion, $gender, $nid, $emailId, $mobile, $upload, $userid, $password);
			
			return $userInfo;
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
		function dataEntryStudent($conn, $userInfo){
			$stdsl = "select nvl(max(std_sl),0)+1 sl from student_info";
			$slno = mysqli_query($conn, $stdsl);
			while($row = mysqli_fetch_assoc($slno)) {
				$id = $row['sl'] ;			
			}
			$sql = "insert into student_info (std_sl,std_roll,reg_no,course_id,batch,first_name,last_name,father_name,mother_name,present_address,permanent_address,dob,religion,sex,nid,emailid,contact_no,image)
			values($id,'$userInfo[0]','$userInfo[1]','$userInfo[2]','$userInfo[3]','$userInfo[4]','$userInfo[5]','$userInfo[6]','$userInfo[7]','$userInfo[8]','$userInfo[9]','$userInfo[10]','$userInfo[11]','$userInfo[12]','$userInfo[13]','$userInfo[14]','$userInfo[15]','$userInfo[16]')";		
			if (mysqli_query($conn, $sql)) {
				echo 'Data saved successfully. Please sign in to continue.<a href="login.html"><b>Sign In</b></a>';
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		function dataEntry($conn, $userInfo){
			$sl = "select nvl(max(sl_no),0)+1 sl from user_info";
			$slno = mysqli_query($conn, $sl);
			while($row = mysqli_fetch_assoc($slno)) {
				$id = $row['sl'] ;			
			}
			$sql = "INSERT INTO user_info (sl_no, user_name,passwd)
			VALUES ($id,'$userInfo[17]','$userInfo[18]','Student')";
			
			if (mysqli_query($conn, $sql)) {
				echo 'Data saved successfully. Please sign in to continue.<a href="login.html"><b>Sign In</b></a>';
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		$userInfo = dataReceive();
		$conn = databaseConnection();
		
		dataEntry($conn, $userInfo);
		dataEntryStudent($conn, $userInfo);
		//header("location: login.html");
	}
?>
