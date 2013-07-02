<section class='forum'>
  <?php 
    $query='SELECT DISTINCT username,thread FROM forum WHERE TRUE';
    $results=pg_query($dbconn,$query);
    $n=pg_num_rows($results);
    for($i=0;$i<$n;$i++) {
      $out=pg_fetch_array($results,$i);
      if(!$out['username']) {
          $out['username']='guest';
      }
      echo "<p id='thread' style='font-size: 115%;'><a id='crucial';' href='index.php?page=thread&thread=".$out['thread']."'>".$out['thread']."</a><span style='font-size: 80%;float: right;'>by ".$out['username']." at ".$out['time']."</span></p>";
    }
  ?>
  <a style="float: right;" href="index.php?page=thread_creation">Create</a>
</section>