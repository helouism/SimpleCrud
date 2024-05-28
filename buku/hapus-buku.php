<?php
session_start();

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['username'])) {
    header("Location: /tokobuku/login.php");
    exit();
}

// Connect to the database
include($_SERVER['DOCUMENT_ROOT'] . '/tokobuku/config/config.php');

// Get the book ID from the URL parameter
$book_id = $_GET['id_buku'];

// Prepare the SQL delete statement
$sql = "DELETE FROM data_buku WHERE id_buku = :id_buku";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id_buku', $book_id, PDO::PARAM_INT);

// Execute the delete statement
if ($stmt->execute()) {
    // Redirect to the list of books after successful deletion
    header("Location: data-buku.php");
    exit();
} else {
    echo "Error deleting book data.";
}
