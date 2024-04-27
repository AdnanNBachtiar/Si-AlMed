<?php

include "koneksi.php";

// Cek apakah tombol "hapus" diklik
if (isset($_GET['hapus'])) {
    // Ambil ID yang akan dihapus
    $id = $_GET['hapus'];

    // Query untuk menghapus data berdasarkan ID
    $sql_delete = "DELETE FROM md_alat WHERE id = '$id'";

    // Lakukan query penghapusan
    if (mysqli_query($koneksi, $sql_delete)) {
        // Jika penghapusan berhasil, redirect kembali ke halaman index.php
        header("Location: index.php");
        exit();
    } else {
        // Jika terjadi kesalahan saat penghapusan, tampilkan pesan error
        echo "Error: " . $sql_delete . "<br>" . mysqli_error($koneksi);
    }
}

?>