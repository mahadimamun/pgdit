<?php
	// Initialize the session
	session_start();
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["myusername"])){
		header("location: home.php");
		exit;
	}
?>
<!doctype HTML>
<html>
	<head>
		<title>Apply for testimonial</title>
		
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
			cursor: pointer;
		}
		.reset-button {
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
			color: #000;
			cursor: pointer;
		}
		.exit-button {
			background: #ec3333; 
			float: right;
			color: #fff;
			cursor: pointer;
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
			box-sizing: border-box;
			width: 100%; 
			padding: 10px; 
			background: #041a27;
			float: left; 
			position: relative; 
			margin-top: 50px;
			
		}
		
		</style>
	</head>
	<body>
		<div style="display: block; ">
			<form  id="form" class="form" method="POST" action="submitApplication.php">
				<div id="container" class="container" style="float: left;">
					<h2>Testimonial Application Form</h2>
				
					<div>
						<div style=" width: 45%; margin: 5px; float: left;">
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
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="reg" name="reg" placeholder="Course Name">	
									<label for="reg" class="form-label">Registration No.</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="roll" placeholder="Course Name" readonly>	
									<label for="roll" class="form-label">Roll No.</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="session" placeholder="Course Name" readonly>	
									<label for="session" class="form-label">Session</label>						
								</div>					
							</div>
						</div>
						<div style=" position: absolute; width: 45%; right: 50px; margin: 5px; float: left;">
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="stdname" placeholder="Course Name" readonly>	
									<label for="stdName" class="form-label">Student Name</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="fName" placeholder="Course Name" readonly>	
									<label for="fName" class="form-label">Father Name</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="mName" placeholder="Course Name" readonly>	
									<label for="mName" class="form-label">Mother Name</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="marks" placeholder="Marks" readonly>	
									<label for="marks" class="form-label">Total Marks</label>						
								</div>					
							</div>
							<div class="item-container">
								<div class="form-group">
									<input type="text" class="form-control" id="grade" placeholder="Course Name" readonly>	
									<label for="grade" class="form-label">Letter Grade</label>						
								</div>					
							</div>
						</div>
					</div>
					<div id="btnContainer" class="btn-container">
						<input type="submit" id=btn-submit" name="submitBtn" value="Submit" class="btn submit-button"></input>
						<input type="submit" id=btn-clear" name="clear" value="Reset" class="btn reset-button"></input>
						<input type="submit" id=btn-exit" name="exit" value="Exit" class="btn exit-button"></input>
					</div>				
				</div>	
			</form>			
		</div>		
	</body>
</html>
