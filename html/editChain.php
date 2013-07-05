<?php
$chainID=$_GET['chainID'];
$query="SELECT * FROM chains WHERE chainID='$chainID'";
$result=pg_query($dbconn,$query);
$chain=pg_fetch_row($result);

if (isset($_POST['submitChain']))
{
	$query="UPDATE chains SET submitted='1' WHERE chainID='$chainID'";
	pg_query($dbconn,$query);
}

?>

<div class="area">
<h1><i>edit</i> <?php echo "$chain[1]"?></h1>

<?php echo <<<_END
<a href="?page=newProblem&chainID=$chainID"> <span style="font-size: 20px"> NEW PROBLEM </span></a>
<br/><br/>
_END;
?>

<?php 
$query="SELECT * FROM problems WHERE chainID='$chainID' ORDER BY number ASC";
$result=pg_query($dbconn,$query);
$rows=pg_num_rows($result);


for ($j=0; $j < $rows; $j++)
{
	$problem=pg_fetch_row($result);
	
	echo <<<_END


	<a href="index.php?page=editProblem&chainID=$chainID&number=$problem[1]">Problem $problem[1] : $problem[2]</a>
	<br/><br/>
	
_END;
}
?>

<form method="post" action="index.php?page=editChain&chainID=<?php echo"$chainID"?>">
	<input type="submit" name='submitChain' value='Submit Chain'/>
</form>

</div>


