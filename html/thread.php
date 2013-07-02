<?php 
    $thread=$_GET['thread'];
    $query="SELECT * FROM forum WHERE thread='$thread'";
    $result=pg_query($dbconn,$query);//$db->query($query);
    if(!pg_fetch_array($result)) {
      echo "The page you requested does not exist, dumbass.";
      exit();
    }
?>
<?php echo "<h2 style='text-align: center;'>".$_GET['thread']."</h2>";?>
<section id='responses'> 
  <?php
        $i=pg_num_rows($result);
        for($j=0;$j<$i;$j+=1) {
          $out=pg_fetch_array($result,$j);
          if(!$out[3]) {
            $out[3]='guest';
          }
  ?>
            <?php echo '&nbsp;'.$out[3]; ?> <br>
            <p> <?php echo $out[2]; ?></p></td>
          <br>
      <?php               } ?>
      <br>
</section>
<?php $path='scripts/post_in_thread.php?thread='.$thread;?>
<?php if(array_key_exists('email',$_COOKIE)) {?>
<form style="text-align: center" name='talk' action="<?php echo $path;?>" method='post' accept-charset='utf-8'>
        <textarea name='comment' rows="5" cols="50"></textarea>
        <input name='Submit' type='submit' value='Submit'>
</form>
<?php } ?>