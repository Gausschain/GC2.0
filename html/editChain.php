<?php

if ( (! $_COOKIE['username']) or $_COOKIE['username']=="")
	die ("You must be logged on to build a chain.");
$username=$_COOKIE['username'];

$chainID=$_GET['chainID'];
$query="SELECT * FROM chains WHERE chainID='$chainID'";
$result=pg_query($dbconn,$query);
$chain=pg_fetch_row($result);

if ($chain[4]!=$username)
	die("You are not authorized to edit this chain.");

if (isset($_POST['delete']))
{
	$number=$_GET['number'];
	$query="DELETE FROM problems WHERE chainID='$chainID' AND number='$number'";
	pg_query($dbconn,$query);

	$query="SELECT * FROM chains WHERE chainID='$chainID'";
	$result=pg_query($dbconn,$query);
	$chain=pg_fetch_row($result);
}


if (isset($_POST['submitChain']))
{
	$query="UPDATE chains SET submitted='1' WHERE chainID='$chainID'";
	pg_query($dbconn,$query);

	$query="SELECT * FROM chains WHERE chainID='$chainID'";
	$result=pg_query($dbconn,$query);
	$chain=pg_fetch_row($result);
}

?>

<div class="area">
<h1><i>edit</i> <?php echo "$chain[1]"?></h1>

<?php 
if ($chain[7]==0)
{
	echo <<<_END
	<a href="?page=newProblem&chainID=$chainID"> <span style="font-size: 20px"><color2> NEW PROBLEM </color2> </span></a>
	<br/><br/>
_END;
}
?>

<?php 
$query="SELECT * FROM problems WHERE chainID='$chainID' ORDER BY number ASC";
$result=pg_query($dbconn,$query);
$rows=pg_num_rows($result);


for ($j=0; $j < $rows; $j++)
{
	$problem=pg_fetch_row($result);
	if ($chain[7]==0) //if it hasn't been submitted yet
{
	echo <<<_END
	<form method="post" action="index.php?page=editChain&chainID=$chainID&number=$problem[1]">
		<input type="submit" name='delete' value='Delete'/>
		<a href="index.php?page=editProblem&chainID=$chainID&number=$problem[1]">Problem $problem[1] : $problem[2]</a>
	</form>
	<br/>
_END;
}
	else
{
	echo <<<_END
	<a href="index.php?page=editProblem&chainID=$chainID&number=$problem[1]">Problem $problem[1] : $problem[2]</a>
	<br/><br/>
_END;
}
}
?>

<?php
if ($chain[7])
{
	echo <<<_END
<span style="font-size: 20px"><color2>Thank you for submitting this chain.  We will look it over as soon as we can, and hopefully you will see it in the Solve section within a few days!</color2></span>
_END;
}
else
{
	echo <<<_END

<form method="post" action="index.php?page=editChain&chainID=$chainID">
	<input type="submit" name='submitChain' value='Submit Chain'/>
</form>
_END;
}
?>

</div>


