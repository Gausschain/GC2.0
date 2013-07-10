<?php
$chainID=$_GET['chainID'];
$query="SELECT * FROM chains WHERE chainID='$chainID'";
$result=pg_query($dbconn,$query);
$chain=pg_fetch_row($result);

$query="SELECT * FROM problems WHERE chainID='$chainID' ORDER BY number";
$result=pg_query($dbconn,$query);
$rows=pg_num_rows($result);

echo "<div class='area'>";
echo "<h1>$chain[1] :: <color4>$chain[4]</color4></h1>";

?>

	<table class="chain">
	<tr>
		<th>#</th>
		<th>Title</th>
		<th>Stars</th>
		<th>Solves</th>
	</tr>

<?php

for ($j=0; $j<$rows; $j++)
{
	$problem=pg_fetch_row($result);	
	
	echo <<<_END
	<tr>
		<td><a href="index.php?page=problem&chainID=$chainID&number=$problem[1]">$problem[1]</a> </td>
		<td><a href="index.php?page=problem&chainID=$chainID&number=$problem[1]">$problem[2]</a> </td>
		<td>$problem[6]</td>
		<td>$problem[7]</td>
	</tr>
_END;
}
?>

	</table>
	</div>
