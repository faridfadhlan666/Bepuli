<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'beritaacara';

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi Berhasil";
}
?>
