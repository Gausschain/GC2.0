<?php 
require 'database.php';
$comment=$_POST['comment'];
$email=$_COOKIE['email'];
if(!$email) {
	$email='guest';
}
$thread=$_POST['title'];
$timestamp=time();
$query="INSERT INTO forum VALUES
			('0','$thread','$comment','$email',$timestamp)";
	pg_query($dbconn,$query);
	header('Location: ../index.php?page=thread&thread='.$thread);
	exit();
?>