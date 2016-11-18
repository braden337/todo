<?php
  session_start();
  
  require 'db.php';

  if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = $conn->prepare('SELECT password FROM user WHERE email = ?');
    $query->execute([$email]);
    $hash = $query->fetchObject();

    if (password_verify($password, $hash->password)) {
      $query = $conn->prepare('SELECT id, email FROM user WHERE email = ?');
      $query->execute([$email]);
      $user = $query->fetchObject();

      $_SESSION['user'] = $user;
      $_SESSION['flash_status'] = 'success';
      $_SESSION['flash_message'] = "You've logged in.";
      header('Location: /');
      exit();
    }
    else {
      $_SESSION['flash_status'] = 'danger';
      $_SESSION['flash_message'] = 'Your email or password was wrong.';
    }


  }

  
  $title = 'login';
  require 'header.php';
  
?>
    
  <div class="row">
      
    <div class="col-lg-4 offset-lg-4">
      
    <h1><?= ucfirst($title) ?></h1>
    
    <form action="/<?= $title ?>.php" method="POST">
      <div class="form-group">
        <label for="emailInput">Email address</label>
        <input type="email" name="email" class="form-control" id="emailInput">
      </div>
      <div class="form-group">
        <label for="passwordInput">Password</label>
        <input type="password" name="password" class="form-control" id="passwordInput" >
      </div>
      <button type="submit" class="btn btn-primary" id="formSubmit">Submit</button>
    </form>
    
    </div> 
  </div>
  
  
  
<?php require 'footer.php' ?>