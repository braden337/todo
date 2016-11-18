<?php
  session_start();
  
  $title = 'home';
  require 'header.php';
?>
  
  <div class="row">
    
    <div class="col-xs-12">
      
      <ul>
        
        <li>The</li>
        <li>List</li>
        <li>Goes</li>
        <li>Here</li>
        
      </ul>

      <pre>
        <?= var_dump($_SESSION) ?>
      </pre>
      
    </div>
    
  </div>
  
<?php require 'footer.php' ?>