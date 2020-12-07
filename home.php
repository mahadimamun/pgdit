<?php
	// Initialize the session
	session_start();
	
	// Check if the user is logged in, if not then redirect him to login page
	
?>
<!Doctype HTML>
<html>
	<head>
		<title>Home</title>
		<link type="text/css" href="css/style.css" rel="stylesheet"></link>
		
	</head>

	<body>
		
		<header id="navBar" class="navBar">
			<span ><img id="logo" class="logo" src="logo.jpg"></img></span>
			<nav>
				<ul class="topNavBar">
					<li class="topNavBarlist"><a href="#">Students</a></li>
					<li class="topNavBarlist"><a href="">Faculty</a></li>
					<li class="topNavBarlist"><a href="">Forum</a></li>
					<li class="topNavBarlist"><a href="">Adminstration</a></li>
					<?php if(isset($_SESSION['myusername'])) { ?>
						<li class="topNavBarlist" ><a href="#"><?php echo $_SESSION['myusername']?></a><div class="sub-menu"><ul><a href="logout.php"<li>Sign Out</li></a><li style="margin: 15px;">Reset Password</li></ul></div></li>
					<?php } else { ?>
						<li class="topNavBarlist" ><a href="login.html">Sign In</a></li>
					<?php } ?>
				</ul>
			</nav>
		</header>
		<div>
			<div class="content-slider">
				<div class="slider">
					<div class="mask">
						<ul>
							<li class="anim1">
								<div class="quote"><img width="100%" height="280px" src="cornfield.jpg"></img></div>
								<div class="source">- Corn Field</div>
							</li>
							<li class="anim2">
								<div class="quote"><img width="100%" height="280px" src="field.jpg"></div>
								<div class="source">- Field</div>
							</li>
							<li class="anim3">
								<div class="quote"><img width="100%" height="280px" src="flower.jpg"></div>
								<div class="source">- Flower</div>
							</li>
							<li class="anim4">
								<div class="quote"><img width="100%" height="280px" src="cave.jpg"></div>
								<div class="source">- Hill</div>
							</li>
							<li class="anim5">
								<div class="quote"><img width="100%" height="280px" src="canal.jpg"></div>
								<div class="source">- River Side</div>
							</li>
							
						</ul>
					</div>
				</div>
			</div>
			<?php if (isset($_SESSION['myusername']) && $_SESSION['usertype']==="Student") { ?>
			<div id="menu" class="navigation-menu">	<?php echo 		
				"<ul>" ?>
					<li class=""><?php echo "My Profile" ?></li>
					<li class=""><a href="application.php"><?php echo "Apply Testimonial" ?></a></li>
					<li class=""><a href="testimonial.php"><?php echo "Print Testmonial" ?></a></li>
					<li class=""><?php echo "Notice" ?></li>
					<li class=""><?php echo "Contact Us" ?></li>							
				<?php echo "</ul>"	?>			
			</div> <?php }?>
			<?php if (isset($_SESSION['myusername']) && $_SESSION['usertype']==="Admin") { ?>
			<div id="menu" class="navigation-menu">	<?php echo 		
				"<ul>" ?>
					<li class=""><a href="marks.php"><?php echo "Marks Entry" ?></a></li>
					<li class=""><a href="receivedApplication.php"><?php echo "Applied Testimonial" ?></a></li>
					<li class=""><a href="approve.php"><?php echo "Approval Pending" ?></a></li>
					<li class=""><a href="distribute.php"><?php echo "Testimonial Distribution" ?></a></li>							
				<?php echo "</ul>"	?>			
			</div> <?php }?>
			
			
		</div>
		<div></div>
	</body>
</html>