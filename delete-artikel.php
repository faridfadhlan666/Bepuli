<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_artikel'];

//query update
$query = mysqli_query($koneksi,"DELETE FROM `artikel` WHERE id_artikel = '$id'");

if ($query) {
 # credirect ke page index
 header("location:artikel.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>
