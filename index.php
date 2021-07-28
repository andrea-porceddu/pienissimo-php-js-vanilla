<?php

  require_once("./app/database/installer.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- console GET http://localhost/favicon.ico fix/workaround -->
  <link rel="shortcut icon" href="#">
  <!-- jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer">
  </script>
  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <!-- bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!-- custom css -->
  <link rel="stylesheet" href="./css/style.css">
  <title>Pienissimo Vanilla PHP</title>
</head>
<body>

  <div class="app container-fluid">

    <div class="tab-content mt-5">

      <div class="tab-pane fade show active" id="form-login" role="tabpanel" aria-labelledby="form-login-tab">
        <form action="./app/auth/login.php" method="post">
          <div class="text-center mb-4">
            <img class="mb-4" src="./img/pienissimo.png" alt="pienissimo" width="72" height="72">
            <h1 class="h3 mb-3">Log In</h1>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email address" required autofocus>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
          <button class="btn btn-md btn-primary btn-block" type="submit" name="login">Log In</button>
        </form>
      </div>

      <div class="tab-pane fade" id="form-register" role="tabpanel" aria-labelledby="form-register-tab">
        <form action="./app/auth/register.php" method="post">
          <div class="text-center mb-4">
            <img class="mb-4" src="./img/pienissimo.png" alt="pienissimo" width="72" height="72">
            <h1 class="h3 mb-3">Register</h1>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="First Name" required autofocus>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email address" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
          <button class="btn btn-md btn-primary btn-block" type="submit" name="register">Register</button>
        </form>
      </div>

    </div>

    <ul class="nav nav-pills mt-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="form-login-tab" data-toggle="pill" href="#form-login" role="tab" aria-controls="form-login" aria-selected="true">Log In</a>
      </li>
      <li class="nav-item"> 
        <span class="nav-link">or</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="form-register-tab" data-toggle="pill" href="#form-register" role="tab" aria-controls="form-register" aria-selected="false">Register</a>
      </li>
    </ul>

  </div>
  

  <!-- bootstrap js bundle -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>