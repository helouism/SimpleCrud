<?php
session_start();

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['username'])) {
    header("Location: /tokobuku/login.php");
    exit();
}

// Connect to the database
include($_SERVER['DOCUMENT_ROOT'] . '/tokobuku/config/config.php');

// Get the NIM from the URL parameter
$anggota_id = $_GET['nim'];

// Prepare the SQL delete statement
$sql = "DELETE FROM data_anggota WHERE nim = :nim";
$stmt = $db->prepare($sql);
$stmt->bindParam(':nim', $anggota_id, PDO::PARAM_INT);

// Execute the delete statement
if ($stmt->execute()) {
    // Redirect to the list of books after successful deletion
    header("Location: /tokobuku/anggota/data-anggota.php");
    exit();
} else {
    echo "Error deleting book data.";
}
