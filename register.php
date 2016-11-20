<?php
  session_start();

  // error_reporting(E_ALL); ini_set('display_errors', 1);
  
  require 'db.php';

  function get_client_ip() {
      $ipaddress = '';
      if (isset($_SERVER['HTTP_CLIENT_IP']))
          $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
      else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
          $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      else if(isset($_SERVER['HTTP_X_FORWARDED']))
          $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
      else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
          $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
      else if(isset($_SERVER['HTTP_FORWARDED']))
          $ipaddress = $_SERVER['HTTP_FORWARDED'];
      else if(isset($_SERVER['REMOTE_ADDR']))
          $ipaddress = $_SERVER['REMOTE_ADDR'];
      else
          $ipaddress = 'UNKNOWN';
      return $ipaddress;
  }

  if (isset($_SESSION['user'])) {
    header('Location: /');
    exit();
  }
  
  if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['confirmedPassword'])) {
    $name = strtolower($_POST['name']);
    $password = $_POST['password'];
    $confirmedPassword = $_POST['confirmedPassword'];

    if (isset($_POST['g-recaptcha-response'])) {

      $url = 'https://www.google.com/recaptcha/api/siteverify';
      $data = array('secret' => getenv('G_RECAPTCHA_SECRET'),
                    'response' => htmlspecialchars($_POST['g-recaptcha-response']),
                    'remoteip' => get_client_ip());

      // use key 'http' even if you send the request to https://...
      $options = array(
          'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($data)
          )
      );
      $context  = stream_context_create($options);
      $result = json_decode(file_get_contents($url, false, $context));

      if (!$result->success) {
        $_SESSION['flash_status'] = 'danger';
        $_SESSION['flash_message'] = "Sorry, looks like you might be a robot, no account was created";
        header('Location: /register.php');
        exit();
      }

    }

    if(!strcmp($password, $confirmedPassword)) {
      $password = password_hash($password, PASSWORD_DEFAULT);
      // var_dump($password); exit();
      $statement = $conn->prepare('INSERT INTO user (name, password) VALUES (:name, :password)');
      $statement->bindParam(':name', $name);
      $statement->bindParam(':password', $password);
      if ($statement->execute()) {
        $query = $conn->prepare('SELECT id, name FROM user WHERE name = ?');
        $query->execute([$name]);
        $user = $query->fetchObject();
        $_SESSION['user'] = $user;
        $_SESSION['flash_status'] = 'success';
        $_SESSION['flash_message'] = "Your account was created and you are now logged in.";
        header('Location: /');
        exit();
      }
      else {
        $_SESSION['flash_status'] = 'danger';
        $_SESSION['flash_message'] = "Sorry, you can't use that username.";
        header('Location: /register.php');
        exit();
      }
    }
    else {
      $_SESSION['flash_status'] = 'danger';
      $_SESSION['flash_message'] = "Your password confirmation didn't match.";
      header('Location: /register.php');
      exit();
    }
  }
  else if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['confirmedPassword'])) {
    $_SESSION['flash_status'] = 'danger';
    $_SESSION['flash_message'] = "Can't be blank.";
  }
  
  $title = 'register';
  require 'header.php';
  
?>
    
  <div class="row aForm">
      
    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
      
    <h1><?= ucfirst($title) ?></h1>
    
    <form action="/register.php" method="POST">
      <div class="form-group">
        <label for="usernameInput">Username</label>
        <input type="text" name="name" class="form-control" id="usernameInput" autocapitalize="none" autocorrect="off" required>
      </div>
      <div class="form-group">
        <label for="passwordInput">Password</label>
        <input type="password" name="password" class="form-control" id="passwordInput" required>
      </div>
      <div class="form-group">
        <label for="passwordConfirmInput">Confirm Password</label>
        <input type="password" name="confirmedPassword" class="form-control" id="passwordConfirmInput" required>
      </div>
      <div class="form-group text-xs-center">
        <div class="g-recaptcha" data-sitekey="6LeedwwUAAAAAFBiMSTnStsFZAFFLjaxEqzlv7fd"></div>
      </div>
      <button type="submit" class="btn btn-primary btn-block" id="formSubmit" required><?= ucfirst($title) ?></button>
    </form>

    <div class="text-xs-center">
        <div class="text-small text-muted my-1">or</div>
        <a href="/login.php">Login</a>
      </div>
    
    </div> 
  </div>
  
  
  
<?php require 'footer.php' ?>