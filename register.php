<?php
  //set the page Title
  $page_title = null;
  $page_title = 'User Registration';
  //link to the header
  require_once('header.php');
 ?>
    <h1>User Registration</h1>
    <form action="save-registration.php" method="post">
      <fieldset class="form-group">
        <label for="username" class="col-sm-2">Email:* </label>
        <input name="username" id="username" required type="email" />
      </fieldset>
      <fieldset class="form-group">
        <label for="password" class="col-sm-2">Password:*</label>
        <input name="password" id="password" required type="password"/>
      </fieldset>
      <fieldset class="form-group">
        <label for="confirm" class="col-sm-2">Confirm Password:*</label>
        <input name="confirm" id="confirm" required type="password" />
      </fieldset>
      <div class="g-recaptcha" data-sitekey="6LdFNbAUAAAAAAI4V_ooTsFnbASr8xoY9b_ICBgE"></div>
      <button class="btn btn-success col-sm-offset-2">Register</button>
    </form>
    <?php
      //link to the footer
      require_once('footer.php');
     ?>
