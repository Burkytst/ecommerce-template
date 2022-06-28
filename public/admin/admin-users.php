<?php
	require('../../src/config.php');
    require('../../src/dbconnect.php');


// ------------------ DELETE, EDIT and ADD BUTTONS ------------------


		// DELETE USERS

if(isset($_POST["deleteUser"])){
 $sql = "DELETE FROM users WHERE id = :id;";

 $stmt = $dbconnect->prepare($sql);
 $stmt->bindParam(':id', $_POST["userId"]);
 $stmt->execute();
}

// EDIT USER



if(isset($_POST['updateUserBtn'])){
	$sql = "UPDATE users
	SET first_name = :first_name, last_name = :last_name, email = :email, phone =:phone, street =:street, postal_code =:postal_code, city =:city, country =:country, updatePassword =:password WHERE id = :id";
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
	$stmt -> bindParam(':password', $_POST['updatePassword']);
	$stmt ->execute();

}

// ADD USER


$message         = "";
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
$create_date     =  "";

if (isset($_POST['addUserBtn'])) {
    $email           = mysqli_real_escape_string($db, $_POST['email']);
    $first_name      = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name       = mysqli_real_escape_string($db, $_POST['last_name']);
    $phone           = mysqli_real_escape_string($db, $_POST['phone']);
    $street          = mysqli_real_escape_string($db, $_POST['street']);
    $postal_code     = mysqli_real_escape_string($db, $_POST['postal_code']);
    $city            = mysqli_real_escape_string($db, $_POST['city']);
    $country         = mysqli_real_escape_string($db, $_POST['country']);
    $password_1      = mysqli_real_escape_string($db, $_POST['addPassword']);
    $password_2      = mysqli_real_escape_string($db, $_POST['addConfirmPassword']);
    $create_date     = date("Y-m-d");

    $password    = password_hash($password_1, PASSWORD_DEFAULT);
    $admin = 1;

    echo "hej";


        
    $sql = "INSERT INTO users (phone, email, password, first_name, last_name, street, postal_code, city, country, create_date, admin) 
    VALUES('$phone', '$email', '$password', '$first_name', '$last_name', '$street', '$postal_code', '$city', '$country', '$create_date', '$admin')";
 
    echo "<pre>";
    print_r($sql);
    echo "</pre>"; 

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
    $stmt -> bindParam(':create_date', $create_date);
    $stmt -> bindParam(':admin', $admin);
    $stmt -> execute();




}
 


// ------------------ FETCH AREA ------------------

// FETCH ALL USERS:

$sql = "SELECT * FROM users;";
$stmt = $dbconnect->query($sql);
$users = $stmt->fetchAll();


// EDIT USER FETCH:


    $fetchOne = "SELECT * FROM users WHERE id = :id;";

    $stmt = $dbconnect->prepare($fetchOne);
    $stmt->bindParam(':id', $_GET["editUserId"]);
    $stmt->execute();
    $editUsers = $stmt->fetch();
 
    echo "<pre>";
print_r($_GET);
echo "</pre>";

?>

<?=template_header('Home')?>




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
                <tbody>

                
            
                    <tr>
										<?php foreach($users as $user)  {  ?> 
											<td><?=htmlentities($user['id'])?></td>
                        <td><?=htmlentities($user['first_name'])?></td>
												<td><?=htmlentities($user['email'])?></td>
												<td><?=htmlentities($user['country'])?></td>
												<td><?=htmlentities($user['create_date'])?></td>
                       
                        <td>
                            <div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Actions
                                </button>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>

																<form action="#edit_modal" method="GET">
																<input type="hidden" class='id' name="editUserId" value="<?=htmlentities($user['id'])?>">
																<input type="submit" data-toggle='modal' data-target='#edit_modal' class='dropdown-item' name="editUserBtn" value="Edit"></form>  
                                
                                    <div class='dropdown-divider'></div>
	
																	<form action="" method="POST">
																	<input type="hidden" class='id' name="userId" value="<?=htmlentities($user['id'])?>">
																			<input type="submit" class='dropdown-item' name="deleteUser" value="Delete"></form>           
                            </div>
                        </td>
                    </tr>
										<?php } ?>



                                        <!-- EDIT USER MODAL -->

                    <div id="edit_modal" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">

                                    <?=$message ?>
                            
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
                                            <input type="password" class="form-control" name="updatePassword">
                                        </div>

                                        <div class="form-group">
                                            <label for="confirm-password">Confirm Password</label>
                                            <input type="password" class="form-control" name="updateConfirmPassword">
                                        </div>

                                        <div class="form-group">

                                            <input type="submit" class="btn btn-primary" name="updateUserBtn" value="Update User">
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
                        <div class="modal-body">
                            <form action="" method="POST">
                            <div class="form-group">
                            <?=$message ?>
                            <div class="form-group">

                                            <label for="title">First name</label>
                                            <input type="text" class="form-control" name="first_name" value="<?=htmlentities($first_name) ?>">
                                        </div>
																				<div class="form-group">
                                            <label for="title">Last name</label>
                                            <input type="text" class="form-control" name="last_name" value="<?=htmlentities($last_name) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Email</label>
                                            <input type="text" class="form-control" name="email" value="<?=htmlentities($email) ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Phone</label>
                                            <input type="text" class="form-control" name="phone" value="<?=htmlentities($phone) ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="stock">Street</label>
                                            <input type="text" class="form-control" name="street" value="<?=htmlentities($street) ?>">
                                        </div>
                                       
																				
                                        <div class="form-group">
                                            <label for="stock">Postal code</label>
                                            <input type="text" class="form-control" name="postal_code" value="<?=htmlentities($postal_code) ?>">
                                        </div>
																				
                                        <div class="form-group">
                                            <label for="stock">City</label>
                                            <input type="text" class="form-control" name="city" value="<?=htmlentities($city) ?>">
                                        </div>
																				<div class="form-group">
                                            <label for="stock">Country</label>
                                            <input type="text" class="form-control" name="country" value="<?=htmlentities($country) ?>">
                                        </div>

																				<div class="form-group">
                                            <label for="stock">Password</label>
                                            <input type="password" class="form-control" name="addPassword" value="<?=htmlentities($password) ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="confirm-password">Confirm Password</label>
                                            <input type="password" class="form-control" name="addConfirmPassword" value="<?=htmlentities($confirmPassword) ?>">
                                        </div>

                                        <div class="form-group">

                                            <input type="submit" class="btn btn-primary" name="addUserBtn" value="Add User">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
          





</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>

<?=template_footer()?>