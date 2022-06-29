<?php
	require('../../../src/config.php');
  require('../../../src/dbconnect.php');

  if(isset($_POST["deleteUser"])){
    $sql = "DELETE FROM users WHERE id = :id;";
   
    $stmt = $dbconnect->prepare($sql);
    $stmt->bindParam(':id', $_POST["userId"]);
   $stmt->execute();
   }


header('Location: admin-users.php');
exit;

   ?>