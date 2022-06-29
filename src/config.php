<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('ROOT_PATH',  __DIR__ . '/'); // path to project folder
define('SRC_PATH', __DIR__ . '/');          // path to "src"-folder
define('CSS_PATH', '../public/css/');          // path to "css"-folder
define('IMG_PATH', '../public/img/');          // path to "img"-folder

// Include functions and classes


function template_header($title) {
    
   
    if (!isset($_SESSION['loggedin'])) {
        $menuVar = '<a href# data-bs-toggle=modal data-bs-target=#loginModal class="linkEffect">LOGIN</a>';
    } else {
        $menuVar =  '<a href=../public/account.php>MY PAGE</a> <a href=../src/logout.php>LOGOUT</a>';
    }


    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    $cart = "<div class=cart_div><a href=cart.php><img src=img/cart-icon.png /><span>$num_items_in_cart</span></a></div>";


    

    echo <<<EOT

        <!DOCTYPE html>
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <link rel="stylesheet" href="css/style.css">
        
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
        
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
            <title>$title</title>
        </head>
        <body>
        
        <div id="header">
        <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">HOME <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">CONTACT</a>
      </li>
      <li class="nav-item">
      <div class="nav-link">{$menuVar}</div>
    </li>
    <li> 
                {$cart}  </li>       
            </nav>
            <a href="index.php" class="logo"><h1 class="logo">SIBAR<span class="orange">SNKR</p></h1></a>
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

        <div id="wrapper">
    EOT;
    }
    // Template footer
    function template_footer() {
    $year = date('Y');
    echo <<<EOT
           
    
            <footer>         
 
                <footer class="sticky-footer m-3">
                  <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                      <span class= "lead">© 2022, Sneaky Sibar Sneakers</span>
                    </div>
                  </div>
                </footer>
        
              </div>
          
            </div>
         
        
            <script src="js/sb-admin-2.min.js"></script>
           
        
        </body>
        
        </html>





            </footer>
        </div>
            <script src="script.js"></script>
        </body>
    </html>
    EOT;
    }
?>
