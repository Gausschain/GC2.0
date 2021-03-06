<?php
session_start();
?>
<!DOCTYPE html>
<head>
  <?php if($_COOKIE['theme']=='dark') 
  {
      echo "<link rel='stylesheet' type ='text/css' href='styles/dark.css' title='light'>";
      $spectrum=array('#FFFFFF','#D8D8D8','#C0C0C0','#B0B0B0','#A0A0A0','#909090','#808080','#707070','#606060','#505050');
  } 
  else 
  {
	$spectrum=array('#A00000', '#A02525', '#A04040', '#A05050', '#A05858', '#A06565', '#A07070', '#A07575', '#A08080', '#A08585');
        echo "<link rel='stylesheet' type ='text/css' href='styles/light.css' title='light'>";
  } 
  ?> 
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script language='javascript' type='text/javascript'>
      window.onload=init;
      function init() {
          stripe_all_tables();
      }
      function stripe_all_tables() {
          var tables=document.getElementsByTagName("table");
          for(var i=0;i<tables.length;i++) {
            stripe_table(tables[i]);
          }
      }
      function stripe_table(table) {
        var rows=table.getElementsByTagName("tr");
        for(var i=0;i<rows.length;i++) {
          rows[i].className+=(i%2==0 ? "evenrow" : "oddrow");
        }
      }
  </script>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script type='text/javascript'>
    $(document).ready(function() {
      $("#accordion").accordion({
        event: "click",
        collapsible: true,
        autoHeight: false
      });

      $("#accordion h3 a").click(function() {
	window.location = $(this).attr('href');
	return false;
      });	
    });
  </script>
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
</head>	
<body>
 <div id="banner">GAUSSCHAIN</div>

<?php
require "scripts/database.php";

if (!isset($_COOKIE['username']))
{
echo <<<_END
  <aside id="login">
  
    <form method="post" action="scripts/login.php">
	<p><pre>    Name <input type="text" name="username" /> </pre></p>
	<p>Password <input type="password" name="password" /> </p>
	<p><pre>         <input type="submit" name="sub" value="Login"/> </pre></p>

	</form>
	
  </aside>

_END;
}

else
{
	$username=$_COOKIE['username'];
	$query="SELECT build_rank, solve_rank FROM accounts WHERE username='$username'";
	$result=pg_query($dbconn,$query);
	$account=pg_fetch_row($result);


echo <<<_END
  <aside id="hub">
  	
  	<table id="dish" border="0">
  		<tr>
  			<td class="dish" id="rank">$account[0]</td>
  		</tr>
  		<tr>
  			<td class="dish" id="username"><color1>$username</color1></td>
  		<tr>
  			<td class="dish" id="rank">$account[1]<br></td>
  		</tr>
		<tr>  	
  		<td class="dish">
  			<form method="post" action="scripts/logout.php">
  	   		<input type="submit" name="logout" value="Logout"/> </p>
  			</form>
  		</td>
  		</tr>
  	</table>
  
  </aside>
_END;
}

$username=$_COOKIE['username'];

?>


<ul id="contents">
      <li class="top"> <span><a href="."> Home </a></span> </li>
      <li class="top"> <a href='index.php?page=solve'>Solve</a></li>  
      <li class="top"> <a href='index.php?page=build'>Build</a> </li>		
      <li class="top"> Ranks </li>
      <li class="top"> <a href='index.php?page=forum'>Forum</a> </li>
</ul>

<div id="main">
  <?php
    $page=$_GET['page']; 
    if($page=='home') {
      include('html/home.php');
    }
    else if($page=='forum') {
      include('html/forum.php');
    }
    else if($page=='problems') {
      include('html/problems.php');
    }
    else if($page=='registration') {
      include('html/registration.php');
    }
    else if($page=='problem') {
      include('html/problem.php');
    }
    else if($page=='thread') {
      include('html/thread.php');
    }
    else if($page=='thread_creation') {
      include('html/thread_creation.html');
    }
    else if($page=='hello') {
      include('html/hello.php');  
    }
    else if($page=='build') {
	include('html/build.php');
    }
    else if ($page=='newChain') {
	include('html/newChain.php');
    }
    else if ($page=='editChain') {
	include('html/editChain.php');
    }
    else if ($page=='newProblem') {
	include('html/newProblem.php');
    }
    else if ($page=='editProblem') {
	include ('html/editProblem.php');
    }
    else if ($page=='solve') {
	include ('html/solve.php');
    }
    else if ($page=='chain') {
	include ('html/chain.php');
    }
    else if ($page=='congrats') {
	include ('html/congrats.php');
    }
    else if ($page=='incorrect') {
	include ('html/incorrect.php');
    }
    else {
      include('html/home.php'); 
    }
  ?>
</div>

<footer>
      <br><br>
      <p style="float: right">&copy; Copyright 2013 <color1> Gausschain <color1></p>
      <p style="float: left;">Founded by <color1> Brevin Wankine </color1> </p>
</footer>
</body>
</html>
