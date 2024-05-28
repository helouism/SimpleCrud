<?php
session_start();
// If the user is already logged in, redirect them to the dashboard
if (isset($_SESSION['username'])) {
  header("Location: dashboard.php");
  exit();
}
include($_SERVER['DOCUMENT_ROOT'] . '/tokobuku/config/config.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  // Correct the SQL query
  $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
  $stmt = $db->prepare($sql);

  $params = array(
    ":username" => $username,
    ":password" => $password,
  );

  $saved = $stmt->execute($params);

  if ($saved) {
    header("Location: login.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem">
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4 pb-5">
                <form action="" method="post">
                  <h2 class="fw-bold mb-2 text-uppercase">Registration</h2>
                  <p class="text-white-50 mb-5">
                    Please enter your username and password!
                  </p>

                  <div data-mdb-input-init class="form-outline form-white mb-4">
                    <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                    <label class="form-label" for="typeUsername">Username</label>
                  </div>

                  <div data-mdb-input-init class="form-outline form-white mb-4">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                    <label class="form-label" for="typePasswordX">Password</label>
                  </div>

                  <p class="small mb-5 pb-lg-2">
                    <a class="text-white-50" href="#!">Forgot password?</a>
                  </p>

                  <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit" name="register">
                    Register
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>