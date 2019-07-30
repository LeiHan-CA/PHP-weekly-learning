<?php
  //set the page Title
  $page_title = null;
  $page_title = 'Login';
  //link to the header
  require_once('header.php');
 ?>
    <h1>Login</h1>
    <form action="validate.php" method="post">
      <fieldset class="form-group">
        <label for="username" class="col-sm-2">Username: </label>
        <input name="username" id="username" required type="email" />
      </fieldset>
      <fieldset class="form-group">
        <label for="password" class="col-sm-2">Password: </label>
        <input name="password" id="password" required type="password"/>
      </fieldset>
      <button class="btn btn-success col-sm-offset-2">Login</button>
    </form>
    <?php
      //link to the footer
      require_once('footer.php');
     ?>
