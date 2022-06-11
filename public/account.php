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

$pointsLeft = 2000 - $user['points'];

?>

<div id="wrapper">
    <h1>Account</h1>
    <p>Welcome back, <?=$_SESSION['name']?>!</p>
    <div class="row">
        <div class="col mb-5 mt-3 mb-lg-0">
            <h2>My information</h2>
            <p>Email: <?=htmlentities($user['email'])?></p>
            <p>Phone: <?=htmlentities($user['phone'])?></p>
            <p>Street: <?=htmlentities($user['street'])?></p>
            <p>Postal code: <?=htmlentities($user['postal_code'])?></p>
            <p>City: <?=htmlentities($user['city'])?></p>
            <p>Country: <?=htmlentities($user['country'])?></p>

        </div>
        <div class="col mb-5 mt-3 mb-lg-0">
            <h2>Points</h2>
            <h1 class="pointsRed"><?=htmlentities($user['points'])?></h1>
            <p>Points left to bonus: <?=$pointsLeft?></p>
        </div>
    </div>
    <div class="row">    
        <div class="col mb-5 mt-3 mb-lg-0">
            <h2>Orders</h2>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">134242</th>
                    <td>2022-01-14</td>
                    <td>In transit</td>
                    </tr>
                    <tr>
                    <th scope="row">2454353</th>
                    <td>1979-12-22</td>
                    <td>Delivered</td>
                    </tr>
                    <tr>
                    <th scope="row">35435345</th>
                    <td>1978-02-20</td>
                    <td>Delivered</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
        <div class="col mb-4 mt-3 mb-lg-0">
            <h2>Returns</h2>
        </div>
    </div>
</div>