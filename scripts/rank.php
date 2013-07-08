<?php //set each user's ranking

require_once 'database.php';

$query="SELECT * FROM accounts";
$result=pg_query($dbconn,$query);
$rows=pg_num_rows($result);

rank_builders($dbconn);;
rank_solvers($dbconn);

function rank_builders($dbconn)
{
	$query="SELECT * FROM accounts ORDER BY build_score DESC";
	$result=pg_query($dbconn,$query);
	$rows=pg_num_rows($result);
	
	for ($j=1; $j<=$rows; $j++)
	{
		$account=pg_fetch_row($result);
		$username=$account[0];
		
		$query1="UPDATE accounts SET build_rank='$j' WHERE username='$username'";
		if (! pg_query($dbconn,$query1)) echo "failed to rank the builder $username.";
	}
}

function rank_solvers($dbconn)
{
	$query="SELECT * FROM accounts ORDER BY solve_score DESC";
	$result=pg_query($dbconn,$query);
	$rows=pg_num_rows($result);
	
	for ($j=1; $j<=$rows; $j++)
	{
		$account=pg_fetch_row($result);
		$username=$account[0];
		
		$query1="UPDATE accounts SET solve_rank='$j' WHERE username='$username'";
		if ( ! pg_query($dbconn,$query1)) echo "failed to rank the solver $username.";
	}
}

?>
