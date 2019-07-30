<?php ob_start();

  //set the page Title
  $page_title = null;
  $page_title = 'COMP1006 App - Yikes!';
  //link to the header
  require_once('header.php');
 ?>
 <main class="container">

      <h1>We're Sorry!</h1>

      <p class="jumbotron">Something unexpected just happened.  Our support team has been notified and will get right on it.</p>

 </main>
 <?php
   //lint to the footer
   require_once('footer.php');
   ob_flush();
  ?>
