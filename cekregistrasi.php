<?php
include "koneksi.php";
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$sql = "INSERT INTO admin (nama, username, password, email) VALUES ('$nama', '$username', '$password', '$email')";

if (mysqli_query($koneksi, $sql)) {
  echo "<script>alert('Registrasi Berhasil'); window.location='login.php';</script>";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}

?>
