<?php
// config.php
$host = "localhost"; // MySQL host name
$db_name = "perpustakaan"; // Database name
$username = "root"; // MySQL username
$password = ""; // MySQL password

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}
?>