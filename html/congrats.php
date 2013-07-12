<?php
$username=$_GET['username'];
$chainID=$_GET['chainID'];
$number=$_GET['number'];
?>

<div class="area">
<h1> Congratulations! </h1>
You have correctly solved problem number <?php echo $number?>.  If you enjoyed the problem, 

<?php echo <<<_END
<a href="scripts/add_star.php?username=$username&chainID=$chainID&number=$number"><color1>give it a star!</color1></a> 
_END;
?>

<br><br>

<?php
$next=$number+1;
echo <<<_END
<a href="index.php?page=problem&chainID=$chainID&number=$next"><h5>NEXT PROBLEM</h5></a>
<a href="index.php?page=chain&chainID=$chainID"><h5>RETURN TO CHAIN</h5></a>
_END;
?>

</div>
