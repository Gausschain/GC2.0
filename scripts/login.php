<?php

require 'database.php';

$username=$_POST['username'];
$password=$_POST['password'];

$query="SELECT * FROM accounts WHERE username='$username'";
$result=pg_query($dbconn,$query);
$account=pg_fetch_row($result);

if ($account[1]== $password)
	setcookie ( 'username', "$username", time()+3600*24, '/' );

header ("Location: ../index.php");
die();

?>

