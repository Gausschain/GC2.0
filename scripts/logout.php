<?php 
	$expire = strtotime('-1 year');
	setcookie('email','',$expire);
	setcookie('pass','',$expire);
	unset($_COOKIE['email']);
	unset($_COOKIE['pass']);
	header('Location: ..');
	exit();
 ?>