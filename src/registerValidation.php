<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require('dbconnect.php');

// initializing variables
$id = "";
$email         = "";
$first_name    = "";
$last_name     = "";
$phone         = "";
$street        = "";
$postal_code   = "";
$city          = "";
$country       = "";

$errors = array(); 

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'webshop';
// Try and connect using the info above.
$db = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_error() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}



// REGISTER USER
if (isset($_POST['regForm'])) {
  // receive all input values from the form
  $email           = mysqli_real_escape_string($db, $_POST['email']);
  $first_name      = mysqli_real_escape_string($db, $_POST['first_name']);
  $last_name       = mysqli_real_escape_string($db, $_POST['last_name']);
  $phone           = mysqli_real_escape_string($db, $_POST['phone']);
  $street          = mysqli_real_escape_string($db, $_POST['street']);
  $postal_code     = mysqli_real_escape_string($db, $_POST['postal_code']);
  $city            = mysqli_real_escape_string($db, $_POST['city']);
  $country         = mysqli_real_escape_string($db, $_POST['country']);

  $password_1      = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2      = mysqli_real_escape_string($db, $_POST['password_2']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($first_name)) { array_push($errors, "First name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }



  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  echo '<pre>'; print_r($errors); echo '</pre>';

  // Finally, register user if there are no errors in the form
  // if (count($errors) == 0) {
    
  	$password    = password_hash($password_1, PASSWORD_DEFAULT);//encrypt the password before saving in the database
    $create_date = date("Y/m/d");
  
  	$query = "INSERT INTO users (phone, email, password, first_name, last_name, street, postal_code, city, country, create_date, admin) 
  			  VALUES('$phone', '$email', '$password', '$first_name', '$last_name', '$street', '$postal_code', '$city', '$country', '$create_date', 1)";

    $stmt = $dbconnect->prepare($query);
    $stmt -> bindParam(':first_name', $first_name);
    $stmt -> bindParam(':last_name', $last_name);
    $stmt -> bindParam(':email', $email);
    $stmt -> bindParam(':password', $password);
    $stmt -> bindParam(':phone', $phone);
    $stmt -> bindParam(':street', $street);
    $stmt -> bindParam(':postal_code', $postal_code);
    $stmt -> bindParam(':city', $city);
    $stmt -> bindParam(':country', $country);
    $stmt -> bindParam(':create_date', $create_date);
    $stmt -> bindParam(':admin', $admin);
    $stmt->execute();
    
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: ../public/index.php');
  // }
}
?>