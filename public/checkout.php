<?php

    require('../src/dbconnect.php');

if (isset($_POST['placeorder']) && isset($_SESSION['cart'])) {
    
    echo "<pre>";
    print_r($_SESSION['cart']);
    echo "</pre>"; 

    $userID =  $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE id=$userID";
    $stmt = $dbconnect->query($sql);
    $user = $stmt->fetch();
	
    $total_price = $_POST['totalprice'];
    $full_name = $user['first_name'] . " " . $user['last_name'];
    $street	= $user['street'];
    $postal_code = $user['postal_code'];
    $city = $user['city'];
    $country = $user['country'];
    $create_date = date("Y/m/d H:i:s");
    $points = $total_price;
    $newpoints = $points + $user['points'];


    $sql = "INSERT INTO orders (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country, create_date, points) 
    VALUES('$userID', '$total_price', '$full_name', '$street', '$postal_code', '$city', '$country', '$create_date', '$points')";

    $stmt = $dbconnect->prepare($sql);
    $stmt -> bindParam(':user_id', $userID);
    $stmt -> bindParam(':billing_full_name', $last_name);
    $stmt -> bindParam(':billing_street', $email);
    $stmt -> bindParam(':billing_postal_code', $password);
    $stmt -> bindParam(':billing_city', $phone);
    $stmt -> bindParam(':billing_country', $street);
    $stmt -> bindParam(':create_date', $create_date);
    $stmt -> bindParam(':points', $points);
    
    $stmt -> execute();

    $sql2 = "UPDATE users SET points = $newpoints WHERE id=$userID";

	$stmt = $dbconnect->prepare($sql2);
	$stmt -> bindParam(':points', $newpoints);
	$stmt ->execute();

    unset($_SESSION['cart']);
    header('location: cart.php?msg=success');

}
?>
