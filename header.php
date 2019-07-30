<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm bg-light">
        <a href="menu.php" title="COMP1006 Web Application" class="navbar-brand">COMP1006 APP</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <?php
            if (!empty($_SESSION['user_id'])) { ?>
              <li class="nav-item active"><a href="movies.php" title="Movies" class="nav-link">Movies</a></li>
              <li class="nav-item"><a href="gallery.php" title="gallery" class="nav-link">Gallery</a></li>
              <li class="nav-item"><a href="books.php" title="Books" class="nav-link">Books</a></li>
              <li class="nav-item"><a href="logout.php" title="Logout" class="nav-link">Logout</a></li>
            <?php
            }
            else { ?>
              <li class="nav-item"> <a href="register.php" title="Register" class="nav-link">Register</a> </li>
              <li class="nav-item"> <a href="login.php" title="Login" class="nav-link">Login</a> </li>
            <?php } ?>
          </ul>
        </div>
    </nav>
