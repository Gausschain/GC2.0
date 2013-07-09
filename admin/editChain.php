<?php
session_start();

if ($_SESSION['username']!='Gauss' and $_SESSION['username']!='admin')
{
	header("Location: login.php");
	die();
}

require '../scripts/database.php';

$chainID=$_GET['chainID'];
$query="SELECT * FROM chains WHERE chainID='$chainID'";
$result=pg_query($dbconn,$query);
$chain=pg_fetch_row($result);

if (isset($_POST['delete']))
{
	$number=$_GET['number'];
	$query="DELETE FROM problems WHERE chainID='$chainID' AND number='$number'";
	pg_query($dbconn,$query);

	$query="SELECT * FROM chains WHERE chainID='$chainID'";
	$result=pg_query($dbconn,$query);
	$chain=pg_fetch_row($result);
}

if (isset($_POST['approve']))
{
	$query="UPDATE chains SET islive='1' WHERE chainID='$chainID'";
	pg_query($dbconn,$query);
	header("Location: edit.php");
	die();
}

?>

<html>
<head>
<link rel='stylesheet' type ='text/css' href='../styles/dark.css' title='dark'>
</head>
<body>
<div class="area">
<h1><i>edit</i> <?php echo "$chain[1]"?></h1>

<?php
$query="SELECT * FROM problems WHERE chainID='$chainID' ORDER BY number ASC";
$result=pg_query($dbconn,$query);
$rows=pg_num_rows($result);

for ($j=0; $j<$rows; $j++)
{
	$problem=pg_fetch_row($result);
	
	echo <<<_END

	<form method="post" action="editChain.php?chainID=$chainID&number=$problem[1]">
	<input type="submit" name='delete' value='Delete'/>
	<a href="editProblem.php?chainID=$chainID&number=$problem[1]"> Problem $problem[1] : $problem[2]</a>
	</form>
	
_END;
}

echo <<<_END
	<form method="post" action="editChain.php?chainID=$chainID">
	<input type="submit" name='approve' value='Approve'/>
	</form>
_END;
?>
</div>
</body>
</html>
