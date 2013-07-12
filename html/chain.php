<?php
$username=$_SESSION['username'];

$chainID=$_GET['chainID'];
$query="SELECT * FROM chains WHERE chainID='$chainID'";
$result=pg_query($dbconn,$query);
$chain=pg_fetch_row($result);

$query="SELECT * FROM problems WHERE chainID='$chainID' ORDER BY number";
$result=pg_query($dbconn,$query);
$rows=pg_num_rows($result);

echo "<div class='area'>";
echo "<h1>$chain[1] :: <color4>$chain[4]</color4></h1>";
echo "</div>";
echo "<div class='chain'>";

?>

	<table class="chain">
	<tr>
		<th id="star"></th>
		<th id="id">#</th>
		<th>Title</th>
		<th>Stars</th>
		<th>Solves</th>
	</tr>

<?php

    $query="SELECT chain" . $chainID . " FROM accounts WHERE username='" . $username . "'";
    $result=pg_query($dbconn,$query);
    $row=pg_fetch_row($result);
    $string=$row[0];

    $query="SELECT * FROM problems WHERE chainID='$chainID' ORDER BY number";
    $result=pg_query($dbconn,$query);
    $rows=pg_num_rows($result);

for ($j=0; $j<$rows; $j++)
{
	$problem=pg_fetch_row($result);	
	$number=$problem[1];

        $binary=substr($string,$number-1,1);
	
	echo "<tr>";
if ($binary>1)
{
	echo <<<_END
		<td id="star"><img src="images/star.png" width="30" height="30"></td>
_END;
}
else
{
	echo <<<_END
		<td id="star"> </td>
_END;
}
	echo <<<_END

		<td class="number" id="id"><a href="index.php?page=problem&chainID=$chainID&number=$problem[1]">$problem[1]</a> </td>
_END;

    
    
    
    if ($binary>0)
    {
      echo <<<_END
	<td class="title"><a href="index.php?page=problem&chainID=$chainID&number=$problem[1]"><i><color2>$problem[2]</color2></i></a> </td>
_END;
    }
    else
    {
    echo <<<_END
	<td class="title"><a href="index.php?page=problem&chainID=$chainID&number=$problem[1]"><strong>$problem[2]</strong></a> </td>
_END;
    }
    echo <<<_END
		<td class="number">$problem[6]</td>
		<td class="number">$problem[7]</td>
	</tr>
_END;
}
?>

	</table>
	</div>

