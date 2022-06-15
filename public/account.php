<?php
	require('../src/config.php');
    require('../src/dbconnect.php');

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

<?=template_header('Account')?>

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

            <h2>Bonus checks</h2>
            <b>Value:</b> $50 <b>Valid thru: </b> 2023-03-12<br />
            <input type="text" value="OKDFUCND2323kfs" style="border: none; background: #abef86;" id="myInput">
            <i class="fas fa-copy" onclick="myFunction()"></i>
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
<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>