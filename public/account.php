<?php include('layout/header.php');

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = $id";
$stmt = $dbconnect->query($sql);
$user = $stmt->fetch();


?>

<div id="wrapper">
    <h1>Account</h1>
    <p>Welcome back, <?=$_SESSION['name']?>!</p>

    <div class="col-lg-4 col-md-12 mb-5 mt-3 mb-lg-0">
        <h2>My information</h2>
        <p>Email: <?=htmlentities($user['email'])?></p>
        <p>Phone: <?=htmlentities($user['phone'])?></p>
        <p>Street: <?=htmlentities($user['street'])?></p>
        <p>Postal code: <?=htmlentities($user['postal_code'])?></p>
        <p>City: <?=htmlentities($user['city'])?></p>
        <p>Country: <?=htmlentities($user['country'])?></p>

	</div>
    <div class="col-lg-4 col-md-12 mb-5 mt-3 mb-lg-0">
        <h2>Orders</h2>
        
	</div>
    <div class="col-lg-4 col-md-12 mb-4 mt-3 mb-lg-0">
        <h2>Returns</h2>
	</div>
</div>