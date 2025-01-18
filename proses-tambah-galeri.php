<?php
// Include koneksi database
include('koneksi.php');

// Proses Tambah Artikel
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gambar = $_FILES['gambar']['name'];
    $tmp_gambar = $_FILES['gambar']['tmp_name'];

    // Folder tempat menyimpan gambar
    $folder = "assets/img/";
    $nama_gambar = time() . '_' . basename($gambar); // Tambahkan timestamp agar unik
    $path_gambar = $folder . $nama_gambar; // Path lengkap untuk upload file

    // Validasi: Pastikan ada file gambar
    if (!empty($gambar)) {
        // Upload gambar ke folder
        if (move_uploaded_file($tmp_gambar, $path_gambar)) {
            // Simpan hanya nama file ke database
            $query = "INSERT INTO artikel (gambar) VALUES (?)";
            $stmt = $koneksi->prepare($query);

            if ($stmt) {
                $stmt->bind_param('s', $nama_gambar);

                if ($stmt->execute()) {
                    echo "<script>alert('Artikel berhasil ditambahkan!'); window.location.href='galeri.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan artikel ke database.'); window.history.back();</script>";
                }

                $stmt->close();
            } else {
                echo "<script>alert('Gagal mempersiapkan statement SQL.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar. Pastikan folder img/ memiliki izin tulis.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Harap unggah gambar.'); window.history.back();</script>";
    }
}
?>
