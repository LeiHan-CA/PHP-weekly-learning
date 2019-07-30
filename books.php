    <h1>Books Details</h1>
    <!--add a link to javascript-->
    <script src="js/sorttable.js"></script>
    <?php ob_start();
      require_once('auth.php');
      //set the page title
      $page_title = null;
      $page_title = 'Books';
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
      $sql = "SELECT * FROM books";

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
      //run the query and store the results
      $cmd = $conn->prepare($sql);
      $cmd->execute($word_list);
      $books = $cmd->fetchAll();
    ?>
    <div class="col-sm-6">
      <a href="book.php" title="Add a new book">Add a new book</a>
    </div>
      <div class="col-sm-6">
        <form method="get" action="books.php">
          <label for="keywords">Enter Keywords to Search:</label>
          <input name="keywords" value="<?php echo $keywords; ?>" />
          <select name="search_type">
             <option value="OR">Any Keyword</option>
             <option value="AND">All Keywords</option>
         </select>
          <button type="submit" class="btn btn-success">Search</button>
        </form>
      </div>
    <table class="table table-striped table-hover sortable"><thead><th>Title</th><th>Author</th><th>Year</th><th>Edit</th><th>Delete</th></thead><tbody>
    <?php
      //loop through the data and display the results
      foreach ($books as $book ) {
        echo '<tr><td>' .$book['title'] .'</td>
            <td>' .$book['author'] .'</td>
            <td>' .$book['year'] .'</td>
            <td><a href="book.php?book_id=' . $book['book_id'] . '">Edit</a></td>
            <td><a href="delete-book.php?book_id=' .$book['book_id'] . '" onclick="return confirm(\'Are you sure you want to delete this book?\');">Delete</a></td></tr>';
      }
      //close the grid
      echo '</tbody></table>';
      $conn = null;
    }
      catch (Exception $e) {
        mail('leihan513@hotmail.com', 'COMP1006 Web App Error', $e);
        header('location:error.php');
      }
      //link to the footer
      require_once('footer.php');
      ob_flush();
    ?>
