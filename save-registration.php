<?php ob_start();
  //auth check
  require_once('auth.php');
  //link to the header
  $page_title = null;
  $page_title = 'Saving your registration';
  require_once('header.php');
      //get the form input
      $username = $_POST['username'];
      $password = $_POST['password'];
      $confirm = $_POST['confirm'];
      $ok = true;
      //validate the input
      if (empty($username)) {
        echo 'Username is required! <br />';
        $ok = false;
      }
      if (empty($password)) {
        echo 'password is required! <br />';
        $ok = false;
      }
      if ($password != $confirm) {
        echo 'password is not match! <br />';
        $ok = false;
      }

      //set up valuses checking Recaptcha
      $secret = "6LdFNbAUAAAAAIgb7h_26rX_TVGzRoJTuvioOaT6";
      $response = $_POST['g-recaptcha-response'];

      //set up url request
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,  "https://www.google.com/recaptcha/api/siteverify");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);

      //create an array to hold values we want to post to Google
      $post_data = array();
      $post_data['secret'] = $secret;
      $post_data['response'] = $response;
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

      //execute the curl request
      $result = curl_exec($ch);
      curl_close($ch);

      //convert the response object from a json object to an array so that we can read it
      $result_array = json_decode($result, true);

      //chect if the success value is true or false
      if ($result_array['success'] == false) {
        echo 'Are you human ?';
        $ok = false;
      }
      if($ok){
        //hash the password
        $password= password_hash($password, PASSWORD_DEFAULT);
        try {
        //set up and execute the query
        require('db.php');
        $sql = "INSERT INTO users (username, password) VALUES(:username, :password)";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $cmd->execute();
        //disconnect
        $conn = null;
      }
        catch (Exception $e) {
          mail('leihan513@hotmail.com', 'COMP1006 Web App Error', $e);
          header('location:error.php');
    }
        //show a meeage to the user
        echo 'Registration Saved !';
    }

      require_once('footer.php');
      ob_flush();
     ?>
