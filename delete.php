<?php
  session_start();

  require 'db.php';
  require 'helpers.php';

  $user = getUser();

  if (isset($user) && isset($_GET['id'])) {
    $statement = $conn->prepare('DELETE FROM todo WHERE id = ? AND user_id = ?');
    $statement->execute(array($_GET['id'], $user->id));
  }

  header('Location: /');
  exit();