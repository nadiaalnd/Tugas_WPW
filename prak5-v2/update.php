<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
$id = $_GET['id'];
$mahasiswa = query("SELECT * FROM mahasiswa WHERE id = '$id'")[0];
if (isset($_POST["submit"])) {
  if (update($_POST) > 0) {
    echo "
      <script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'students.php';
      </script>
    ";
  } else {
    echo "
    <script>
        alert('Data gagal ditambahkan!');
        document.location.href = 'students.php';
      </script>
    ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Title -->
  <title>Study Portal</title>

  <?php include 'template/css.php' ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'template/sidebar.php' ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include 'template/topbar.php' ?>
        <!-- End of Topbar -->

        <div class="container">
          <!-- Outer Row -->
          <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
              <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Edit Data Mahasiswa</h1>
                    </div>

                    <!-- Form Start -->
                    <form class="user" action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?= $mahasiswa['id']; ?>">
                      <input type="hidden" name="gambarLama" value="<?= $mahasiswa['pic_profile']; ?>">
                      <div class="form-group">
                        <label for="pic_profile">Gambar Profil</label>
                        <div class="text-center">
                          <div class="card" style="width: 18rem;">
                            <img id="gambar_profil" src="assets/<?= $mahasiswa['pic_profile']; ?>" alt="Profile Picture" style="max-width:300px;">
                            <div class="card-body">
                              <label for="pic_profile" class="custom-file-upload">
                                <i class="fas fa-upload"></i> Choose a file
                                <input type="file" name="pic_profile" id="pic_profile" onchange="previewImage(event)">
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="nrp">NRP</label>
                        <input type="text" class="form-control form-control-user" name="nrp" id="nrp" required value="<?= $mahasiswa["nrp"]; ?>">
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control form-control-user" name="nama" id="nama" required value="<?= $mahasiswa["nama"]; ?>">
                      </div>
                      <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" class="form-control form-control-user" name="jurusan" id="jurusan" required value="<?= $mahasiswa["jurusan"]; ?>">
                      </div>
                      <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control" style="border-radius: 40px !important; color:#6e707e; font-size: 14px;;" name="gender" id="gender" required>
                          <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                          <option value="laki-laki" <?= ($mahasiswa['gender'] == "laki-laki") ? "selected" : ""; ?>>Laki-laki</option>
                          <option value="perempuan" <?= ($mahasiswa['gender'] == "perempuan") ? "selected" : ""; ?>>Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="email">Email Mahasiswa</label>
                        <input type="text" class="form-control form-control-user" name="email" id="email" required value="<?= $mahasiswa["email"]; ?>">
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control form-control-user" name="alamat" id="alamat" required><?= $mahasiswa["alamat"]; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="no_hp">No Telepon</label>
                        <input type="text" class="form-control form-control-user" name="no_hp" id="no_hp" required value="<?= $mahasiswa["no_hp"]; ?>">
                      </div>
                      <div class="form-group">
                        <label for="asal_sma">Asal SLTA</label>
                        <input type="text" class="form-control form-control-user" name="asal_sma" id="asal_sma" required value="<?= $mahasiswa["asal_sma"]; ?>">
                      </div>
                      <div class="form-group">
                        <label for="matkul_fav">Mata Kuliah Favorit</label>
                        <input type="text" class="form-control form-control-user" name="matkul_fav" id="matkul_fav" required value="<?= $mahasiswa["matkul_fav"]; ?>">
                      </div>
                      <div class="d-flex flex-wrap">
                        <button type="submit" name="submit" class="btn btn-primary btn-user mr-3 mb-3">Submit</button>
                        <a href="students.php" class="btn btn-secondary btn-user mb-3">Cancel</a>
                      </div>
                      <hr>
                    </form>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>

        <!-- Footer -->
        <?php include 'template/footer.php' ?>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include 'template/logout-modal.php' ?>

    <!-- Bootstrap core JavaScript-->
    <?php include 'template/js.php' ?>

</body>

<script>
  // Data Tables
  $(document).ready(function() {
    $('.table').DataTable();
  });

  // SweetAlert
  function confirmDelete(id) {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Data yang dihapus tidak dapat dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#4E73DF',
      cancelButtonColor: '#858796',
      confirmButtonText: 'Ya, hapus data!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "delete.php?id=" + id;
      } else {
        Swal.fire(
          'Batal',
          'Data tidak jadi dihapus',
          'error'
        )
      }
    })
  }

  function confirmEdit(id) {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#4E73DF',
      cancelButtonColor: '#858796',
      confirmButtonText: 'Ya, ubah data!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "update.php?id=" + id;
      }
    })
  }

  function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function() {
      var dataURL = reader.result;
      var gambar_profil = document.getElementById('gambar_profil');
      gambar_profil.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
  }
</script>

</html>