<?php 
	
	require 'database.php';
	// require 'email.php';
	$email=$_POST['email'];
	$pass=$_POST['password'];
	if($pass!=$_POST['rpassword']) {
		echo "<p style='font-size: 24px'>You made a mistake, goofer!</p>";
	}
	
	$query="SELECT username FROM accounts";
	$arr=pg_query($dbconn,$query);//$db->query($query);
	foreach($arr as $e) {
		if($e[0]==$email) {
			echo "THAT NAME IS TAKEN!";
			exit();
		}
	}
	
	$exec="INSERT INTO accounts (email,password,num_solved)
		   VALUES ('$email','$pass',0)";
	$accs=pg_query($dbconn,$exec);//$db->exec($exec);
	$name1='email';
	$name2='pass';
	$name3='num_solved';
	setcookie($name1,$email,0,'../');
	setcookie($name2,$pass,0,'../');
	setcookie($name3,0,0,'../');
	$message="Thank you for registering for GaussChains!";
	//sendmaile($email,'GaussChains',$message);
	header('Location: ..');
	end();
?>
