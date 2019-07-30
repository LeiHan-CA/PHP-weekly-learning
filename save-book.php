    <?php ob_start();
      //auth check
      require_once('auth.php');
      //link to the header
      $page_title = null;
      $page_title = 'Saving your book';
      require_once('header.php');
      // store the book_id if we are editing.  if we are adding, this value will be empty (which is ok)
      $book_id = $_POST['book_id'];
      // save form inputs into variables
      $title = $_POST['title'];
      $author = $_POST['author'];
      $year = $_POST['year'];
      $photo = null;
      //check if there is a Photo
      if (!empty($_FILES['photo'])) {
        $photo = $_FILES['photo']['name'];

        if($_FILES['photo']['type'] != 'image/jpeg'){
          echo 'Invalid photo<br />';
          $ok = false;
        }else {
          //there is a valid photo
          session_start();
          $final_name = session_id() . '_' . $photo;
          $tmp_name = $_FILES['photo']['tmp_name'];
          move_uploaded_file($tmp_name, "images/$final_name");
        }
      }

      // create a variable to indicate if the form data is ok to save or not
      $ok = true;
      // check each value
      if (empty($title)) {
          // notify the user
          echo 'Title is required<br />';
          // change $ok to false so we know not to save
          $ok = false;
      }
      if (empty($author)) {
          // notify the user
          echo 'author is required<br />';
          // change $ok to false so we know not to save
          $ok = false;
      }
      if (empty($year)) {
          echo 'Year is required<br />';
          $ok = false;
      }
      // check the $ok variable and save the data if $ok is still true (meaning we didn't find any errors)
      if ($ok == true) {
        try{
         // move all the save code we wrote last week in here, starting with the database connection and ending with the disconnect command
         require('db.php');

         if (empty($book_id)) {
         // set up the SQL INSERT command
         $sql = "INSERT INTO books (title, author, year, photo) VALUES (:title, :author, :year, :photo)";
        }
        else {
          // set up the SQL UPDATE command to modify the existing book
          $sql = "UPDATE books SET title = :title, author = :author, year = :year, photo = :photo WHERE book_id = :book_id";
        }

         // create a command object and fill the parameters with the form values
         $cmd = $conn->prepare($sql);
         $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
         $cmd->bindParam(':author', $author, PDO::PARAM_STR, 50);
         $cmd->bindParam(':year', $year, PDO::PARAM_INT);
         $cmd->bindParam(':photo', $final_name, PDO::PARAM_STR, 100);

         // fill the book_id if we have one
         if (!empty($book_id)) {
           $cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);
         }
         // execute the command
         $cmd->execute();
         // show confirmation
         echo "Books Saved";

         // disconnect from the database
         $conn = null;
       }
         catch (Exception $e) {
           mail('leihan513@hotmail.com', 'COMP1006 Web App Error', $e);
           header('location:error.php');
     }
         header('location:books.php');
      }
      require_once('footer.php');
      ob_flush();
    ?>
