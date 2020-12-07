<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pgdit";
	$tbl_name="user_info"; // Table name 

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		echo "Database Connection failed ";
        echo '<a href="main_login.php"><button>back</button></a>';
	}
	// username and password sent from form 
	$myusername=$_POST['userid']; 
	$mypassword=$_POST['password']; 

	// To protect MySQL injection (more detail about MySQL injection)
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);

	$myusername = mysqli_real_escape_string($conn, $myusername);
	$mypassword = mysqli_real_escape_string($conn, $mypassword);

	$sql="SELECT * FROM $tbl_name WHERE user_name='$myusername' and passwd='$mypassword'";

	$result=mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
			$usertype = $row['user_type'] ;			
	}
	// Mysql_num_row is counting table row
	$count=mysqli_num_rows($result);
	echo $count;
	
	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1){

        // Register $myusername, $mypassword and redirect to file "login_success.php"
        session_start();
        $_SESSION['myusername'] = $myusername;
        $_SESSION['mypassword'] = $mypassword;
		$_SESSION['usertype'] = $usertype;
		header("location: home.php");
	}
	else {
		echo $_SESSION['myusername']= $myusername;
        echo "<h1> Wrong username and password </h1>";
        //echo '<a href="main_login.php"><button>back</button></a>';
	}
?>