<?php
  session_start();
  
  require 'db.php';
  
  // send flash message with results from form
  if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $_SESSION['flash_status'] = "danger";
    $_SESSION['flash_message'] = "$email, $password";
  }
  
  $title = "login";
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