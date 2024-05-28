<?php
session_start();

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['username'])) {
  header("Location: /tokobuku/login.php");
  exit();
}

// Connect to the database
include($_SERVER['DOCUMENT_ROOT'] . '/tokobuku/config/config.php');
$warning = null; // Initialize the warning variable

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $isbn = $_POST['isbn'];

  // Check if the ISBN already exists in the database
  $stmt = $db->prepare("SELECT COUNT(*) FROM data_buku WHERE isbn = ?");
  $stmt->execute([$isbn]);
  $count = $stmt->fetchColumn();

  if ($count > 0) {
    // ISBN already exists, set the warning message
    $warning = "ISBN sudah terdaftar.";
  } else {
    // Prepare the SQL insert statement
    $sql = "INSERT INTO data_buku (judul, penulis, penerbit, tahun, isbn) VALUES (:judul, :penulis, :penerbit, :tahun, :isbn)";
    $stmt = $db->prepare($sql);

    // Bind the form data to the prepared statement
    $stmt->bindParam(':judul', $_POST['judul'], PDO::PARAM_STR);
    $stmt->bindParam(':penulis', $_POST['penulis'], PDO::PARAM_STR);
    $stmt->bindParam(':penerbit', $_POST['penerbit'], PDO::PARAM_STR);
    $stmt->bindParam(':tahun', $_POST['tahun'], PDO::PARAM_INT);
    $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);

    // Execute the insert statement
    if ($stmt->execute()) {
      // Redirect to the list of books after successful insertion
      header("Location: data-buku.php");
      exit();
    } else {
      $warning = "Error adding book data.";
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Tambah Buku</title>
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
            <a class="nav-link " href="http://localhost/tokobuku/dashboard.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  active" aria-current="page" href="http://localhost/tokobuku/anggota/data-anggota.php">Data Anggota</a>
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
  <div class="container my-5">
    <h1 class="text-center mb-4">Tambah Buku</h1>
    <?php if ($warning !== null) : ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $warning; ?>
      </div>
    <?php endif; ?>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <label for="judul">Judul:</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
          </div>
          <div class="form-group">
            <label for="penulis">Penulis:</label>
            <input type="text" class="form-control" id="penulis" name="penulis" required>
          </div>
          <div class="form-group">
            <label for="penerbit">Penerbit:</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" required>
          </div>
          <div class="form-group">
            <label for="tahun">Tahun:</label>
            <input type="number" class="form-control" id="tahun" name="tahun" required>
          </div>
          <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="text" class="form-control" id="isbn" name="isbn" required>
          </div>
          <div class="text-center">
            <input type="submit" class="btn btn-primary" value="Tambah Buku">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>