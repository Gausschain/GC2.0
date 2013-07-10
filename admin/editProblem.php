<?php
session_start();

if ($_SESSION['username']!='Gauss' and $_SESSION['username']!='admin')
{
	header("Location: login.php");
	die();
}

require '../scripts/database.php';
require '../scripts/treatment.php';

$chainID=$_GET['chainID'];
$query="SELECT * FROM chains WHERE chainID='$chainID'";
$result=pg_query($dbconn,$query);
$chain=pg_fetch_row($result);

$number=$_GET['number'];
$query="SELECT * FROM problems WHERE chainID='$chainID' and number='$number'";
$result=pg_query($dbconn,$query);
$problem=pg_fetch_row($result);

if ( isset($_POST['save']) )
{
	$new_number=sanitize($_POST['change_number']);
	$title=sanitize($_POST['title']);
	$expos=sanitize($_POST['expos']);
	$statement=sanitize($_POST['statement']);
	$answer=sanitize($_POST['answer']);
	$numSolves="0";
	
	$query="UPDATE problems SET number='$new_number', title='$title', expos='$expos', statement='$statement', solution='$answer' WHERE chainID='$chainID' AND number='$number'";
	pg_query($dbconn,$query);

	header("Location: editProblem.php?chainID=$chainID&number=$new_number");
	die();


}

?>

<html>
<head>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript"
        src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML" defer="defer">
    </script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
        tex2jax: {
          inlineMath: [['$','$'], ['\\(','\\)']],
          processEscapes: true
        }
      });
    </script>

    <link rel='stylesheet' type ='text/css' href='../styles/dark.css' title='dark'>
</head>

<body>
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
<h1> <?php echo "$chain[1]: <i>edit</i> Problem $number" ?></h1>

<form method="post" action="editProblem.php?chainID=<?php echo $chainID?>&number=<?php echo $number?>">

<color2>Problem Number</color2>&nbsp&nbsp<input type="text" name="change_number" maxlength="3" size="3" value="<?php echo $number;?>"/>
<br><br>

<color2>Problem Title</color2>  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="title" maxlength="30" size="30" value="<?php echo $problem[2];?>"/><br><br>

<color2>Exposition</color2><br>
<textarea id="expos" name="expos" rows="33" maxlength="2000"><?php echo htmlentities($problem[3]);?></textarea> 
<div id="preview_expos" style="font-family: Monospace; font-size: 16px"></div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<color2>Problem Statement</color2><br>
<textarea id="statement" name="statement" rows="17" maxlength="1000"><?php echo htmlentities($problem[4])	;?></textarea> 
<div id="preview_statement" style="font-family: Monospace; font-size: 16px"></div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<color2>Answer</color2>   <input type="text" name="answer" maxlength="10" size="10" value="<?php echo $problem[5];?>"/> <br/><br>

<input type="submit" name="save" value="Save"/>


</body>
</html>
