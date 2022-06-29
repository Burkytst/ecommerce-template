
<?php

require('../../../src/config.php');
require('../../../src/dbconnect.php');

$message = "";

// ADD USER


$message  = "";
$error = "";
$id  = "";
$first_name = "";
$last_name = "";
$email    = "";
$phone    = "";
$street    = "";
$postal_code    = "";
$city    = "";
$country    = "";
$password  = "";
$confirmPassword = "";
if (isset($_POST['addUserBtn'])) {
    $first_name        = trim($_POST['first_name']);
    $last_name        = trim($_POST['last_name']);
    $email           = trim($_POST['email']);
    $phone           = trim($_POST['phone']);
    $street           = trim($_POST['street']);
    $postal_code           = trim($_POST['postal_code']);
    $city           = trim($_POST['city']);
    $country           = trim($_POST['country']);
    $password        = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);


  if (empty($first_name)){
      $error = "Please write your first name in the form <br>";
  }
  
  if (empty($last_name)){
      $error .= "Please write your last name in the form<br>";
  }
  
  if (empty($email)){
      $error .= "Please write your email in the form<br>";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $error .= "Your email is incorrect<br>";
  }
  
  if (empty($phone)){
      $error .= "Please write your phone number in the form<br>";
  }
  
  if (empty($street)){
      $error .= "Please write your street in the form<br>";
  }
  
  if (empty($postal_code)){
      $error .= "Please write your postal code in the form<br>";
  }
  
  if (empty($city)){
      $error .= "Please write your city in the form<br>";
  }
  
  if (empty($country)){
      $error .= "Please write your country in the form<br>";
  }
   
  if (empty($password)){
      $error .= "Please write your pasword in the form<br>";
  }

  if ($password !== $confirmPassword){
      $error .= "Confirmed password incorrect!<br>";
  }

  if ($error) {
    $message = "$error;"
    
  } else { 
    $message = "Sucess! You have uploaded a new user!";
        $sql = " INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
        VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country);
    ";

    $stmt = $dbconnect->prepare($sql);
    $stmt -> bindParam(':first_name', $first_name);
    $stmt -> bindParam(':last_name', $last_name);
    $stmt -> bindParam(':email', $email);
    $stmt -> bindParam(':password', $password);
    $stmt -> bindParam(':phone', $phone);
    $stmt -> bindParam(':street', $street);
    $stmt -> bindParam(':postal_code', $postal_code);
    $stmt -> bindParam(':city', $city);
    $stmt -> bindParam(':country', $country);
    $stmt -> execute();

   

}
}
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<h2>Add New User</h2>



<div id="addUser-message"><?=$message?></div>

<form action="" method="POST">
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">First name</label>
      <input type="text" class="form-control" name="first_name" id="first-name" placeholder="First name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Last name</label>
      <input type="text" name="last_name" class="form-control" id="last-Name" placeholder="Last name">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Phone</label>
      <input type="text" name="phone" class="form-control" id="phone" placeholder="Number">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Street</label>
    <input type="text" class="form-control" name="street" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Country</label>
      <input type="text" class="form-control" name="country" id="inputCountry">
    </div>
    <div class="form-group col-md-4">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" name="city" id="inputCity">
    </div>
    <div class="form-group col-md-2">
      <label for="inputCity">Postal code</label>
      <input type="text" class="form-control" name="postal_code" id="inputPostal">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm password">
    </div>
  </div>
  </div>
  
  <div class="form-group">

<input type="submit" class="btn btn-primary" name="addUserBtn" value="Add User">
<input type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" value="Go back">
</div>
</form>
  

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
</body>
</html>