<?php ob_start(); ?>

<!DOCTYPE html>
<html>
<body>
  <?php
    // store the inputs & hash the password
    $username = $_POST['username'];
    $password = $_POST['password'];
    try {
    // connect
    require('db.php');

    // write the query
    $sql = "SELECT * FROM users WHERE username = :username";

    // create the command, run the query and store the result
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    // if count is 1, we found a matching username in the database.  Now check the password
    if (password_verify($password, $user['password'])) {
        // user found
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        header('location:menu.php');
    }
    else {
        // user not found
        echo 'Invalid Login';
        header('location:login.php?invalid=true');
        exit();
    }
    $conn = null;
  }
    catch (Exception $e) {
      mail('leihan513@hotmail.com', 'COMP1006 Web App Error', $e);
      header('location:error.php');
}
  ?>
</body>
</html>
<?php ob_flush(); ?>
