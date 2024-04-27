<?php
include "koneksi.php";
include "session.php";


if (isset($_POST['simpanedit'])) {

    $id = $_POST['id'];
    $nalat = $_POST['namaalat'];
    $snalat = $_POST['snalat'];
    $ninven = $_POST['ninven'];
    $tglkalibrasi = $_POST['tglkalibrasi'];
    $kalibrasiulang = $_POST['kalibrasiulang'];
    $lokasialat = $_POST['lokasialat'];
    $petugas = $_POST['petugas'];
    $statusalat = $_POST['statusalat'];
    $catatanalat = $_POST['catatanalat'];

    $query = "UPDATE `md_alat` SET 
    `nama_alat` = '$nalat',
    `sn` = '$snalat',
    `no_inventaris` = '$ninven',
    `tgl_kalibrasi` = '$tglkalibrasi',
    `kalibrasi_ulang` = '$kalibrasiulang',
    `lokasi` = '$lokasialat',
    `petugas` = '$petugas',
    `status` = '$statusalat',
    `catatan` = '$catatanalat' WHERE id = $id
    ";

    $result = mysqli_query($koneksi, $query);

    if($result === true) {
        // Jika berhasil, arahkan kembali ke halaman utama
        header("Location: index.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan kesalahan
        echo "Error: " . mysqli_error($koneksi);

    }
}
?>