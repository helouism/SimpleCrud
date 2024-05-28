<?php
session_start();
if (!isset($_SESSION['username'])) {
  // User is not logged in, redirect to the login page
  header("Location: /tokobuku/login.php");
  exit();
}
include($_SERVER['DOCUMENT_ROOT'] . '/tokobuku/config/config.php');


// Menampilkan total anggota
$sql_anggota = "SELECT COUNT(*) as total_anggota FROM data_anggota";
$stmt_anggota = $db->prepare($sql_anggota);
$stmt_anggota->execute();
$result_anggota = $stmt_anggota->fetch(PDO::FETCH_ASSOC);
$total_anggota = $result_anggota['total_anggota'];

// Query for total books
$sql_buku = "SELECT COUNT(*) as total_buku FROM data_buku"; // Assuming you have a 'buku' table
$stmt_buku = $db->prepare($sql_buku);
$stmt_buku->execute();
$result_buku = $stmt_buku->fetch(PDO::FETCH_ASSOC);
$total_buku = $result_buku['total_buku'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="http://localhost/tokobuku/dashboard.php">TokoBuku</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="http://localhost/tokobuku/dashboard.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/tokobuku/anggota/data-anggota.php">Data Anggota</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/tokobuku/buku/data-buku.php">Data Buku</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/tokobuku/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="mt-5 d-flex justify-content-around">
    <h2>Total buku: <?php echo $total_buku; ?> </h2>
    <h2>Total anggota: <?php echo $total_anggota; ?></h2>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>