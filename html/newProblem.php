<?php
if ( (! $_COOKIE['username']) or $_COOKIE['username']=="")
	die ("You must be logged on to build a chain.");
$username=$_COOKIE['username'];

require 'scripts/treatment.php';

if (! isset($_GET['chainID'])) die("There was an error.  I don't know which chain you are trying to edit.");
else
{
	$currChain=$_GET['chainID'];
	$chainID=$currChain;
	$query="SELECT * FROM chains WHERE chainID='$currChain'";
	$result=pg_query($dbconn,$query);
	$chain=pg_fetch_row($result);
	
}

if ($chain[4] != $username)
	die("You are not authorized to edit this chain.");


if ( isset($_POST['number']) )
{

	$number=sanitize($_POST['number']);	
	
	
	$query="SELECT * FROM problems WHERE chainID='$chainID' AND number='$number'";
	$result=pg_query($dbconn,$query);
	$rows=pg_num_rows($result);

	if ($rows!=0)
		echo "That problem number is already taken!<br>";
	else
{

	$title="";
	if ($_POST['title'])	
	{
		$title=sanitize($_POST['title']);
	}
	
	$expos="";
	if ($_POST['expos'])
	{	
		$expos=sanitize($_POST['expos']);
	}

	$statement="";
	if ($_POST['statement'])
	{	
		$statement=sanitize($_POST['statement']);
	}

	$answer=0;
	if ($_POST['answer'])
		$answer=sanitize($_POST['answer']);
	$numSolves="0";

	$query="INSERT INTO problems VALUES ('$chainID','$number','$title','$expos','$statement','$answer','0','0','5')";
	if (!pg_query($dbconn,$query)) echo "There was an error.  Please try again.";
	else
		echo "You have successfully created a new problem.  Return to the BUILD section to continue.";
}
} 


?>



<script>
$(document).ready(function() {
	var text_expos=""
	var ptext_expos=""

	var text_statement=""
	var ptext_statement=""
		
	function save() {
    	var text_expos=$("#expos").val();
		var text_statement=$("#statement").val();
    	
    	if(text_expos!=ptext_expos) {
    		ptext_expos=text_expos;
            $("#preview_expos").html(text_expos);
    	}
		if (text_statement!=ptext_statement) {
			ptext_statement=text_statement;
			$("#preview_statement").html(text_statement);
		}
    	
        MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
    }
    window.setInterval(function(){
  		save();
	}, 100);
	$("#expos").focus();
});
</script>


 

<div id="editZone">

<h1><?php echo "$chain[1]: New Problem" ?></h1>

Note: In order to begin a new line in the middle of your exposition or problem statement, you must type "&ltbr/&gt".  <br/>Aside from this, standard Latex works. </br></br>
<form method="post" action="index.php?page=newProblem&chainID=<?php echo "$currChain"?>">

<color2>Problem Number</color2> &nbsp&nbsp<input type="text" name="number" maxlength="3" size="3"/> <br/><br>
<color2>Problem Title</color2>  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="title" maxlength="30" size="30"/> <br/><br>

<color2>Exposition</color2><br>
<textarea id="expos" name="expos" rows="33" maxlength="2000">This is a preview of your exposition.</textarea> 
<div id="preview_expos" style="font-family: Monospace; font-size: 16px"></div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<color2>Problem Statement</color2><br>
<textarea id="statement" name="statement" rows="17" maxlength="1000">This is a preview of your problem statement.</textarea> 
<div id="preview_statement" style="font-family: Monospace; font-size: 16px"></div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<color2>Answer</color2>   <input type="text" name="answer" maxlength="10" size="10"/> <br/><br>
<input type="submit" name="submitProb" value="Save"/>

</form>


</div>



