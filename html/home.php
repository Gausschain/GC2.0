<div class="builders">
<h3>TOP BUILDERS</h3> 
<div class="ranks">

<?php

// $spectrum=array('#FF7400','#CC7A00','#B26B00','#995C00','#804C00','#663D00');  attempted orange fadeout

$query="SELECT * FROM accounts WHERE build_rank>0 ORDER BY build_rank ASC";
$result=pg_query($dbconn,$query);
$rows=pg_num_rows($result);

$max=10;
if ($rows<10)
	$max=$rows;


for ($j=0; $j<$max; $j++)
{
	$account=pg_fetch_row($result);
	$string = "<span style='color: " . $spectrum["$j"] . ";'>" . $account[0] . "</span> <br>";
	echo $string;
}


?>

</div>
</div>

<div class="solvers">
<h3>TOP SOLVERS</h3>
<div class="ranks">

<?php
$query="SELECT * FROM accounts WHERE solve_rank>0 ORDER BY solve_rank ASC";
$result=pg_query($dbconn,$query);

for ($j=0; $j<$max; $j++)
{
	$account=pg_fetch_row($result);
	$string = "<span style='color: " . $spectrum["$j"] . ";'>" . $account[0] . "</span> <br>";
	echo $string;
}


?>
	
</div>
</div>

<section> 
          <!--List containing the "FAQ" -->
          <ul>
            <li><h2 class="question">If I do a Gauss Chain, what will I get?</h2></li>
            <!--<p><img src="images/Gauss_11.jpg" alt="Gauss pic" width=100 height=100></p>-->
            <p> If you don't become as good at math as Gauss, we guarantee your money back.
              Ok, to be fair, you probably won't become Gauss. But, who cares? Gauss is dead, and you're not. Now stop bitching, 
              and start solving problems.
            </p> 
            <li><h2 class="question">Why can't I write a computer program to solve a problem?</h2></li>
            <p> You can. But we think you'll find that, for many problems, the restriction that your solution be found by hand pushes you toward an elegant method that exploits a 
            fundamental pattern. </p>
            
            <p> With technology outlawed you won't need to consider thorny questions of computational complexity, proper syntax, or whether to instantiate long integers after all.  
            We hope this will hasten your journey to the fringes of your creative ability and to the 
            beautiful ideas that make mathematics worthwhile. </p>
            <li><h2 class="question">What happens if I do use technology? </h2></li>
            <p>An excruciatingly painful death will befall you, I'm afraid.</p>
            <li><h2 class="question"> How mathematically mature do I need to be?</h2></li>
            <p>Yes.</p>
            <li><h2 class="question">Why "Chain"?</h2></li>
            <p>The problems within any chain get progressively more challenging.  If you start with the first problem and work your way down, you will gradually accumulate the domain-specific knowledge and general
             problem solving ability required to complete the chain.</p>
            <li><h2 class="question">Why Gauss? Bruh, why not that Euler guy?</h2></li>
            <p><a href="http://www.projecteuler.net">Euler was taken :( </a></p>
            
          </ul>
</section>
