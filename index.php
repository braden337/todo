<?php
  session_start();
  
  require 'db.php';


  $title = null;
  require 'header.php';

  if (!logged_in()) {
    header('Location: /login.php');
    exit();
  }

  $user = getUser();

  if (!empty($_POST['description'])) {
    $statement = $conn->prepare('INSERT INTO todo (description, user_id) VALUES (?, ?)');
    $statement->execute([$_POST['description'], $user->id]);
  }
  else if (isset($_POST['description'])) {
    $_SESSION['flash_status'] = 'danger';
    $_SESSION['flash_message'] = "New items can't be blank";
    header('Location: /');
    exit();
  }

  $query = $conn->prepare('SELECT id, description FROM todo WHERE user_id = ? ORDER BY id DESC');
  $query->execute([$user->id]);

  $todos = $query->fetchAll(PDO::FETCH_OBJ);

?>

  <div class="row" id="instructions">
    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
      <div class="card instructions">
        <div class="card-block">
          <p class="card-text text-muted">Add a new item to your todo list, click on an item to delete it. <em>Click this to dismiss these instructions</em>.</p>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="row">
  <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
    
  <div class="card card-inverse bg-primary">
    <div class="card-block">
    <form class="form" action="/" method="POST" validate>
        <div class="form-group">
          <!-- <label for="todoInput">Name</label> -->
          <input type="text" class="form-control" name="description" id="todoInput" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Add</button>
      </form>
      <!-- <p class="card-text"><?= $todo-> description ?></p> -->
    </div>
  </div>



  </div>

        <?php foreach ($todos as $todo): ?>
    <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
      
      <!-- <ul> -->
          <!-- <li data-id="<?= $todo->id ?>"><?= $todo->description ?></li> -->
      <!-- </ul> -->

      <div class="card card-inverse todo" data-id="<?= $todo->id ?>">
        <div class="card-block">
          <p class="card-text"><?= $todo-> description ?></p>
          <!-- <a href="/remove.php?id=<?= $todo->id ?>" class="btn btn-danger">Remove</a> -->
        </div>
      </div>
    </div>
        <?php endforeach; ?>
  </div>
  
<?php require 'footer.php' ?>