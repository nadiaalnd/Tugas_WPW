<?php
$conn = mysqli_connect("localhost", "root", "", "phpnativecrud");

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

function count_data($table)
{
  global $conn;
  $result = mysqli_query($conn, "SELECT id FROM $table");
  $count = mysqli_num_rows($result);
  return $count;
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
  // Upload gambar profile 
  $pic_profile = upload();
  if (!$pic_profile) {
    return false;
  }

  //query insert data
  $query = "INSERT INTO mahasiswa
              VALUES
              ('', '$nrp', '$nama', '$pic_profile', '$jurusan', '$gender', '$email', '$alamat', '$no_hp', '$asal_sma', '$matkul_fav')
          ";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function upload()
{
  $namaGambar = $_FILES['pic_profile']['name'];
  $ukGambar = $_FILES['pic_profile']['size'];
  $error = $_FILES['pic_profile']['error'];
  $tmpName = $_FILES['pic_profile']['tmp_name'];

  // Check if nothing uploaded
  if ($error === 4) {
    echo "<script>
            alert('Pilih gambar terlebih dahulu!');
          </script>";
    return false;
  }
  //Check uploaded type file
  $validType = ['jpg', 'png', 'jpeg'];
  $extensPic = explode('.', $namaGambar);
  $extensPic = strtolower(end($extensPic));
  if (!in_array($extensPic, $validType)) {
    echo "<script>
            alert('Format file tidak sesuai!');
          </script>";
    return false;
  }

  // Check size of file
  if ($ukGambar > 2000000) {
    echo "<script>
            alert('Ukuran gambar terlalu besar');
          </script>";
    return false;
  }

  // Ready to upload
  // Generate a new name of the file
  $namaGambarBaru = uniqid();
  $namaGambarBaru .= '.';
  $namaGambarBaru .= $extensPic;

  move_uploaded_file($tmpName, 'assets/' . $namaGambarBaru);
  return $namaGambarBaru;
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
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  // Check user choose a new picture or not
  if ($_FILES['pic_profile']['error'] === 4) {
    $pic_profile = $gambarLama;
  } else {
    $pic_profile = upload();
  }

  //query update data
  $query = "UPDATE mahasiswa SET
              nrp = '$nrp',
              nama = '$nama',
              pic_profile = '$pic_profile',
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

function signup($data)
{
  global $conn;
  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $repassword = mysqli_real_escape_string($conn, $data["repassword"]);

  // chech username already exists
  $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('Username already exists');
          </script>";
    return false;
  }

  // check repassword
  if ($password != $repassword) {
    echo "<script>
            alert('Password is incorrect');
          </script>";
    return false;
  }

  // encrypt password
  $options = [
    'cost' => 12
  ];
  $password = password_hash($password, PASSWORD_BCRYPT, $options);

  // insert user to database
  mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

  return mysqli_affected_rows($conn);
}
