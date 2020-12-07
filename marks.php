<?php
	// Initialize the session
	session_start();
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["myusername"]) && $_SESSION['usertype']==="Admin") {
		header("location: home.php");
		exit;
	}
?>
<html>
	<head>
		<title>Marks Entry</title>
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
			.container h2 {
				margin: 5px;
				padding: 5px;
				text-align: center;
			}
			.form-group {
				/*margin-bottom: 1em;*/
				transition:all .3s;
				transform: translateY(1.5em);				
				padding: 0;
				
			}
			.form-label {
				font-size: 1em;
				color: #000;
				display: inline-block;
				opacity: 1;
				transform: translateY(-2.2em);
				transform-origin: 0 0;
				transition: all .3s;
				padding: 5px;
				position: relative;
			}
			.form-control {
				box-shadow: none;				
				width: 90%;	
				border: none;
				transition: all .5s;		
				padding: 5px;
				margin: 0px 10px;	
				background: #d7e8d4;
			}
			.form-control::placeholder {
				color: transparent;
			}
			.form-control:focus {
				box-shadow: none;
				outline: none;				
			}
			.item-container {
				border: 1px solid gray;
				padding: 0px;
				position: relative;
				margin: 5px;
			}
			.form-control:focus + .form-label,
			.form-control:not(:placeholder-shown) + .form-label {
				transform: translateY(-3em) scale(.8);
				color: #000;
				font-weight: bold;
				font-size: 1em;
			}
			.item-container:focus-within {
				border: 1px solid blue;
			}
			.container form {			
				display: flex;
			}
			.btn {
				margin: 5px;  
				width: 100px; 
				height: 30px; 
				text-align: center;
				postion: relative;
				font-weight: bold;
				box-shadow: none;
				border-shadow: none;
			}
			.submit-button {
				background: #e0e0ec; 
				float: left;
			}
			.reset-button {
				position: absolute;
				left: 50%;
				transform: translateX(-50%);
				color: #000;
			}
			.exit-button {
				background: #ec3333; 
				float: right;
				color: #fff;
			}
			.submit-button[type="submit"]:focus, .exit-button[type="submit"]:focus {
				 padding: 0; 
				 margin: 0;
				 color: #fff;
				 border: none;
				 background: red;
				 outline: none;
				 cursor: pointer;
				 
			}
			.submit-button:hover, .exit-button:hover {
				 color: #fff;
				 font-weight: bold;
				 background: #46a545;
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
				margin-top: 50px;
			}			
		</style>
		<script>
			var name;
			function loadData(a,b,c) {
				jQuery.ajax(
					{	type: "POST",
						url : "myPhpFunction.php",
						dataType: 'json',
						data: {functionname: 'displayData', arguments: [a, b, c]},
						success: function (obj, textstatus) {
							if (!('error' in obj)) {
								name = obj.name;
							}
						}
					}
				)
			}
			function addEvent() {
				var course = document.getElementById("course").value;
				var batch = document.getElementById("batch").value;
				var reg = document.getElementById("reg").value;
				
				if (course == 'Undefined' && batch == 'Undefined' && reg == 'Undefined') {
					null;
				} else {
					loadData(course,batch,reg);
				}
			}
		</script>
		<script>
			$(document).ready(function(){
				function submitMe(selector) {
					$.ajax({
						type: "POST",
						url: "myPhpFunction.php",
						data: {text:$(selector).val()}
					});
				}
				$('#batch').onchange(function(evt){
					//if ((evt.keyCode) &&(evt.keyCode == 13))
					{
					submitMe('#batch');
					submitMe('#course');
					evt.preventDefault();
					return false;
					}
				});
			};
		</script>
	</head>
	<body>
		<div >	
			<div style="visibility: hidden;position: relative;z-index:1000; float: right; right: 20px; width: 350px; height:100px; background: green; text-align: center;">
				<span style="left: 50px;margin: 0; width: 250px; font-size: 20px; color:#fff; top: 50%; position: absolute; transform: translateY(-50%)">Data saved successfully.</span>
			</div>
			<form id="formPage" method="POST" action="marksEntry.php">
				<div id="container" class="container" style="float: left;">
					<h2>Student Information</h2>
					<div id="form" class="form"  style="display: inline-block;">
						<div style=" margin: 5px; float: left; width: 33%;">
							<div class="item-container">
								<div class="form-group">
									<select class="form-control" id="course" name="course" >
										<option value="">Select Course</option>
										<?php $connection = mysqli_connect('localhost','root','','pgdit');
											$query = "select concat(course_name, '(',course_synonym,')') course,course_id id from course_list";
											$result = mysqli_query($connection,$query);
											while($row = mysqli_fetch_assoc($result)) {
												echo "<option value='". $row['id'] ."'>" . $row['course'] ."</option>" ;			
											}
										?>	
									</select>
									<label for="course" class="form-label">Course</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<select class="form-control" id="batch" name="batch" >
										<option value="">Select Batch</option>
										<?php $connection = mysqli_connect('localhost','root','','pgdit');
											$query = "select batch_id id from batch_info";
											$result = mysqli_query($connection,$query);
											while($row = mysqli_fetch_assoc($result)) {
												echo "<option value='". $row['id'] ."'>" . $row['id'] ."</option>" ;			
											}
										?>	
									</select>	
									<label for="batch" class="form-label">Batch</label>						
								</div>					
							</div>
						</div>
						<div style="margin: 5px; float: left; width: 33%;">
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="reg" name="reg" placeholder="Course Name" >	
									<label for="reg" class="form-label">Registration No.</label>
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="session" name="session" placeholder="Course Name" readonly>	
									<label for="session" class="form-label">Session</label>						
								</div>					
							</div>
						</div>
						<div style="margin: 5px; float: left; width: 27%;">
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="roll" name="roll" placeholder="Course Name" readonly>	
									<label for="roll" class="form-label">Roll No.</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="stdname" name="stdname" placeholder="Course Name" readonly>	
									<label for="stdName" class="form-label">Student Name</label>						
								</div>					
							</div>
						</div>
					</div>
				</div>
				<div id="container" class="container" style="float: left;">
					<h4 style="padding: 0; margin: 0">Marks Entry</h4>
					<div id="form1" class="form">					
						<div style=" margin: 5px;">
							<div class="item-container" style="float: left; width: 30%">
								<div class="form-group">
									<select class="form-control" id="subjectid" name="subjectid" >
										<option value="">Select Subject</option>
										<?php $connection = mysqli_connect('localhost','root','','pgdit');
											$query = "SELECT subject_name,subject_code FROM subject_list where course_id = 1";
											$result = mysqli_query($connection,$query);
											while($row = mysqli_fetch_assoc($result)) {
												echo "<option value='". $row['subject_code'] ."'>" . $row['subject_name'] ."</option>" ;			
											}
										?>
									</select>
									<label for="subjectid" class="form-label">Subject</label>						
								</div>					
							</div>
							<div class="item-container" style="float: left; width: 63%">
								<div class="form-group">
									<input type="text" class="form-control" id="subjectName" placeholder="subjectName">	
									<label for="subjectName" class="form-label">Subject</label>						
								</div>					
							</div>
						</div>
					</div>
					<div id="form2" class="form" style="display: inline-block;">					
						<div style=" margin: 5px; float: left;">
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="attendance" name="attendance" placeholder="attendance">	
									<label for="attendance" class="form-label">Attendance</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="classTest" name="classTest" placeholder="Class test">	
									<label for="classTest" class="form-label">Class Test</label>						
								</div>					
							</div>
						</div>
						<div style="margin: 5px; float: left;">
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="lab" name="lab" placeholder="lab">	
									<label for="lab" class="form-label">Lab Test</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="midTerm" name="midTerm" placeholder="mid term">	
									<label for="midTerm" class="form-label">Mid Term</label>						
								</div>					
							</div>
						</div>
						<div style="margin: 5px; float: left;">
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="final" name="final" placeholder="final score">	
									<label for="final" class="form-label">Final</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="total" name="total" placeholder="total" readonly>	
									<label for="total" class="form-label">Total Number</label>						
								</div>					
							</div>
						</div>
					</div>
				</div>
				<div id="btnContainer" class="btn-container">
					<a><input type="submit" id=btn-submit" name="submitBtn" value="Submit" class="btn submit-button"></input></a>
					<a href="home.php"><input type="submit" id=btn-exit" name="exit" value="Exit" class="btn exit-button"></input></a>
				</div>			
			</form>
			
			<!--<input type="text" value="Yes"  name="insert"></input> -->
		</div>
	</body>
</html>