<?php ob_start();

  //set the page Title
  $page_title = null;
  $page_title = 'COMP1006 App - Page Not Found';
  //link to the header
  require_once('header.php');
 ?>
 <main class="container">

      <h1>Ooops!</h1>

      <p class="jumbotron">Sorry but we can't find the page you requested.  Please try one of the links above instead.</p>

 </main>
 <?php
   //lint to the footer
   require_once('footer.php');
   ob_flush();
  ?>
