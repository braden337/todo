<?php

  require 'helpers.php';
  
  $pages = ['register', 'login'];
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($title)? $title : "I used todo" ?></title>
  <link rel="stylesheet" href="/assets/bootstrap.min.css">
  <style type="text/css">
    #topNav {
      margin-bottom: 1em;
    }
    
    @media (max-width: 990px) {
      #navbarResponsive a {
          background-color: hsla(2, 64%, 63%, 1);
          border-radius: 3px;
          padding-left: 1em;
      }
    }

    h1 {
      margin-bottom: 0.5em;
    }

    #formSubmit {
      margin-top: 0.5em;
    }
  </style>
</head> 
<body>
  
  <div class="container-fluid">
    
    
    <div class="row" id="topNav">
      
      <nav class="navbar navbar-full navbar-dark bg-danger">
        <button class="navbar-toggler hidden-lg-up float-xs-right"
                type="button" data-toggle="collapse"
                data-target="#navbarResponsive"></button>
        <a class="navbar-brand" href="/">I used todo</a>
        <div style="clear:right"></div>
        <div class="collapse navbar-toggleable-md float-lg-right" id="navbarResponsive">
          <ul class="nav navbar-nav">
            <?php foreach($pages as $page): ?>
            <li class="nav-item">
              <a class="nav-link<?= !strcmp($page, $title) ? ' active' : '' ?>" href="/<?= $page ?>.php"><?= ucfirst($page) ?></a>
            </li>
            <?php endforeach ?>
            <!--<li class="nav-item">-->
            <!--  <a class="nav-link" href="#">Link</a>-->
            <!--</li>-->
            <!--<li class="nav-item">-->
            <!--  <a class="nav-link" href="#">Link</a>-->
            <!--</li>-->
            <!--<li class="nav-item dropdown">-->
            <!--  <a class="nav-link dropdown-toggle" href="http://example.com" id="responsiveNavbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>-->
            <!--  <div class="dropdown-menu" aria-labelledby="responsiveNavbarDropdown">-->
            <!--    <a class="dropdown-item" href="#">Action</a>-->
            <!--    <a class="dropdown-item" href="#">Another action</a>-->
            <!--    <a class="dropdown-item" href="#">Something else here</a>-->
            <!--  </div>-->
            <!--</li>-->
          </ul>
          <!--<form class="form-inline float-lg-right">-->
          <!--  <input class="form-control" type="text" placeholder="Search">-->
          <!--  <button class="btn btn-outline-success" type="submit">Search</button>-->
          <!--</form>-->
        </div>
      </nav>
        
      </div>
    
    <div class="row">
      <div class="col-xs-12">
        
        <?php display_flash(); ?>
      
      </div>
    </div>
    
    

















