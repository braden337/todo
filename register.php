<?php
  session_start();

  require 'db.php';

  if (isset($_SESSION['user'])) {
    header('Location: /');
    exit();
  }

  // var_dump($_POST); exit();
  
  if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['confirmedPassword'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirmedPassword = $_POST['confirmedPassword'];

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
        $_SESSION['flash_message'] = "You've successfully registered and are now logged in.";
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
    
  <div class="row">
      
    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
      
    <h1><?= ucfirst($title) ?></h1>
    
    <form action="/register.php" method="POST">
      <div class="form-group">
        <label for="usernameInput">Username</label>
        <input type="text" name="name" class="form-control" id="usernameInput" required>
      </div>
      <div class="form-group">
        <label for="passwordInput">Password</label>
        <input type="password" name="password" class="form-control" id="passwordInput" required>
      </div>
      <div class="form-group">
        <label for="passwordConfirmInput">Confirm Password</label>
        <input type="password" name="confirmedPassword" class="form-control" id="passwordConfirmInput" >
      </div>
      <button type="submit" class="btn btn-primary btn-block" id="formSubmit" required>Submit</button>
    </form>
    
    </div> 
  </div>
  
  
  
<?php require 'footer.php' ?>