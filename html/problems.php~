<div id='accordion' style="margin-left: 15%; margin-right: 15%;">
      <?php
        $query="SELECT * FROM problems where chain=1 order by ID";
        $result=pg_query($dbconn,$query);
        $i=1;
        while(pg_num_rows($result)>0) {
        ?>
        <h3 style='text-align: left;font-family: Monospace;'><a href="#"> <?php $name=pg_fetch_array($result,0)['chain']; echo "Chain ".$name?></a></h3>
        <div>
          <table>
          <tr>
            <th>Problem ID</th>
            <th>Problem Title</th>
            <th>Problem Description</th>
            <th>Number of solutions</th> 
          </tr>
          <?php $rows=pg_num_rows($result); ?>
            <?php for($count=1;$count<=$rows;$count+=1) { ?>
              <?php 
                $name="index.php?page=problem&problem=$count&chain=$i";
                $problem=pg_fetch_array($result,$count-1);
              ?>
              <tr>
                <td><?php echo '<a href="'.$name.'" style="text-decoration: underline;">'.$count.'</a>'?></td>
                <td><?php echo $problem[1];?></td>  
                <td><?php echo $problem[2];?></td>  
                <td><?php echo $problem[3];?></td>  
              </tr>
            <?php } ?>
          </table>
        </div>
        <?php
          $i+=1;
          $query="SELECT * FROM problems where chain=".$i." order by ID";
          $result=pg_query($dbconn,$query); 
        } 
      ?>
    </div>