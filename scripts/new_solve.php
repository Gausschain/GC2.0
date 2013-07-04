<?php
//run this when $_GET['username'] has solved the problem identified by $_GET['chainID'] and $_GET['number']
//NOTE: this file does not take into account any changes in star count that may have occurred.  
//I said fuck you to my original solve_score shit.  Right now solve_score is just the number of problems solved.

require_once 'login.php';
$db_server=mysql_connect($db_hostname,$db_username, $db_password);

if (!$db_server)
	die("Unable to connect to server.");
	
mysql_select_db($db_database);

$username=$_GET['username'];
$chainID=$_GET['chainID'];
$number=$_GET['number'];


//getting oriented: which chain, which problem and who solved it
$query="SELECT * FROM chains WHERE chainID='$chainID'";
$result=mysql_query($query,$db_server);
$chain=mysql_fetch_row($result);

$query="SELECT * FROM problems WHERE chainID='$chainID' AND number='$number'";
$result=mysql_query($query,$db_server);
$problem=mysql_fetch_row($result);

$query="SELECT * FROM accounts WHERE username='$username'";
$result=mysql_query($query,$db_server);
$account=mysql_fetch_row($result);



$stars=$problem[6];
$solves=$problem[7];
$solves++;

$query="UPDATE problems SET solves='$solves' WHERE chainID='$chainID' AND number='$number'";
if (!mysql_query($query,$db_server)) echo "failed to update solves";

//update the problem's value. it is now considered easier since it just got solved.
$old_value=$problem[8];
$new_value=1+4*pow($solves+1, -0.3);
$query="UPDATE problems SET value='$new_value' WHERE chainID='$chainID' AND number='$number'";
if (!mysql_query($query,$db_server)) echo "failed to update value";

//update solver's solve score
$solve_score=$account[3];
$solve_score++;  //we give them points commensurate with the difficulty of problem BEFORE they solved it
$query="UPDATE accounts SET solve_score='$solve_score' WHERE username='$username'";
if (!mysql_query($query,$db_server)) echo "could not update solve score";

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
mysql_query($query,$db_server);

//rerank chains
rank_chains($db_server);

//update author's build score
$author=$chain[4];
$query="SELECT * FROM accounts WHERE username='$author'";
$result=mysql_query($query,$db_server);
$author_account=mysql_fetch_row($result);
$build_score=$author_account[5];
$build_score=$build_score-$old_score+$score; //adjust for changes in chain score
$query="UPDATE accounts SET build_score='$build_score' WHERE username='$author'";
if (!mysql_query($query,$db_server)) echo "could not update build score";



function rank_chains($db_server)
{
	$query="SELECT * FROM chains WHERE is_live!='0' ORDER BY score DESC";
	$result=mysql_query($query,$db_server);
	$rows=mysql_num_rows($result);
	
	for ($j=1; $j<=$rows; $j++)
	{
		$chain=mysql_fetch_row($result);
		$chainID=$chain[0];
		
		$query1="UPDATE chains SET rank='$j' WHERE chainID='$chainID'";
		if (!mysql_query($query1, $db_server)) echo "failed to set chain rank";
	}
}



?>
