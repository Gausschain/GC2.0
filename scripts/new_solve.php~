<?php
//run this when $_GET['username'] has solved the problem identified by $_GET['chainID'] and $_GET['number']
//NOTE: this file does not take into account any changes in star count that may have occurred.  
//I said fuck you to my original solve_score shit.  Right now solve_score is just the number of problems solved.

require_once 'database.php';

$username=$_GET['username'];
$chainID=$_GET['chainID'];
$number=$_GET['number'];


//getting oriented: which chain, which problem and who solved it
$query="SELECT * FROM chains WHERE chainID='$chainID'";
$result=pg_query($dbconn,$query);
$chain=pg_fetch_row($result);

$query="SELECT * FROM problems WHERE chainID='$chainID' AND number='$number'";
$result=pg_query($dbconn,$query);
$problem=pg_fetch_row($result);

$query="SELECT * FROM accounts WHERE username='$username'";
$result=pg_query($dbconn,$query);
$account=pg_fetch_row($result);



$stars=$problem[6];
$solves=$problem[7];
$solves++;

$query="UPDATE problems SET solves='$solves' WHERE chainID='$chainID' AND number='$number'";
if (!pg_query($dbconn,$query)) echo "failed to update solves";

//update the problem's value. it is now considered easier since it just got solved.
$old_value=$problem[8];
$new_value=1+4*pow($solves+1, -0.3);
$query="UPDATE problems SET value='$new_value' WHERE chainID='$chainID' AND number='$number'";
if (!pg_query($dbconn,$query)) echo "failed to update value";

//update solver's solve score
$solve_score=$account[3];
$solve_score++;  //we give them points commensurate with the difficulty of problem BEFORE they solved it
$query="UPDATE accounts SET solve_score='$solve_score' WHERE username='$username'";
if (!pg_query($dbconn,$query)) echo "could not update solve score";

//mark that solver solved this problem
$query="SELECT chain" . $chainID . " FROM accounts WHERE username='" . $username . "'";
$result=pg_query($dbconn,$query);
$row=pg_fetch_row($result);
$string=$row[0];

$new=substr($string,0,$number-1) . "1" . substr($string,$number);

$query="UPDATE accounts SET chain" . $chainID . " =" . "'" . $new . "'" . " WHERE username='" . $username . "'";
pg_query($dbconn,$query);

//NOW WE SWITCH TO THE BUILD ASPECT

//update chain score
if ($solves==1)
	$old_popularity=0;
else
	$old_popularity = $stars * pow(1 + $stars / ($solves-1), 3); //this is the popularity of the problem that was just solved
$new_popularity = $stars * pow(1 + $stars / $solves , 3);
$old_score=$chain[5];
$score = $old_score - $old_popularity + $new_popularity;

$query="UPDATE chains SET score='$score' WHERE chainID='$chainID'";
pg_query($dbconn,$query);

//rerank chains
rank_chains($dbconn);

//update author's build score
$author=$chain[4];
$query="SELECT * FROM accounts WHERE username='$author'";
$result=pg_query($dbconn,$query);
$author_account=pg_fetch_row($result);
$build_score=$author_account[5];
$build_score=$build_score-$old_score+$score; //adjust for changes in chain score
$query="UPDATE accounts SET build_score='$build_score' WHERE username='$author'";
if (!pg_query($dbconn,$query)) echo "could not update build score";



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



?>
