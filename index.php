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

  if (isset($_POST['todo'])) {
    $statement = $conn->prepare('INSERT INTO todo (item, user) VALUES (?, ?)');
    $statement->execute([$_POST['todo'], $user->id]);
  }

  $query = $conn->prepare('SELECT item FROM todo WHERE user = ?');
  $query->execute([$user->id]);

  $todos = $query->fetchAll(PDO::FETCH_COLUMN);

?>
  
  <div class="row">
    
    <div class="col-xs-12">
      
      <ul>
        <?php foreach ($todos as $item): ?>
          <li><?= $item ?></li>
        <?php endforeach; ?>
      </ul>

      <!-- <pre>
        <?= logged_in() ? var_dump($todos) : 'cool' ?>
      </pre> -->
      
      <form class="form-inline" action="/" method="POST">
        <div class="form-group">
          <!-- <label for="exampleInputName2">Name</label> -->
          <input type="text" class="form-control" name="todo" id="exampleInputName2">
        </div>
        <button type="submit" class="btn btn-primary hide">New Item</button>
      </form>

    </div>
    
  </div>
  
<?php require 'footer.php' ?>