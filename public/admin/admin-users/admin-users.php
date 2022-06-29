<?php
	require('../../../src/config.php');
    require('../../../src/dbconnect.php');
    
    include "../includes/admin_header.php";
   


// ------------------ DELETE ------------------


if(isset($_POST["deleteUser"])){
 $sql = "DELETE FROM users WHERE id = :id;";

 $stmt = $dbconnect->prepare($sql);
 $stmt->bindParam(':id', $_POST["userId"]);
$stmt->execute();
}



// ------------------ FETCH ------------------

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


// -------------------



?>




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


<form action="adding-user.php" method="GET" class="mb-3">
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
    Actions</button>
<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>

<form action="update-user.php" method="GET">
<input type="hidden" class='id' name="editUserId" value="<?=htmlentities($user['id'])?>">
<input type="submit" data-toggle='modal' class='dropdown-item' name="editUserBtn" value="Edit"></form>  
                                
<div class='dropdown-divider'></div>
	
<form action="" method="POST">
<input type="hidden" class='id' name="userId" value="<?=htmlentities($user['id'])?>">
<input type="submit" class='dropdown-item' name="deleteUser" value="Delete"></form>           
</div>
</td>
</tr>
										<?php } ?>



    

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


