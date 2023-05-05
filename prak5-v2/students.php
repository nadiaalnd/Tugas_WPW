<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

if (isset($_POST["submit"])) {
  if (add($_POST) > 0) {
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

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Biodata</h1>

          <!-- DataTables -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="row">
                <!-- Button trigger modal -->
                <button type="button" style="margin-right: 8px !important;" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addDataModal">
                  <i class="fas fa-plus"></i> Data
                </button>
                <!-- <button class="btn btn-primary mb-3" href="print.php" type="button">
                  <i class="fas fa-solid fa-print"></i> Export PDF
                </button> -->
              </div>
            </div>

            <!-- Table -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NRP</th>
                      <th>Nama</th>
                      <th>Jurusan</th>
                      <td>Jenis Kelamin</td>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($mahasiswa as $row) : ?>
                      <tr>
                        <th scope=""><?= $i; ?></th>
                        <td><?= $row["nrp"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["jurusan"]; ?></td>
                        <td><?= $row["gender"]; ?></td>
                        <td>
                          <a class="btn btn-info btn-circle" data-toggle="modal" data-target="#exampleModal<?= $row['id'] ?>">
                            <i class="fas fa-info-circle"></i>
                          </a>
                          <a class="btn btn-warning btn-circle text-white" href="javascript:void(0)" onclick="confirmEdit(<?= $row['id'] ?>)" role="button">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a class="btn btn-danger btn-circle" href="javascript:void(0)" onclick="confirmDelete(<?= $row['id'] ?>)" role="button">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><?= $row["nama"]; ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <ul class="list-group"> 
                                <div class="text-center">
                                  <li class="list-group-item">
                                    <img class="rounded mx-auto d-block" src="assets/<?= $row["pic_profile"]; ?>" alt="Profile Picture" style="max-width:250px;">
                                    <br>
                                    <a class="btn btn-primary btn-user mr-3 mb-3" href="download.php?url=<?= $row['pic_profile'] ?>">
                                      <i class="fas fa-solid fa-download"></i> Download
                                    </a>
                                  </li>
                                </div>
                                <li class="list-group-item"><strong>NRP : </strong> <?= $row["nrp"]; ?></li>
                                <li class="list-group-item"><strong>Jurusan : </strong> <?= $row["jurusan"]; ?></li>
                                <li class="list-group-item"><strong>Jenis Kelamin : </strong> <?= $row["gender"]; ?></li>
                                <li class="list-group-item"><strong>Email : </strong> <?= $row["email"]; ?></li>
                                <li class="list-group-item"><strong>Alamat : </strong> <?= $row["alamat"]; ?></li>
                                <li class="list-group-item"><strong>No Telepon : </strong> <?= $row["no_hp"]; ?></li>
                                <li class="list-group-item"><strong>Asal SLTA : </strong> <?= $row["asal_sma"]; ?></li>
                                <li class="list-group-item"><strong>Mata Kuliah Favorit : </strong> <?= $row["matkul_fav"]; ?></li>
                              </ul>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php $i++;
                    endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include 'template/footer.php' ?>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include 'template/logout-modal.php' ?>

    <!-- Add Data Modal -->
    <div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addDataModalLabel">Tambah Data Mahasiswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nrp">NRP</label>
                    <input type="text" class="form-control" id="nrp" name="nrp" required>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                  </div>
                  <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control" name="jurusan" id="jurusan" required>
                  </div>
                  <div class="form-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select class="form-control" name="gender" id="gender" required>
                      <option value="">-- Pilih Jenis Kelamin --</option>
                      <option value="laki-laki">Laki-laki</option>
                      <option value="perempuan">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="email">Email Student</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="no_hp">No Telepon</label>
                    <input type="text" class="form-control" name="no_hp" id="no_hp" required>
                  </div>
                  <div class="form-group">
                    <label for="asal_sma">Asal SLTA</label>
                    <input type="text" class="form-control" name="asal_sma" id="asal_sma" required>
                  </div>
                  <div class="form-group">
                    <label for="matkul_fav">Mata Kuliah Favorit</label>
                    <input type="text" class="form-control" name="matkul_fav" id="matkul_fav" required>
                  </div>
                  <div class="form-group">
                    <label>Gambar Profil</label>
                    <br>
                    <label for="pic_profile" class="custom-file-upload">
                      <i class="fas fa-upload"></i> Choose a file
                      <input type="file" name="pic_profile" id="pic_profile" required onchange="showFileName()">
                    </label>
                    <span id="file-selected"></span>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <?php include 'template/js.php' ?>

</body>

<script>
  // students.php
  $(document).ready(function() {
    $('.table').DataTable();
  });

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

  // Script button choose a file on add data mahasiswa
  function showFileName() {
    var fileInput = document.getElementById('pic_profile');
    // mengambil nama file yang dipilih
    var fileName = fileInput.value.split('\\').pop();
    // untuk menampilkan nama file atau pesan jika tidak ada file yang dipilih
    document.getElementById('file-selected').innerHTML = fileName ? fileName : "No file selected";
  }
</script>

</html>