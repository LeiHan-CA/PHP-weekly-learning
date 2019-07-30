<?php
//authentication check
session_start();
if (empty($_SESSION['user_id'])) {
  // if there is no user_id in the session, redirect the user to the login page
  header('location:login.php');
  exit();
}


 ?>
