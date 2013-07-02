<?php
	$email=$_GET['email'];
	$pass=$_GET['password'];
	$name1='email';
	$name2='pass';
	$name3='num_solved';
	$query="SELECT num_solved FROM accounts
			WHERE username='$email' AND password='$pass'";
	$ns=pg_query($dbconn,$query);//$db->query($query);
	$numsolved=pg_fetch_array($ns);//$ns->fetch();
	setcookie($name1,$email,0,'/');
	setcookie($name2,$pass,0,'/');
	setcookie($name3,$numsolved[0],0,'/');
	echo $numsolved[0];
	echo $_COOKIE['email'];
	header('Location: ..');
	exit(); 
?>