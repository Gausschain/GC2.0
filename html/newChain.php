<?php

require 'scripts/treatment.php';
	
if ( (! $_COOKIE['username']) or $_COOKIE['username']=="")
	die ("You must be logged on to build a chain.");
$username=$_COOKIE['username'];


if (isset($_POST['title']) && isset($_POST['submitChain']) && ! ( $_POST['title']=="" ) )
{
	$query="SELECT * FROM chains";
	$result=pg_query($dbconn,$query);
	$rows=pg_num_rows($result);
	$rows++;	

	$title=sanitize($_POST['title']);
	$description=sanitize($_POST['description']);
	$prereqs=sanitize($_POST['prereqs']);
	
	$query = "INSERT INTO chains (chainid, title,description,prereqs,author) VALUES ('$rows','$title','$description','$prereqs','$username')"; 

	if (!pg_query($dbconn,$query))
		echo "didn't work";	
	else
	{
		header("Location: index.php?page=build");
		die();
	}
}


?>



<div class="area">

<h1>BUILD NEW CHAIN</h1>

<form method="post" action="?page=newChain">
<pre>
Chain Title    <input type="text" name="title" maxlength="34" size="34" />
<label>Description</label>    <textarea name="description" cols="27" rows="5" maxlength="500"> </textarea>
<label>Prerequisites</label>  <textarea name="prereqs" cols="27" rows="3" maxlength="250"> </textarea>
               <input type="submit" name="submitChain"/>

</pre>
</form>

</div>



