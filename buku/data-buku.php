<?php
session_start();
if (!isset($_SESSION['username'])) {
  // User is not logged in, redirect to the login page
  header("Location: /tokobuku/login.php");
  exit();
}
include($_SERVER['DOCUMENT_ROOT'] . '/tokobuku/config/config.php');

// Prepare the SQL query
$sql = "SELECT * FROM data_buku";
$stmt = $db->prepare($sql);
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    tr:hover {
      background-color: #f5f5f5;
    }
  </style>
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
            <a class="nav-link " href="http://localhost/tokobuku/dashboard.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/tokobuku/anggota/data-anggota.php">Data Anggota</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="http://localhost/tokobuku/buku/data-buku.php">Data Buku</a>
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


  <div class="container my-5">
    <h1>Data buku</h1>
    <table>
      <tr>
        <th>No</th>
        <th>ISBN</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Tahun</th>
        <th>Action</th>
      </tr>
      <?php foreach ($results as $book) : ?>
        <tr>
          <td><?php echo $book['id_buku']; ?></td>
          <td><?php echo $book['isbn']; ?></td>
          <td><?php echo $book['judul']; ?></td>
          <td><?php echo $book['penulis']; ?></td>
          <td><?php echo $book['penerbit']; ?></td>
          <td><?php echo $book['tahun']; ?></td>
          <td>
            <a class="btn btn-primary" href="edit-buku.php?id_buku=<?php echo $book['id_buku']; ?>"><i class="fa-solid fa-pencil" style="color: #ffffff;"></i></a>
            <a class="btn btn-danger" href="hapus-buku.php?id_buku=<?php echo $book['id_buku']; ?>" onclick="return confirm('Are you sure you want to delete this book?')"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
          </td>

        </tr>
      <?php endforeach; ?>
    </table>
    <a class="btn btn-primary" href="tambah-buku.php">Tambah Buku</a>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>