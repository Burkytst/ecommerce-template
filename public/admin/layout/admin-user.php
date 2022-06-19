<?php
	require('../src/config.php');
    require('../src/dbconnect.php');

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

