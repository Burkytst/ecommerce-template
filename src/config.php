<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('ROOT_PATH',  __DIR__ . '/../'); // path to project folder
define('SRC_PATH', __DIR__ . '/');          // path to "src"-folder
define('CSS_PATH', '../public/css/');          // path to "css"-folder
define('IMG_PATH', '../public/img/');          // path to "img"-folder

// Include functions and classes
