<?php
if ( (! $_COOKIE['username']) or $_COOKIE['username']=="")
	die ("You must be logged on to build a chain.");
$username=$_COOKIE['username'];

?>
<div class="area">

<h1>MY CHAINS</h1>

	<a href="index.php?page=newChain"> <span style="font-size: 20px"> <color2>BUILD NEW CHAIN</color2> </span></a>
	<br/><br/>

<?php 
	$query = "SELECT * FROM chains WHERE author='$username'";
	$result = pg_query($dbconn,$query);
	$rows = pg_num_rows($result);

for ($j=0; $j < $rows; $j++)
{
	$row=pg_fetch_row($result);
	$title=$row[1];
	$id=$row[0];
	echo <<<_END
	
	<div class="box">
		<a href="?page=editChain&chainID=$id"> <color1>$title</color1></a>
		
	</div>
	
	
	
_END;

}

?>

</div>


