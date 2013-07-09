<?php
session_start();

if ($_SESSION['username']!='Gauss' and $_SESSION['username']!='admin')
{
	header("Location: login.php");
	die();
}

require '../scripts/database.php';

$query="SELECT * FROM chains WHERE submitted='1' AND islive='0'";
$result=pg_query($dbconn,$query);
$rows=pg_num_rows($result);


for ($j=0; $j<$rows; $j++)
{
	$chain=pg_fetch_row($result);
	$chainID=$chain[0];
	
	echo <<<_END
<a href="editChain.php?chainID=$chainID"> $chain[1] </a> <br>
_END;

}

?>

