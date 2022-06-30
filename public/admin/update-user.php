<?php
	require('../../src/config.php');
  require('../../src/dbconnect.php');




  // UPDATE USER

$message         = "";
$error           = "";
$id              = "";
$first_name      = "";
$last_name       = "";
$email           = "";
$phone           = "";
$street          = "";
$postal_code     = "";
$city            = "";
$country         = "";
$password        = "";
$confirmPassword = "";
$admin           = "";


if (isset($_POST['updateUserBtn'])) {
    $first_name       = trim($_POST['first_name']);
    $last_name       = trim($_POST['last_name']);
    $email           = trim($_POST['email']);
    $phone           = trim($_POST['phone']);
    $street          = trim($_POST['street']);
    $postal_code     = trim($_POST['postal_code']);
    $city            = trim($_POST['city']);
    $country         = trim($_POST['country']);
    $password        = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    $admin          = trim($_POST['admin']);


if (empty($first_name)){
  $error = "Please write your first name in the form";
}

if (empty($last_name)){
  $error .= "Please write your last name in the form";
}

if (empty($email)){
  $error .= "Please write your email in the form";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $error .= "Your email is incorrect";
}

if (empty($phone)){
  $error .= "Please write your phone number in the form";
}

if (empty($street)){
  $error .= "Please write your street in the form";
}

if (empty($postal_code)){
  $error .= "Please write your postal code in the form";
}

if (empty($city)){
  $error .= "Please write your city in the form";
}

if (empty($country)){
  $error .= "Please write your country in the form";
}

if (empty($password)){
  $error .= "Please write your pasword in the form";
}

if ($error) {
  $message = $error;
}        
    else { 
      $message = '<div class="alert alert-success" role="alert"> Success! You have updated the user! </div>';

      $sql = "UPDATE users
      SET first_name = :first_name, last_name = :last_name, email = :email, phone =:phone, street =:street, postal_code =:postal_code, city =:city, country =:country, password =:password, admin =:admin 
      WHERE id = :id";

      $stmt = $dbconnect->prepare($sql);
      $stmt -> bindParam(':id', $_GET['editUserId']);
      $stmt -> bindParam(':first_name', $first_name);
      $stmt -> bindParam(':last_name', $last_name);
      $stmt -> bindParam(':email', $email);
      $stmt -> bindParam(':password', $password);
      $stmt -> bindParam(':phone', $phone);
      $stmt -> bindParam(':street', $street);
      $stmt -> bindParam(':postal_code', $postal_code);
      $stmt -> bindParam(':city', $city);
      $stmt -> bindParam(':country', $country);
      $stmt -> bindParam(':admin', $admin);
      $stmt->execute();
    
  }
}

    // UPDATE USER FETCH:

    $fetchOne = "SELECT * FROM users WHERE id = :id;";

    $stmt = $dbconnect->prepare($fetchOne);
    $stmt->bindParam(':id', $_GET["editUserId"]);
    $stmt->execute();
    $editUsers = $stmt->fetch();

  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/sb-admin-2.css"></head>
<body class="m-3">


<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

<?php include "includes/admin_sidebar.php"; ?>
<div id="content-wrapper" class="pt-3">
    <div class="container-fluid m-3 mt-3">

<h2 class="display-4">Update User</h2>



<div id="addUser-message"><?=$message?></div>

<form action="" method="POST">
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">First name</label>
      <input type="text" class="form-control" name="first_name" id="first-name" placeholder="First name" value="<?=htmlentities($editUsers['first_name'])?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Last name</label>
      <input type="text" name="last_name" class="form-control" id="last-Name" placeholder="Last name" value="<?=htmlentities($editUsers['last_name'])?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" value="<?=htmlentities($editUsers['email'])?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Phone</label>
      <input type="text" name="phone" class="form-control" id="phone" placeholder="Number" value="<?=htmlentities($editUsers['phone'])?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Street</label>
    <input type="text" class="form-control" name="street" id="inputAddress" placeholder="1234 Main St" value="<?=htmlentities($editUsers['street'])?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Country</label>
      <input type="text" class="form-control" name="country" id="inputCountry" value="<?=htmlentities($editUsers['country'])?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" name="city" id="inputCity" value="<?=htmlentities($editUsers['city'])?>">
    </div>
    <div class="form-group col-md-2">
      <label for="inputCity">Postal code</label>
      <input type="text" class="form-control" name="postal_code" id="inputPostal" value="<?=htmlentities($editUsers['postal_code'])?>">
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

  <div class="form-check mb-3">
    <input type="radio" name="admin" id="customer" value="0">Customer<br>
    <input type="radio" name="admin" id="admin" value="1">Admin<br>
  </div>
  
  <div class="form-group">

  <input type="submit" class="btn btn-primary" name="updateUserBtn" value="Update User">
  <a href="admin-users.php" class="btn btn-primary" role="button">Go back</a>
</div>
  </div>
</div>
</div>
</form>
  
</body>
</html>

<?php include "includes/admin_footer.php"; ?>