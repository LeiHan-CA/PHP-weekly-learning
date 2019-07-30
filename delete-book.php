
    <?php  ob_start();
    require_once('auth.php');
    // capture the selected book_id from the url and store it in a variable with the same name
    $book_id = $_GET['book_id'];
    try{
    // connect
    require('db.php');

    // set up the SQL command
    $sql = "DELETE FROM books WHERE book_id = :book_id";

    // create a command object so we can populate the book_id value, the run the deletion
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $cmd->execute();

    //disconnect
    $conn = null;
    header('location:books.php');
  }
    catch (Exception $e) {
      mail('leihan513@hotmail.com', 'COMP1006 Web App Error', $e);
      header('location:error.php');
}

    require_once('footer.php');
    ob_flush();
     ?>
