<?php
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Link Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
  <script src="https://kit.fontawesome.com/1d954ea888.js" crossorigin="anonymous"></script>
  <!-- Link CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Title -->
  <title>Data Mahasiswa</title>
  <style>
    table {
      border: 6px solid #eaeaea !important
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-sm fixed-top navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand">
        <strong>DATA KELAS 1 D3 IT A</strong>
      </a>
    </div>
  </nav>
  <div class="container" style="margin-top:100px;">
    <h1 class="text-center">
      <strong>Daftar Mahasiswa</strong>
    </h1>
    <br>
    <!-- Button Create a New Data -->
    <a class="btn btn-primary" href="add.php" role="button"><i class="fas fa-plus"></i> Data</a>
    <br>
    <div class="scroll">
      <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-light p-3 rounded-2" tabindex="0">
        <table class="table table-hover table-bordered">
          <thead>
            <tr class="table-darks">
              <th scope="col">#</th>
              <th scope="col">NRP</th>
              <th scope="col">Nama</th>
              <th scope="col">Jurusan</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">Email mahasiswa</th>
              <th scope="col">Alamat</th>
              <th scope="col">No Telepon</th>
              <th scope="col">Asal SLTA</th>
              <th scope="col">Mata Kuliah Favorit</th>
              <th scope="col">AKSI</th>
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
                <td><?= $row["email"]; ?></td>
                <td><?= $row["alamat"]; ?></td>
                <td><?= $row["no_hp"]; ?></td>
                <td><?= $row["asal_sma"]; ?></td>
                <td><?= $row["matkul_fav"]; ?></td>
                <td>
                  <a class="btn btn-warning text-white" href="javascript:void(0)" onclick="confirmEdit(<?= $row['id'] ?>)" role="button">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a class="btn btn-danger" href="javascript:void(0)" onclick="confirmDelete(<?= $row['id'] ?>)" role="button">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </td>
              </tr>
            <?php $i++;
            endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <br>
  </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function() {
    $('.table').DataTable();
  });

  function confirmDelete(id) {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Data yang dihapus tidak dapat dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
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
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, ubah data!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "update.php?id=" + id;
      }
    })
  }
</script>

</html>
