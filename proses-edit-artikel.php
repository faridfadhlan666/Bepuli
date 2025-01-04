<?php
// Include koneksi database
include('koneksi.php');

// Proses Edit Artikel
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_artikel = $_POST['id_artikel'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $sumber = $_POST['sumber'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $gambar_baru = $_FILES['gambar']['name'];
    $tmp_gambar_baru = $_FILES['gambar']['tmp_name'];

    // Folder tempat menyimpan gambar
    $folder = "assets/img/";

    // Validasi: Pastikan semua input terisi
    if (empty($judul) || empty($penulis) || empty($sumber) || empty($deskripsi) || empty($tanggal)) {
        echo "<script>alert('Semua kolom wajib diisi.'); window.history.back();</script>";
        exit;
    }

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
            $query = "UPDATE artikel SET judul = ?, penulis = ?, sumber = ?, deskripsi = ?, gambar = ?, tanggal = ? WHERE id_artikel = ?";
            $stmt = $koneksi->prepare($query);

            if ($stmt) {
                $stmt->bind_param('ssssssi', $judul, $penulis, $sumber, $deskripsi, $nama_gambar_baru, $tanggal, $id_artikel);

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
    } else {
        // Update data tanpa mengganti gambar
        $query = "UPDATE artikel SET judul = ?, penulis = ?, sumber = ?, deskripsi = ?, tanggal = ? WHERE id_artikel = ?";
        $stmt = $koneksi->prepare($query);

        if ($stmt) {
            $stmt->bind_param('sssssi', $judul, $penulis, $sumber, $deskripsi, $tanggal, $id_artikel);

            if ($stmt->execute()) {
                echo "<script>alert('Artikel berhasil diubah!'); window.location.href='artikel.php';</script>";
            } else {
                echo "<script>alert('Gagal mengupdate artikel di database.'); window.history.back();</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Gagal mempersiapkan statement SQL.'); window.history.back();</script>";
        }
    }
}
?>
