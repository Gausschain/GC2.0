<?php
$username=$_SESSION['username'];

$chainID=$_GET['chainID'];
$number=$_GET['number'];

$query="SELECT * FROM chains WHERE chainID='$chainID'";
$result=pg_query($dbconn,$query);
$chain=pg_fetch_row($result);
$author=$chain[4];

$query="SELECT * FROM accounts WHERE username='$username'";
$result=pg_query($dbconn,$query);
$account=pg_fetch_row($result);

$query="SELECT * FROM problems WHERE chainID='$chainID' AND number='$number'";
$result=pg_query($dbconn,$query);
$problem=pg_fetch_row($result);
$solution=$problem[5];

if (isset($_POST['answer']))
{
	$answer=$_POST['answer'];

	if ($answer==$problem[5])
		$url="scripts/new_solve.php?username=$username&chainID=$chainID&number=$number";
	
	else
		$url="index.php?page=incorrect&chainID=$chainID&number=$number";

	header("Location: $url");
	die();
}




echo "<div class='area'>";
echo "<h1>$chain[1] $number :: <color4>$problem[2]</color4>";

if ($problem[3] != "")
{
	echo <<<_END
	<div class="problem">
	$problem[3]
	</div>
_END;
}
?>


	<div class="problem">
	<?php echo $problem[4]; ?>
	</div>

<?php

$query="SELECT chain" . $chainID . " FROM accounts WHERE username='" . $username . "'";
$result=pg_query($dbconn,$query);
$row=pg_fetch_row($result);
$string=$row[0];

$binary=substr($string,$number-1,1);


if (!$username or $username=="");
else if ($username==$author or $binary>0)
	echo "Solution: $solution";


else
{ 

echo <<<_END
<p style="text-align: center;">
<form method="post" action="index.php?page=problem&chainID=$chainID&number=$number">
<input type="text" name="answer" size="6" maxlength="20"/>
<input type="submit" name='submit' value='answer'/>
</form>
</p>
_END;
}


?>


</div>
