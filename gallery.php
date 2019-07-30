<?php
  ob_start();
  $page_title = 'Gallery';
  require_once('header.php');

  require_once('auth.php');

  require_once('db.php');

  //get movie photos from database
  $sql = "SELECT movie_id, title, photo FROM movies WHERE photo IS NOT NULL";
  $cmd = $conn->prepare($sql);
  $cmd -> execute();
  $movies = $cmd->fetchAll();

  echo '<div>';
  echo  '<h2>Movie Posters</h2><main class="container">' ;
  foreach($movies as $movie){
    echo '<div>
    <a href="movie.php?movie_id='. $movie['movie_id'] .'" title="Movie Details">
    <img class="thumbnail" src="images/' . $movie['photo'] . '" title="'. $movie['title'] .'" />
    </a>
    <p>'.$movie['title'] .'</p></div>';
  }

  echo '</div>';
  //show books
  $sql = "SELECT book_id, title, photo FROM books WHERE photo IS NOT NULL";
  $cmd = $conn->prepare($sql);
  $cmd -> execute();
  $books = $cmd->fetchAll();

  echo '<div>';
  echo  '<h2>Book Posters</h2><main class="container">' ;
  foreach($books as $book){
    echo '<div>
    <a href="book.php?movie_id='. $book['book_id'] .'" title="book Details">
    <img class="thumbnail" src="images/' . $book['photo'] . '" title="'. $book['title'] .'" />
    </a>
    <p>'.$book['title'] .'</p></div>';
  }
  echo  '</main>';
  echo '</div>';
  $conn = null;
 ?>
 <div class="footer">
   <?php
      require_once('footer.php');
      ob_flush();
      ?>
 </div>
