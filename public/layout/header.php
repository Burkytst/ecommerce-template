<?php 
    require('../src/config.php');
    require('../src/dbconnect.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="css/style.css">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<title>Sneaky Sibar</title>
</head>
<body>

<div id="header">
    <nav>
        <a href="index.php">START</a>
        <a href="contact.php">CONTACT</a>
        <?php
            if (!isset($_SESSION['loggedin'])) {
	            echo '<a href# data-bs-toggle=modal data-bs-target=#loginModal>LOGIN</a>';
            } else {
                echo '<a href=../public/account.php>MY PAGE</a> <a href=../src/logout.php>LOGOUT</a>';
            }
        ?>
        
    </nav>
    <h1 class="logo">SIBAR<span class="red">SNKR</p></h1>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="../src/authenticate.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                      <label for="email" class="form-label">Email:</label>
                      <input type="text" name="email" placeholder="Your email" id="email" required class="form-control validate">
                    </div>
            
                    <div class="md-form mb-4">
                      <label for="password" class="form-label">Email:</label>
                      <input type="password" name="password" placeholder="Your password" class="form-control validate" id="password" required>
                    </div>
                    
                  </div>
                  <div class="modal-footer d-flex justify-content-center">
                    <a href="register.php" class="btn btn-default">Create account</a><button class="btn btn-default">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>