<?php
$file = $_GET['url'];
$filepath = 'assets/' . $file;

if (file_exists($filepath)) {
  $extension = pathinfo($filepath, PATHINFO_EXTENSION);
  $new_filename = 'ProfilePicture.' . $extension;

  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="' . $new_filename . '"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($filepath));
  readfile($filepath);
  exit;
} else {
  echo "File not found.";
}
