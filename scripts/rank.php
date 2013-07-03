<?php //set each user's ranking

require_once 'login.php';
$db_server=mysql_connect($db_hostname,$db_username, $db_password);

if (!$db_server)
  die("Unable to connect to server.");
	
mysql_select_db($db_database);

$query="SELECT * FROM accounts";
$result=mysql_query($query,$db_server);
$rows=mysql_num_rows($result);

rank_builders($db_server);;
rank_solvers($db_server);

function rank_builders($db_server)
{
	$query="SELECT * FROM accounts ORDER BY build_score DESC";
	$result=mysql_query($query, $db_server);
	$rows=mysql_num_rows($result);
	
	for ($j=1; $j<=$rows; $j++)
	{
		$account=mysql_fetch_row($result);
		$username=$account[0];
		
		$query1="UPDATE accounts SET build_rank='$j' WHERE username='$username'";
		if (! mysql_query($query1,$db_server)) echo "failed to rank the builder $username.";
	}
}

function rank_solvers($db_server)
{
	$query="SELECT * FROM accounts ORDER BY solve_score DESC";
	$result=mysql_query($query,$db_server);
	$rows=mysql_num_rows($result);
	
	for ($j=1; $j<=$rows; $j++)
	{
		$account=mysql_fetch_row($result);
		$username=$account[0];
		
		$query1="UPDATE accounts SET solve_rank='$j' WHERE username='$username'";
		if ( ! mysql_query($query1,$db_server)) echo "failed to rank the solver $username.";
	}
}

?>
