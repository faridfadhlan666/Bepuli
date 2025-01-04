<?php
require 'koneksi.php';
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$query_sql = "INSERT INTO admin (name, email, username, password) VALUES ('$name', '$email', '$username', '$password')";

if (mysqli_query($koneksi, $query_sql)) {
  header("location: admin.php");
} else {
  echo "Error: " . $query_sql . "<br>" . mysqli_error($koneksi);
}

?>