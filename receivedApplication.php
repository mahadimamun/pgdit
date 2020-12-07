<?php
	// Initialize the session
	session_start();
	// Check if the user is logged in, if not then redirect him to login page
	/*if(!isset($_SESSION["myusername"])){
		header("location: home.php");
		exit;
	}*/
?>
<html>
	<head>
		<style>
			body {
				background: #f1f6fa;
				margin: 0;
				padding: 0;
			}
			.container {
				width: 65vw;
				padding: 2em;
				background: #d7e8d4;
				border-radius: 0;
				top: 10%;
				left: 50%;
				position: relative;
				transform: translate(-50%, 10%);
				box-sizing: border-box;	
				margin-bottom: 10px;
			}
			.container h1 {
				margin: 5px;
				padding: 5px;
				text-align: center;
			}
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;				
			}
			th, td {
				padding: 8px 15px;				
			}
			.modal {
				display: none;
				position: fixed;
				z-index: 1;
				top: 0;
				left: 0;				
				width: 100%;
				height: 100%;
				overflow: auto;
				background-color: #fff;
				background-color: rgba(0,0,0,0.4)
			}
			.modal-content {
				background-color: #fefefe;
				padding: 20px;
				border: 1px solid #888;
				width: 80%;
				top: 50%;
				left: 50%;
				transform: translate(10%, 20%);
			}
			.close {
				color: #aaaaaa;
				float: right;
				font-size: 25px;
				font-weight: bold;
			}
			.close:hover, .close:focus {
				color: #000;
				text-decoration: none;
				cursor: pointer;
			}
			.btn-container {
				left: 50%;
				transform: translateX(-50%);
				box-sizing: border-box;
				width: 65vw; 
				padding: 10px; 
				background: #e0def2;
				float: left; 
				position: relative; 
				margin-top: 100px;
			}	
			input {
				border: none;
				outline: none;
				width:40px;
			}
			#btn {
				text-decoration: none;
				height: 30px;
				padding: 5px 10px;
				background: #2bb575;
				color:#fff;
				font-weight: bold;
			}
		</style>
		<script>
			var btn = document.getElementById("displaybtn");
			var span = document.getElementsByClassName("close")[0];
			function loadModal() {
				var modal = document.getElementById("mymodal");
				modal.style.display = "block";
				var id = event.target.id;
				var itm = document.getElementById("stdid");
				itm.innerHTML = id;
			}
			function closeModal() {
				var modal = document.getElementById("mymodal");
				modal.style.display = "none";
				
			}
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
			function setStudentId() {
				var id = event.target.id;
				var item = documnet.getElementById("stdid");
				alert(id);
			}
		</script>
	</head>
	<body>
		<div id="container" class="container">
			<h1>Student List of applied for Testimonial</h3>
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "pgdit";
				$tbl_name="user_info"; // Table name 

				// Create connection
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				
				$stmt = "SELECT s.std_sl,first_name,last_name ,reg_no,academic_session ,course_synonym,apply_date from student_info s, course_list c, testimonial_info t where s.course_id = c.course_id and s.std_sl = t.std_sl";
				$result = mysqli_query($conn, $stmt);
				echo "<table style='width: 100%;'><tr><thead><th>Student Name</th><th>Course</th><th>Registration No.</th><th>Session</th><th>Apply Date</th><th></th>";
				while($row = mysqli_fetch_assoc($result)) {
					$name = $row['first_name'] . $row['last_name'] ;	
					$regno = $row['reg_no'] ;
					$session = $row['academic_session'] ;
					$course = $row['course_synonym'] ;
					$apdt = $row['apply_date'] ;
					$sl = $row['std_sl'];
					echo "<tr><td>" .$name."</td><td>" .$course."</td><td>" . $regno ."</td><td>" . $session ."</td><td>" . $apdt ."</td><td><button type='submit' id= $sl onclick='loadModal()'>Show Details</button></td>";
				}
				echo "</table>";
			?>
		</div>
		<div id="" class="btn-container"><a href="home.php"><input type="submit" id="exit" value="Exit" style="border:none;outline:none;cursor:pointer;float:right;height:30px;width:100px;background:red;color:#fff;font-weight:bold;"></input></a></div>
		<div id="mymodal" class="modal">
			<div class="modal-content">
				<span class="close" onclick="closeModal()">&times;</span>
				<div style="display: grid; grid-template-columns: 1fr 1fr 1fr; margin: 20px;">
					<div>
						<table>
							<tr><td>Student Name</td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>Course</td><td><input type="text" id="course" readonly></input></td></tr>
							<tr><td>Batch</td><td><input type="text" id="batch" readonly></input></td></tr>
							<tr><td>Registration No.</td><td><input type="text" id="reg" readonly></input></td></tr>						
						</table>
					</div>
					<div>
						<table>
							<tr><td>Student Name</td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>Course</td><td><input type="text" id="course" readonly></input></td></tr>
							<tr><td>Batch</td><td><input type="text" id="batch" readonly></input></td></tr>
							<tr><td>Registration No.</td><td><input type="text" id="reg" readonly></input></td></tr>						
						</table>
					</div>
					<div>
						<table>
							<tr><td>Student Name</td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>Course</td><td><input type="text" id="course" readonly></input></td></tr>
							<tr><td>Batch</td><td><input type="text" id="batch" readonly></input></td></tr>
							<tr><td>Registration No.</td><td><input type="text" id="reg" readonly></input></td></tr>						
						</table>
					</div>
				</div>
				<div style="display: grid; grid-template-columns: 1fr 1fr 1fr;">
					<div>
						<table>
							<tr><td colspan=3; style="text-align:center;">1<sup>st</sup> Semister</td></tr>
							<tr style="text-align:center;"><td>Subject</td><td>Marks</td><td>Grade</td></tr>
							<tr><td>Software Engineering</td><td style="width:40px;"><input type="text" id="stdnm" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>Computer Basic</td><td><input type="text" id="course" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>Data Communication & Networking</td><td><input type="text" id="batch" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>C Programming</td><td><input type="text" id="reg" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>						
						</table>
					</div>
					<div>
						<table>
							<tr><td colspan=3; style="text-align:center;">2<sup>nd</sup> Semister</td></tr>
							<tr style="text-align:center;"><td>Subject</td><td>Marks</td><td>Grade</td></tr>
							<tr><td>Internet Programming</td><td><input type="text" id="stdnm" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>Object Oriented Programming</td><td><input type="text" id="course" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>DBMS & XML</td><td><input type="text" id="batch" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>Data Structure </td><td><input type="text" id="reg" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>						
						</table>
					</div>
					<div>
						<table>
							<tr><td colspan=3; style="text-align:center;">3<sup>rd</sup> Semister</td></tr>
							<tr style="text-align:center;"><td>Subject</td><td>Marks</td><td>Grade</td></tr>
							<tr><td>Operating System Management</td><td><input type="text" id="stdnm" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>Mobile Application </td><td><input type="text" id="course" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>Project</td><td><input type="text" id="batch" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>
							<tr><td>Machine language</td><td><input type="text" id="reg" readonly></input></td><td><input type="text" id="stdnm" readonly></input></td></tr>						
						</table>
					</div>
				</div>
				<div style="margin:20px;"><a id="btn" href="home.php">Testmonial Issue</a></div>
			</div>
			
		</div>
	</body>
</html>