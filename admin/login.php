<?php //for approving chains that are already submitted
session_start();
require '../scripts/database.php';
require '../scripts/treatment.php';

if (isset($_POST['login']))
{
	$query="SELECT * FROM accounts WHERE username='Gauss'";
	$result=pg_query($dbconn,$query);
	$gauss=pg_fetch_row($result);
	
	$query="SELECT * FROM accounts WHERE username='admin'";
	$result=pg_query($dbconn,$query);
	$admin=pg_fetch_row($result);

	$password=encode($_POST['password']);

	if ( ($_POST['username']=='Gauss' and $password==$gauss[1]) or ($_POST['username']=='admin' and $password==$admin[1]) )
	{
		session_start();
		$_SESSION['username']=$_POST['username'];

		header("Location: edit.php");
		die();
	
		
	}

}

echo <<<_END
<form method="post" action="login.php">
<input type="text" name='username'/> <br>	
<input type="password" name='password'/>
<input type="submit" name='login' value='Login'/>
</form>
_END;

?>
