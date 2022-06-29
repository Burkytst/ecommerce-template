<?php


if (isset($_POST['placeorder']) && isset($_SESSION['cart'])) {
    
    echo "<pre>";
    print_r($_SESSION['id']);
    echo "</pre>"; 
    
    $userID =  $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE id=$userID";
    $stmt = $dbconnect->query($sql);
    $user = $stmt->fetch();
}
?>