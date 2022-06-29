<?php
	require('../../../src/config.php');
    require('../../../src/dbconnect.php');

<<<<<<< HEAD:backup.php
    $message = "";
=======
    

>>>>>>> d26d18bc23ba32f4c1569da29d07fb85ef3d2920:public/admin/admin-users.php

// ------------------ FETCH AREA ------------------



$password  = "";
$confirmPassword = "";
if(isset($_POST['updateUserBtn'])){
    $password        = trim($_POST['password']);
    $updateConfirmPassword = trim($_POST['updateConfirmPassword']);

    if ($password !== $updateConfirmPassword) {
        $message = '
        <div class="alert alert-danger" role="alert">
                Confirmed password incorrect!
            </div>
        ';
    } 
    else { 
  $sql = "UPDATE users
  SET first_name = :first_name, last_name = :last_name, email = :email, phone =:phone, street =:street, postal_code =:postal_code, city =:city, country =:country, password =:password WHERE id = :id";
  $stmt = $dbconnect->prepare($sql);
  $stmt -> bindParam(':id', $_GET['editUserId']);
  $stmt -> bindParam(':first_name', $_POST['first_name']);
  $stmt -> bindParam(':last_name', $_POST['last_name']);
  $stmt -> bindParam(':email', $_POST['email']);
  $stmt -> bindParam(':phone', $_POST['phone']);
  $stmt -> bindParam(':street', $_POST['street']);
  $stmt -> bindParam(':postal_code', $_POST['postal_code']);
  $stmt -> bindParam(':city', $_POST['city']);
  $stmt -> bindParam(':country', $_POST['country']);
  $stmt -> bindParam(':password', $_POST['password']);
  $stmt ->execute();
    }

}



// FETCH ALL USERS:

$sql = "SELECT * FROM users;";
$stmt = $dbconnect->query($sql);
$users = $stmt->fetchAll();

  // UPDATE USER FETCH:

  $fetchOne = "SELECT * FROM users WHERE id = :id;";

  $stmt = $dbconnect->prepare($fetchOne);
  $stmt->bindParam(':id', $_GET["editUserId"]);
  $stmt->execute();
  $editUsers = $stmt->fetch();

<<<<<<< HEAD:backup.php

?>
<?php include "../includes/admin_header.php"; ?>

<?php include "../includes/admin_sidebar.php"; ?>
=======
    $stmt = $dbconnect->prepare($fetchOne);
    $stmt->bindParam(':id', $_GET["editUserId"]);
    $stmt->execute();
    $editUsers = $stmt->fetch();
 

echo "</pre>";

?>
<?php include "includes/admin_header.php"; ?>

<?php include "includes/admin_sidebar.php"; ?>
>>>>>>> d26d18bc23ba32f4c1569da29d07fb85ef3d2920:public/admin/admin-users.php


<!-- SIDANS HUVUDSAKLIGA INNEHÅLL -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Management System</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>




<div id="content-wrapper">
    <div class="container-fluid">
     <h1>User Management System</h1>
     <hr>


					<form action="#add_modal" method="GET">
					<input type="hidden" class='id' name="userId" value="">
					<input type="submit" class='btn btn-primary' data-toggle='modal' data-target='#add_modal' name="addUser" value="Add User">
                    </form> 

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Creation Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="user-list">
                </tbody>

                                        <!-- UPDATE USER MODAL -->

                    <div id="edit_modal" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                                        <span aria-hidden="true">&times;</span>
                                  
                                </div>
                                <div class="modal-body">
                                    <form id="update-user-form" action="" method="POST">
                            
                                        <div class="form-group">
                                            <label for="title">First name</label>
                                            <input type="text" class="form-control" name="first_name" value="<?=htmlentities($editUsers['first_name'])?>">
                                        </div>
																				<div class="form-group">
                                            <label for="title">Last name</label>
                                            <input type="text" class="form-control" name="last_name" value="<?=htmlentities($editUsers['last_name'])?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Email</label>
                                            <input type="text" class="form-control" name="email" value="<?=htmlentities($editUsers['email'])?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Phone</label>
                                            <input type="text" class="form-control" name="phone" value="<?=htmlentities($editUsers['phone'])?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="stock">Street</label>
                                            <input type="text" class="form-control" name="street" value="<?=htmlentities($editUsers['street'])?>">
                                        </div>
																				<div class="form-group">
                                            <label for="stock">Postal code</label>
                                            <input type="text" class="form-control" name="postal_code" value="<?=htmlentities($editUsers['postal_code'])?>">
                                        </div>
																				<div class="form-group">
                                            <label for="stock">City</label>
                                            <input type="text" class="form-control" name="city" value="<?=htmlentities($editUsers['city'])?>">
                                        </div>
																				<div class="form-group">
                                            <label for="stock">Country</label>
                                            <input type="text" class="form-control" name="country" value="<?=htmlentities($editUsers['country'])?>">
                                        </div>

																				<div class="form-group">
                                            <label for="stock">Password</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>

                                        <div class="form-group">
                                            <label for="confirm-password">Confirm Password</label>
                                            <input type="password" class="form-control" name="updateConfirmPassword">
                                        </div>

                                        <div class="form-group">

                                            <input type="submit" class="btn btn-primary" name="updateUserBtn" value="Update User">
                                            <input type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" value="Close">
                                        </div>

                            

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table> 


            <!-- ADD USER MODAL -->

            <div id="add_modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                          
                        </div>
                           <div id="addUser-message"><?=$message?></div>
                        <div class="modal-body">
                            <form action="add-user.php" id="add-user-form" method="POST">
                            <div class="form-group">
                            

                            <div class="form-group">

                                            <label for="title">First name</label>
                                            <input type="text" class="form-control" name="first_name" ">
                                        </div>
																				<div class="form-group">
                                            <label for="title">Last name</label>
                                            <input type="text" class="form-control" name="last_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Email</label>
                                            <input type="text" class="form-control" name="email">
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Phone</label>
                                            <input type="text" class="form-control" name="phone" >
                                        </div>

                                        <div class="form-group">
                                            <label for="stock">Street</label>
                                            <input type="text" class="form-control" name="street">
                                        </div>
                                       
																				
                                        <div class="form-group">
                                            <label for="stock">Postal code</label>
                                            <input type="text" class="form-control" name="postal_code">
                                        </div>
																				
                                        <div class="form-group">
                                            <label for="stock">City</label>
                                            <input type="text" class="form-control" name="city">
                                        </div>
																				<div class="form-group">
                                            <label for="stock">Country</label>
                                            <input type="text" class="form-control" name="country">
                                        </div>

																				<div class="form-group">
                                            <label for="stock">Password</label>
                                            <input type="password" id="addPassword" class="form-control" name="password">
                                        </div>

                                        <div class="form-group">
                                            <label for="confirm-password">Confirm Password</label>
                                            <input type="password" id="addConfirmPassword" class="form-control" name="addConfirmPassword">
                                        </div>

                                        <div class="form-group">

                                            <input type="submit" class="btn btn-primary" name="addUserBtn" value="Add User">
                                            <input type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" value="Close">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
          
        

            <?php include "../includes/admin_footer.php"; ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

            <!-- JS connection -->
<script src="../js/admin-users.js"></script>

            <!-- jQuery and Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
</body>
</html>
