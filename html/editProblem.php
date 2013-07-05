<?php
$username="";
if (! isset($_COOKIE['username'])) die ("You must be logged in to build a chain.");
else $username=$_COOKIE['username'];

if (! (isset($_GET['chainID']) AND isset($_GET['number']) ) ) die ("I don't know which problem you are trying to edit.");


$chainID=$_GET['chainID'];
$number=$_GET['number'];

if ( isset($_POST['save']) )
{
	$title=pg_escape_string($_POST['title']);
	$expos=pg_escape_string($_POST['expos']);
	$statement=pg_escape_string($_POST['statement']);
	$answer=pg_escape_string($_POST['answer']);
	$numSolves="0";
	
	$query="UPDATE problems SET title='$title',expos='$expos',statement='$statement',solution='$answer' WHERE chainID='$chainID' AND number='$number'";
	
	if (!pg_query($dbconn,$query)) echo "failed to edit problem";
	else
		echo "You have successfully edited the problem.  Return to the BUILD section to continue.";
}


$query="SELECT * FROM chains WHERE chainID='$chainID'";
$result=pg_query($dbconn,$query);
$chain=pg_fetch_row($result);

$chainTitle=$chain[1];
$author=$chain[4];

$query2="SELECT * FROM problems WHERE chainID='$chainID' AND number='$number'";
$result2=pg_query($dbconn,$query2);
$problem=pg_fetch_row($result2);
echo $chainID;
echo $number;

if ($username!=$author) die("You are not authorized to edit this problem because you are not the author of the chain.");


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

<h1><?php echo "$chain[1]: <i>edit</i> Problem $number" ?></h1>

Note: In order to begin a new line in the middle of your exposition or problem statement, you must type "&ltbr/&gt".  <br/>Aside from this, standard Latex works. </br></br>
<form method="post" action="index.php?page=editProblem&chainID=<?php echo $chainID?>&number=<?php echo $number?>">

<color2>Problem Number</color2> &nbsp&nbsp<input type="text" name="number" maxlength="3" size="3" value="<?php echo $number;?>"/> 
<input type="submit" value="Change Problem Number"/>
<br/><br>

<color2>Problem Title</color2>  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="title" maxlength="30" size="30" value="<?php echo $problem[2];?>"/> <br/><br>

<color2>Exposition</color2><br>
<textarea id="expos" name="expos" rows="33" maxlength="2000"><?php echo $problem[3];?></textarea> 
<div id="preview_expos" style="font-family: Monospace; font-size: 16px"></div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<color2>Problem Statement</color2><br>
<textarea id="statement" name="statement" rows="17" maxlength="1000"><?php echo $problem[4];?></textarea> 
<div id="preview_statement" style="font-family: Monospace; font-size: 16px"></div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<color2>Answer</color2>   <input type="text" name="answer" maxlength="10" size="10" value="<?php echo $problem[5];?>"/> <br/><br>
<input type="submit" name="save" value="Save"/>

</form>


</div>



