<?php 
	if (!isset($_COOKIE['username']))
		die();
	$username=$_COOKIE['username'];

	setcookie('username',$username, time()-24*3600, '/');

	header("Location: ../index.php");
	die();
 ?>
