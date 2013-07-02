<h2 style="text-align: center; font-family: Monospace;">Pascal's Triangle</h2>
<h3 style="text-align: center; font-family: Monospace; font-size: 130%;">Problem <?php echo $currproblem; ?></h3>
<?php 
  require '../scripts/database.php';
  $query="SELECT * FROM problems order by ID";
  $result=pg_query($dbconn,$query);
  $currproblem=$_GET['problem']; //fuck
  $chain=$_GET['chain'];
  $statement="SELECT text FROM problems_text where id=$currproblem and chain=$chain";
  $r=pg_query($dbconn,$statement);
  $bg=pg_fetch_array($r);
  $bg=$bg[0];
  echo $bg;
?>
<div id='answer'>
    <br>
    <br>
    <?php
      $email=$_COOKIE['email'];
      $query="SELECT * FROM accounts WHERE username='$email'";
      $outcome=pg_query($dbconn,$query);
      $outcome=pg_fetch_array($outcome);
      $solved=$outcome['chain1'];
    ?>
    <?php if($solved[$currproblem-1]=='0') { ?>
      <form name="solution" action="scripts/grade.php" method="get" accept-charset="utf-8">
        <input type='text' name='solution'>
        <input type='submit' name='Submit' value=<?php echo $currproblem;?>>
      </form> 
    <?php } ?>
</div>