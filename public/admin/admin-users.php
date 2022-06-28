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
    $confirmPassword = trim($_POST['addConfirmPassword']);


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

    if ($password !== $confirmPassword){
        $error .= "Confirmed password incorrect!";
    }

    if ($error) {
        $message = '
        <div class="alert alert-danger" role="alert">
                {$error}
            </div>
        ';
    } else { 
        
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

    echo "<pre>";
    print_r("hatt");
    echo "</pre>"; 

}
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


<?php include "includes/admin_header.php"; ?>

<?php include "includes/admin_sidebar.php"; ?>


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
                                        <span aria-hidden="true">&times;</span>
                                  
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
                        <div class="modal-body">
                            <form action="" method="POST">
                            <div class="form-group">
                            
                            <?=$message ?>

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
            
          


        


</body>

<script>

var addConfirmPassword = $('#addPassword');
var addPassword = $('#addConfirmPassword');

    $('#updateUserBtn').click(function(e) {
    e.preventDefault();

    if (addConfirmPassword !== addPassword){
        $("#add_modal").modal({ backdrop: "static ", keyboard: false });
    }
    else{
 $('#add_modal').modal('toggle'); 
    }
    return false;
});
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>

<?=template_footer()?>
