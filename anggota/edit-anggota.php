<?php
session_start();
// Autentikasi user
if (!isset($_SESSION['username'])) {
  header("Location: /tokobuku/login.php");
  exit();
}
// Konek ke database
include($_SERVER['DOCUMENT_ROOT'] . '/tokobuku/config/config.php');


// Mendapatkan nim
$anggota_id = $_GET['nim'];

// fetch data anggota
$sql = "SELECT * FROM data_anggota WHERE nim = :nim";
$stmt = $db->prepare($sql);
$stmt->bindParam(':nim', $anggota_id, PDO::PARAM_INT);
$stmt->execute();


$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

// Memeriksa apakah form sudah di submit


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nim = $_POST['nim'];
  // Check if the NIM already exists in the database
  $stmt = $db->prepare("SELECT COUNT(*) FROM data_anggota WHERE nim = ?");
  $stmt->execute([$nim]);
  $count = $stmt->fetchColumn();


  $sql = "UPDATE data_anggota SET nama_anggota = :nama_anggota, jenis_kelamin = :jenis_kelamin WHERE nim = :nim";
  $stmt = $db->prepare($sql);


  $stmt->bindParam(':nama_anggota', $_POST['nama_anggota'], PDO::PARAM_STR);
  $stmt->bindParam(':jenis_kelamin', $_POST['jenis_kelamin'], PDO::PARAM_STR);

  $stmt->bindParam(':nim', $anggota_id, PDO::PARAM_INT);


  if ($stmt->execute()) {
    header("Location: /tokobuku/anggota/data-anggota.php");
    exit();
  } else {
    echo "Error updating book data.";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Anggota</title>
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
    <h1 class="text-center mb-4">Edit Anggota</h1>

    <div class="row justify-content-center">
      <div class="col-md-6">

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?nim=' . $anggota_id; ?>">


          <div class="form-group">
            <label for="nama_anggota">Nama:</label>
            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="<?php echo $anggota['nama_anggota']; ?>" required>
          </div>

          <div class="form-group">
            <label for="jenis_kelamin">Gender:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
              <option value="Laki-laki" <?php echo ($anggota['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
              <option value="Perempuan" <?php echo ($anggota['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
          </div>



          <div class="text-center"><input type="submit" class="btn btn-success" value="Update"></div>

        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>