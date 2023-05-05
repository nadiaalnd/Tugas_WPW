<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- x-icon-->
  <link rel="shortcut icon" href="assets/img/logo-white.png" type="image/x-icon">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- SweetAlert2 library -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-primary">
  <?php
  session_start();
  require 'functions.php';

  // check cookie 
  if (isset($_COOKIE['core']) && isset($_COOKIE['key'])) {
    // id
    $core = $_COOKIE['core'];
    // pw
    $key = $_COOKIE['key'];

    // get username by id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = '$core'");
    $row = mysqli_fetch_assoc($result);

    // check cookie and username
    if ($key === hash('sha256', $row['username'])) {
      $_SESSION['login'] = true;
    }
  }

  // check session
  if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
  }

  if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // check username
    if (mysqli_num_rows($result) === 1) {
      // check password
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
        // set Session
        $_SESSION["login"] = true;
        // check remember me
        if (isset($_POST['remember'])) {
          // cookie
          setcookie('core', $row['id'], time() + 60);
          setcookie('key', hash('sha256', $row['username']), time() + 60);
        }
        header("Location: index.php");
        exit;
      }
    }
    // If login fails, show error message
    echo "<script>
          Swal.fire({
            title: 'Login Gagal!',
            text: 'Username atau password salah',
            icon: 'error',
            confirmButtonColor : '#4E73DF',
            confirmButtonText: 'OK'
          });
        </script>";
  }

  ?>
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                <img src="assets/img/login.png" style="max-width: 450px" alt="Robot Login Picture">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" action="" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                        <label class="custom-control-label" for="remember">Remember
                          Me</label>
                      </div>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block">Login</button>
                    <hr>
                    <div class="text-center">
                      <a class="small" href="register.php">Create an Account!</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</html>