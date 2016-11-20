<?php

  require 'helpers.php';
  
  $pages = logged_in() ? ['logout'] : ['register', 'login'];
  
  $user = getUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($title)? ucfirst($title) : "I used todo" ?></title>
  
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
      .nav-item + .nav-item {
        margin-top: 0.5em;
      }
    }

    h1 {
      margin-bottom: 0.5em;
    }

    #formSubmit {
      margin-top: 0.5em;
    }

    #footer {
      margin: 2em auto 2em auto;
    }

    #footer a {
      font-style: italic;
    }

    .todo {
      background-color: #333;
      /*border-color: #333;*/
    }

    #instructions {
      display: none;
    }

    .love {
      color: red;
    }

    .g-recaptcha {
      display: inline-block;
    }

  </style>
  <script src='https://www.google.com/recaptcha/api.js'></script>
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
              <a class="nav-link<?= !strcmp($page, $title) ? ' hidden-xs-up' : '' ?>" href="/<?= $page ?>.php"><?= ucfirst($page) ?><?= isset($user) ? ', '.$user->name : '' ?></a>
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
    
    <div class="row" id="flash">
      <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
        
        <?php display_flash(); ?>
      
      </div>
    </div>
    
    

















