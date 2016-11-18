<?php
  session_start();

  require 'db.php';
  
  if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmedPassword'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmedPassword = $_POST['confirmedPassword'];

    if(!strcmp($password, $confirmedPassword)) {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $statement = $conn->prepare('INSERT INTO user (email, password) VALUES (:email, :password)');
      $statement->bindParam(':email', $email);
      $statement->bindParam(':password', $password);
      if ($statement->execute()) {
        $_SESSION['flash_status'] = 'danger';
        $_SESSION['flash_message'] = "You've registered successfully, now you can login";
        header('Location: /');
      }
    }


  }
  
  $title = "register";
  require 'header.php';
  
?>
    
  <div class="row">
      
    <div class="col-lg-4 offset-lg-4">
      
    <h1><?= ucfirst($title) ?></h1>
    
    <form action="/register.php" method="POST">
      <div class="form-group">
        <label for="emailInput">Email address</label>
        <input type="email" name="email" class="form-control" id="emailInput">
      </div>
      <div class="form-group">
        <label for="passwordInput">Password</label>
        <input type="password" name="password" class="form-control" id="passwordInput" >
      </div>
      <div class="form-group">
        <label for="passwordConfirmInput">Confirm Password</label>
        <input type="password" name="confirmedPassword" class="form-control" id="passwordConfirmInput" >
      </div>
      <button type="submit" class="btn btn-primary" id="formSubmit">Submit</button>
    </form>
    
    </div> 
  </div>
  
  
  
<?php require 'footer.php' ?>