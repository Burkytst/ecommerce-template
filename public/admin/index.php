<?php
	require('../../src/config.php');
    require('../../src/dbconnect.php');

    // if (!isset($_SESSION['loggedin'])) {

    //     header('Location: index.html');
        
    //     exit;
        
    //     }
?>


<?php include "./includes/admin_header.php"; ?>

<div id="wrapper">

<?php include "./includes/admin_sidebar.php"; ?>  

<div id="content-wrapper">
<div class="container-fluid"> 

<?php include "./includes/admin_footer.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<p>Welcome, <?=$_SESSION['name']?>!</p>
    
</body>
</html>