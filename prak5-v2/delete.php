<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

$id = $_GET['id'];
echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
if (delete($id) > 0) {
  echo "
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          swal({
            title: 'Data berhasil dihapus!',
            icon: 'success',
            button: 'OK'
          }).then(function() {
            window.location.href = 'students.php';
          });
        });
      </script>
    ";
} else {
  echo "
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        swal({
          title: 'Data gagal dihapus!',
          icon: 'error',
          button: 'OK'
        }).then(function() {
          window.location.href = 'students.php';
        });
      });
      </script>
    ";
}
