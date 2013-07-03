<!DOCTYPE html>
<head>
  <?php if($_COOKIE['theme']=='dark') {?>
    <link rel='stylesheet' type ='text/css' href='styles/dark.css' title='light'>
  <?php } 
  else {?>
    <link rel='stylesheet' type ='text/css' href='styles/light.css' title='light'>
  <?php } ?> 
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
 <div id="banner">

  GAUSSCHAIN
  
 </div>
 <?php if(!array_key_exists('email',$_COOKIE)) {?> 
  <aside id="login">
        <form action="scripts/login.php" method="get" accept-charset="UTF-8">
          <p><b>Name</b> <br> <input type="text" class="emailfield" name="email" size="30" maxlength="30" placeholder="Enter your name"> <br>
          <b>Password</b> <br> <input type="password" class="passwordfield" name="password" size="30" maxlength="30" placeholder="Enter your password"> </p>
          <p><input type="submit" name="submit" value="Login"></p> 
        </form>
    <?php if($_COOKIE['theme']=='dark') {?>
    <form name='style' action='scripts/changestyle.php' method='post'>
      On <input type="radio" name="theme" value="light" id="light">
      Off <input type="radio" name="theme" value="dark" id="dark" checked='checked'>
           <input type="submit" value="Change">
    </form> 
    <?php }
     else {?>
      <form name='style' action='scripts/changestyle.php' method='post'>
      On <input type="radio" name="theme" value="light" id="light" checked='checked'>
      Off <input type="radio" name="theme" value="dark" id="dark">
           <input type="submit" value="Change">
    </form> 
    <?php } ?>  
  </aside>
  <aside id="register">
          <p><a href='index.php?page=registration.php'>REGISTER</a></p>
  </aside>
<?php } 

 else { ?>
  <aside id='login'>
    <p><?php echo 'Welcome to GC, '.$_COOKIE['email']; ?> <p>
    <form name='logout' method='get' action='scripts/logout.php'><input type='submit' value='LOGOUT'></form>
  </aside>
<?php } ?>
<ul id="contents">
      <li class="top"> <span><a href="."> Home </a></span> </li>
      <li class="top"> <a href='index.php?page=problems'>Chains</a>  </li>  <li class="top"> Rankings </li>
      <li class="top"> <a href='index.php?page=forum'>Forum</a> </li>
</ul>

<div id="main">
  <?php
    require "scripts/database.php";
    $page=$_GET['page']; 
    if($page=='home') {
      include('html/home.html');
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
    else {
      include('html/home.html'); 
    }
  ?>
</div>

<footer>
      <br><br>
      <p style="float: right">&copy; Copyright 2013 <color1> Gauss Chain <color1></p>
      <p style="float: left;">Founded by <color1> Brevin Wankine </color1> </p>
</footer>
</body>
</html>
