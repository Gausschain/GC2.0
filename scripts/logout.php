<?php 
	if (!isset($_COOKIE['username']))
		die();
	$username=$_COOKIE['username'];

	setcookie('username',$username, time()-24*3600, '/');
	session_start();
	$_SESSION['username']="";
	session_destroy();

	header("Location: ../index.php");
	die();
 ?>
