<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password']; 

//query update
$query = mysqli_query($koneksi, "UPDATE admin SET name='$name', username='$username', email='$email', password='$password' WHERE id='$id'");

if ($query) {
 # credirect ke page index
 header("location:admin.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($connect);
}

//mysql_close($host);
?>