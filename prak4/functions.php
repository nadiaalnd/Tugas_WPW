<?php
$conn = mysqli_connect("localhost", "root", "", "wpw");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function add($data)
{
  global $conn;
  $nrp = htmlspecialchars($data["nrp"]);
  $nama = htmlspecialchars($data["nama"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $gender = htmlspecialchars($data["gender"]);
  $email = htmlspecialchars($data["email"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $no_hp = htmlspecialchars($data["no_hp"]);
  $asal_sma = htmlspecialchars($data["asal_sma"]);
  $matkul_fav = htmlspecialchars($data["matkul_fav"]);

  //query insert data
  $query = "INSERT INTO mahasiswa
              VALUES
              ('', '$nrp', '$nama', '$jurusan', '$gender', '$email', '$alamat', '$no_hp', '$asal_sma', '$matkul_fav')
          ";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function delete($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
  return mysqli_affected_rows($conn);
}

function update($data)
{
  global $conn;
  $id = $data["id"];
  $nrp = htmlspecialchars($data["nrp"]);
  $nama = htmlspecialchars($data["nama"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $gender = htmlspecialchars($data["gender"]);
  $email = htmlspecialchars($data["email"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $no_hp = htmlspecialchars($data["no_hp"]);
  $asal_sma = htmlspecialchars($data["asal_sma"]);
  $matkul_fav = htmlspecialchars($data["matkul_fav"]);

  //query update data
  $query = "UPDATE mahasiswa SET
              nrp = '$nrp',
              nama = '$nama',
              jurusan = '$jurusan',
              gender = '$gender',
              email = '$email',
              alamat = '$alamat',
              no_hp = '$no_hp',
              asal_sma = '$asal_sma',
              matkul_fav = '$matkul_fav'
            WHERE id = $id
          ";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
