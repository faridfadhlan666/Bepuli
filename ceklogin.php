<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
  // Jika login berhasil, simpan data ke session dan alihkan ke dashboard
  $_SESSION['username'] = $username;
  header("Location: admin.php");
  exit();
} else {
  // Jika login gagal, tampilkan notifikasi menggunakan JavaScript
  echo "<script>
          alert('Username atau Password salah!');
          window.location.href = 'index.php';
        </script>";
  exit();
}
?>