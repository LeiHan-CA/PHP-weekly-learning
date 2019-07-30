
    <?php ob_start();
      require_once('auth.php');
      //set the page Title
      $page_title = null;
      $page_title = 'Main Menu';
      //link to the header
      require_once('header.php');
     ?>

    <main class="container">

      <h1>COMP1006 Application</h1>

      <li class="list-group-item"><ul class="list-group"><a href="movies.php" title="Movies">Movies</a></ul></li>
      <li class="list-group-item"><ul class="list-group"><a href="books.php" title="Books">Books</a></ul></li>

    </main>
    <?php
      //lint to the footer
      require_once('footer.php');
      ob_flush();
     ?>
