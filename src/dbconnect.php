<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host 	  = 'localhost';
$database = 'webshop';
$user     = 'root';
$password = '';
$charset  = 'utf8mb4';

//$dns 	  = "mysql:host={$host};dbname={$database};charset={$charset}";
// För MAMP, så kan dns se lite olika ut
//$dns 	  = "mysql:unix_socket=/Application/MAMP/tmp/mysql/mysql.sock;dbname={$database}";

/**
 * Read about setting error mode:
 * https://www.php.net/manual/en/pdo.setattribute.php
 *
 * Read about different fetching styles:
 * https://www.php.net/manual/en/pdostatement.fetch.php
 */
$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Error mode
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch style, fetching associative array
];


// Upprätta en DB koppling
try {
	// Försök köra koden i try-blocket
//	$dbconnect = new PDO($dns, $user, $password, $options);
	$con = mysqli_connect($host, $user, $password, $database);

} catch (\PDOException $e) {
	// Catch-blocket körs om något gick fel i try-blocket
	// echo $e->getMessage();
	// echo $e->getCode();
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
