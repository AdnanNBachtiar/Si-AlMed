<?php

include "koneksi.php";

if (isset($_POST['simpanalat'])) {
    $nalat = $_POST['namaalat'];
    $snalat = $_POST['snalat'];
    $ninven = $_POST['ninven'];
    $tglkalibrasi = $_POST['tglkalibrasi'];
    $kalibrasiulang = $_POST['kalibrasiulang'];
    $lokasialat = $_POST['lokasialat'];
    $petugas = $_POST['petugas'];
    $statusalat = $_POST['statusalat'];
    $catatanalat = $_POST['catatanalat'];

    $sql_alat = "INSERT INTO md_alat (nama_alat, sn, no_inventaris, tgl_kalibrasi, kalibrasi_ulang, lokasi, petugas, status, catatan) VALUES ('$nalat','$snalat','$ninven','$tglkalibrasi','$kalibrasiulang','$lokasialat','$petugas','$statusalat','$catatanalat')";

    if ($koneksi->query($sql_alat) === TRUE) {
        echo "<script>alert('berhasil menambah data'); document.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('gagal menambah data'); document.location.href = 'index.php';</script>";
    }
}

?>
