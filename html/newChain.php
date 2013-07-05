<?php


	
if (! isset($_COOKIE['username'])) echo "You must be logged in to build a chain.";
else { $username=$_COOKIE['username'];  }


if (isset($_POST['title']) && isset($_POST['submitChain']) && ! ( $_POST['title']=="" ) )
{
	$query="SELECT * FROM chains";
	$result=pg_query($dbconn,$query);
	$rows=pg_num_rows($result);
	$rows++;	

	$title=pg_escape_string($_POST['title']);
	$description=pg_escape_string($_POST['description']);
	$prereqs=pg_escape_string($_POST['prereqs']);
	
	$query = "INSERT INTO chains (chainid, title,description,prereqs,author) VALUES ('$rows','$title','$description','$prereqs','$username')"; 

	if (!pg_query($dbconn,$query))
		echo "didn't work";	
	else
		echo "You have successfully created a chain.  Return to the BUILD section to continue.";
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



