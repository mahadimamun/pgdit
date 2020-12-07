<?php
	session_start();
	unset($_SESSION["id"]);
	unset($_SESSION["myusername"]);
	header("Location:home.php");
?>