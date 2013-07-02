<?php 
	require 'database.php';
	$comment=$_POST['comment'];
	$email=$_COOKIE['email'];
	$thread=$_GET['thread'];

	$query="SELECT * from forum WHERE thread='$thread'";
	$res=pg_query($dbconn,$query);
	$id=pg_num_rows($res);
	$time=time();
	$query="INSERT INTO forum VALUES
			('$id','$thread','$comment','$email','$time')";
	pg_query($dbconn,$query);

	header("Location: ../index.php?page=thread&thread=".$thread);
	exit();
?>