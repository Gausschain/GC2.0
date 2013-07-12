<?php

$query="SELECT * FROM chains WHERE true ORDER BY score DESC";
$result=pg_query($dbconn,$query);
$rows=pg_num_rows($result);

?>

<div id='accordion'>

<?php
for ($j=0; $j<$rows; $j++)
{
	$chain=pg_fetch_row($result);
	$chainID=$chain[0];
	$title=$chain[1];
	$score=$chain[5];
	$author=$chain[4];
	$description=$chain[2];
	$prereqs=$chain[3];

	echo <<<_END

	<h3>
		<span class="title"><a href="index.php?page=chain&chainID=$chainID"><color1>$title</color1></a></span>
		<span class="score">$score</span>
		<span class="author">$author</span>
		
		
	</h3>
	
	<div class="chaininfo">
		<color2><strong>Description:</strong></color2> $description <br>
		<color2><strong>Prerequisites:</strong></color2> $prereqs
	</div>
_END;


}
?>


</div>
