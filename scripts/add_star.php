<?php //run this when a star has been added to the problem identified by $_GET['chainID'] and $_GET['number']

require_once 'database.php';


$chainID=$_GET['chainID'];
$number=$_GET['number'];

$query="SELECT * FROM problems WHERE chainID='$chainID' AND number='$number'";
$result=pg_query($dbconn,$query);
$problem=pg_fetch_row($result);

$query="SELECT * FROM chains WHERE chainID='$chainID' ";
$result=pg_query($dbconn,$query);
$chain=pg_fetch_row($result);

//find the account of the author of the chain
$author=$chain[4];
$query="SELECT * FROM accounts WHERE username='$author'";
$result=pg_query($dbconn,$query);
$account=pg_fetch_row($result);

//update number of stars in problem
$old_stars=$problem[6];
$new_stars=$old_stars + 1;
$query="UPDATE problems SET stars='$new_stars' WHERE chainID='$chainID' AND number='$number'";
pg_query($dbconn,$query);

//update chain score
$solves=$problem[7];
$old_popularity = $old_stars * pow( 1 + $old_stars / $solves , 3);
$new_popularity = $new_stars * pow( 1 + $new_stars / $solves, 3);
$old_score=$chain[5];
$new_score=$old_score - $old_popularity + $new_popularity;
$query="UPDATE chains SET score='$new_score' WHERE chainID='$chainID'";
pg_query($query);

//rerank the chains
rank_chains($dbconn);

//update author's build score
$build_score=$account[5];
$build_score=$build_score - $old_score + $new_score; //adjust for changes in chain score
$query="UPDATE accounts SET build_score='$build_score' WHERE username='$author'";
pg_query($dbconn,$query);


function rank_chains($dbconn)
{
	$query="SELECT * FROM chains WHERE is_live!='0' ORDER BY score DESC";
	$result=pg_query($dbconn,$query);
	$rows=pg_num_rows($result);
	
	for ($j=1; $j<=$rows; $j++)
	{
		$chain=pg_fetch_row($result);
		$chainID=$chain[0];
		
		$query1="UPDATE chains SET rank='$j' WHERE chainID='$chainID'";
		if (!pg_query($dbconn,$query1)) echo "failed to set chain rank";
	}
}

$url="../index.php?page=chain&chainID=$chainID";
header("Location: $url");
die();

?>
