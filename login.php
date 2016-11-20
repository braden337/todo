<?php
  session_start();
  
  require 'db.php';

  if (isset($_SESSION['user'])) {
    header('Location: /');
    exit();
  }

  if (!empty($_POST['name']) && !empty($_POST['password'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    
    $query = $conn->prepare('SELECT password FROM user WHERE name = ?');
    $query->execute([$name]);
    // var_dump($query);

    $hash = $query->fetchObject();
    // var_dump($hash); exit;

    if (!$hash) {
      $_SESSION['flash_status'] = 'danger';
      $_SESSION['flash_message'] = 'Your username or password was wrong.';
      header('Location: /login.php');
      exit();
    }



    if (password_verify($password, $hash->password)) {
      $query = $conn->prepare('SELECT id, name FROM user WHERE name = ?');
      $query->execute([$name]);
      $user = $query->fetchObject();

      $_SESSION['user'] = $user;
      $_SESSION['flash_status'] = 'success';
      $_SESSION['flash_message'] = "You are now logged in.";
      header('Location: /');
      exit();
    }
    else {
      $_SESSION['flash_status'] = 'danger';
      $_SESSION['flash_message'] = 'Your username or password was wrong.';
    }


  }
  else if (isset($_POST['name']) && isset($_POST['password'])) {
    $_SESSION['flash_status'] = 'danger';
    $_SESSION['flash_message'] = "Can't be blank.";
  }

  
  $title = 'login';
  require 'header.php';
  
?>
    
  <div class="row aForm">
      
    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
      
    <h1><?= ucfirst($title) ?></h1>
    
    <form action="/<?= $title ?>.php" method="POST">
      <div class="form-group">
        <label for="usernameInput">Username</label>
        <input type="text" name="name" class="form-control" id="usernameInput" autocapitalize="none" autocorrect="off" required>
      </div>
      <div class="form-group">
        <label for="passwordInput">Password</label>
        <input type="password" name="password" class="form-control" id="passwordInput" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block" id="formSubmit"><?= ucfirst($title) ?></button>
    </form>

      <div class="text-xs-center">
        <div class="text-small text-muted my-1">or</div>
        <a href="/register.php">Register</a>
      </div>
    
    </div>

  </div>
  
  
  
<?php require 'footer.php' ?>