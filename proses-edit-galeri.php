<?php
// Include koneksi database
include('koneksi.php');

// Proses Edit Artikel
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_artikel = $_POST['id_artikel'];
    $gambar_baru = $_FILES['gambar']['name'];
    $tmp_gambar_baru = $_FILES['gambar']['tmp_name'];

    // Folder tempat menyimpan gambar
    $folder = "assets/img/";

    if (!empty($gambar_baru)) {
        // Nama gambar baru dengan timestamp
        $nama_gambar_baru = time() . '_' . basename($gambar_baru);
        $path_gambar_baru = $folder . $nama_gambar_baru;

        // Upload gambar baru ke folder
        if (move_uploaded_file($tmp_gambar_baru, $path_gambar_baru)) {
            // Hapus gambar lama
            $query_get_gambar = "SELECT gambar FROM artikel WHERE id_artikel = ?";
            $stmt_get_gambar = $koneksi->prepare($query_get_gambar);

            if ($stmt_get_gambar) {
                $stmt_get_gambar->bind_param('i', $id_artikel);
                $stmt_get_gambar->execute();
                $stmt_get_gambar->bind_result($gambar_lama);
                $stmt_get_gambar->fetch();
                $stmt_get_gambar->close();

                if (!empty($gambar_lama) && file_exists($folder . $gambar_lama)) {
                    unlink($folder . $gambar_lama);
                }
            }

            // Update data dengan gambar baru
            $query = "UPDATE artikel SET gambar = ?, WHERE id_artikel = ?";
            $stmt = $koneksi->prepare($query);

            if ($stmt) {
                $stmt->bind_param('si', $nama_gambar_baru, $id_artikel);

                if ($stmt->execute()) {
                    echo "<script>alert('Artikel berhasil diubah!'); window.location.href='artikel.php';</script>";
                } else {
                    echo "<script>alert('Gagal mengupdate artikel di database.'); window.history.back();</script>";
                }

                $stmt->close();
            } else {
                echo "<script>alert('Gagal mempersiapkan statement SQL.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar baru. Pastikan folder img/ memiliki izin tulis.'); window.history.back();</script>";
        }
    }
}
