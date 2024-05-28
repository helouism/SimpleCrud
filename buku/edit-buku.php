<?php
session_start();
// Autentikasi user
if (!isset($_SESSION['username'])) {
  header("Location: /tokobuku/login.php");
  exit();
}
// Konek ke database
include($_SERVER['DOCUMENT_ROOT'] . '/tokobuku/config/config.php');



// Mendapatkan id_buku
$book_id = $_GET['id_buku'];

// fetch data buku
$sql = "SELECT * FROM data_buku WHERE id_buku = :id_buku";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id_buku', $book_id, PDO::PARAM_INT);
$stmt->execute();


$book = $stmt->fetch(PDO::FETCH_ASSOC);

// Memeriksa apakah form sudah di submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if the ISBN already exists in the database
  $stmt = $db->prepare("SELECT COUNT(*) FROM data_buku WHERE isbn = ?");
  $stmt->execute([$isbn]);
  $count = $stmt->fetchColumn();



  // Menyiapkan SQL update statement
  $sql = "UPDATE data_buku SET judul = :judul, penulis = :penulis, penerbit = :penerbit, tahun = :tahun WHERE id_buku = :id_buku";
  $stmt = $db->prepare($sql);

  // Bind the form data to the prepared statement
  $stmt->bindParam(':judul', $_POST['judul'], PDO::PARAM_STR);
  $stmt->bindParam(':penulis', $_POST['penulis'], PDO::PARAM_STR);
  $stmt->bindParam(':penerbit', $_POST['penerbit'], PDO::PARAM_STR);
  $stmt->bindParam(':tahun', $_POST['tahun'], PDO::PARAM_INT);
  $stmt->bindParam(':id_buku', $book_id, PDO::PARAM_INT);

  // Execute the update statement
  if ($stmt->execute()) {
    // Redirect to the list of books after successful update
    header("Location: data-buku.php");
    exit();
  } else {
    echo "Error updating book data.";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Buku</title>
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
    <h1 class="text-center mb-4">Edit Buku</h1>
    <?php if ($warning !== null) : ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $warning; ?>
      </div>
    <?php endif; ?>


    <div class="row justify-content-center">
      <div class="col-md-6">

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_buku=' . $book_id; ?>">
          <div class="form-group">
            <label for="judul">Judul:</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $book['judul']; ?>" required>
          </div>

          <div class="form-group">
            <label for="penulis">Penulis:</label>
            <input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo $book['penulis']; ?>" required>
          </div>


          <div class="form-group">
            <label for="penerbit">Penerbit:</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $book['penerbit']; ?>" required>
          </div>

          <div class="form-group">
            <label for="tahun">Tahun:</label>
            <input type="number" class="form-control" id="tahun" name="tahun" value="<?php echo $book['tahun']; ?>" required>
          </div>



          <div class="text-center">
            <input type="submit" class="btn btn-success" value="Update Buku">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>