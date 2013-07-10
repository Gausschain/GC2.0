<?php

require 'database.php';
require 'treatment.php';

$username=$_POST['username'];
$password=$_POST['password'];
$password=encode($password);

$query="SELECT * FROM accounts WHERE username='$username'";
$result=pg_query($dbconn,$query);
$account=pg_fetch_row($result);

if ($account[1]== $password)
{
	setcookie ( 'username', "$username", time()+3600*24, '/' );
	session_start();
	$_SESSION['username']=$username;
}

header ("Location: ../index.php");
die();

?>

