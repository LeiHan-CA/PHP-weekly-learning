<h1>Movie listings</h1>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>
<script src="js/sorttable.js"></script>
<?php ob_start();
  require_once('auth.php');
  //set the page title
  $page_title = null;
  $page_title = 'Movies';
  //link to the header
  require_once('header.php');
  try {
    //connect
    require('db.php');
    // check if the user entered keywords for searching
    $keywords = null;

    if (!empty($_GET['keywords'])) {
    $keywords = $_GET['keywords'];
    }
    //prepare the query
    $sql = "SELECT * FROM movies";

    $word_list = null;

    // check if the user entered keywords for searching
    if (!empty($keywords)) {
     // start the WHERE clause MAKING SURE to include spaces around the word WHERE
     $sql .= " WHERE ";

     // split the keywords into an array of individual words
     $word_list = explode(" ", $keywords);

     // start a counter so we know which element in the array we are at
     $counter = 0;

     $search_type = $_GET['search_type'];
     // loop through the word list and add each word to the where clause individually
     foreach($word_list as $word) {

     $word_list[$counter] = "%" . $word . "%";
     // for the first word OMIT the word OR
     if ($counter == 0) {
     $sql .= " title LIKE ?";
     }
     else {
     $sql .= " $search_type title LIKE ?";
     }

     // increment counter
     $counter++;
     }
    }
     // execute the query and store the results, passing the $word_list array as a parameter list to the execute() function
     $cmd = $conn->prepare($sql);
     $cmd->execute($word_list);
     $movies = $cmd->fetchAll();
     ?>

    <div class="col-sm-6">
      <a href="movie.php" title="Add a new movie">Add a new movie</a>
    </div>
    <div class="col-sm-6">
      <form method="get" action="movies.php">
        <label for="keywords">Enter Keywords to Search:</label>
        <input name="keywords" value="<?php echo $keywords; ?>" />
        <select name="search_type">
           <option value="OR">Any Keyword</option>
           <option value="AND">All Keywords</option>
       </select>
        <button type="submit" class="btn btn-success">Search</button>
      </form>
    </div>

    <table class="table table-striped table-hover sortable"><thead><th>Title</th><th>Year</th><th>Length</th><th>URL</th><th>Edit</th><th>Delete</th></thead><tbody>
    <?php
    //loop through the data and display the results
    foreach ($movies as $movie ) {
      echo '<tr><td>' .$movie['title'] .'</td>
          <td>' .$movie['year'] .'</td>
          <td>' .$movie['length'] .'</td>
          <td>' .$movie['url'] .'</td>
          <td><a href="movie.php?movie_id=' . $movie['movie_id'] . '">Edit</a></td>
          <td><a href="delete-movie.php?movie_id=' .$movie['movie_id'] . '" onclick="return confirm(\'Are you sure you want to delete this movie?\');">Delete</a></td></tr>';
    }
    //close the grid
    echo '</tbody></table>';
    //disconnect
    $conn = null;
    echo '<div class="fb-comments" data-href="http://aws.computerstudi.es/~gcc200409681/comp1006/week12/movies.php" data-width="" data-numposts="5"></div>';
}
catch (Exception $e) {
  mail('leihan513@hotmail.com', 'COMP1006 Web App Error', $e);
  header('location:error.php');
}
//link to the footer
require_once('footer.php');
ob_flush();
?>
