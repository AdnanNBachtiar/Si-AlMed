<?php
include "koneksi.php";

// Periksa apakah parameter id telah diterima dengan metode GET
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Kueri untuk mengambil data berdasarkan ID
    $query = "SELECT * FROM md_alat WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Mengonversi hasil menjadi format JSON untuk dikirimkan ke permintaan AJAX
        echo json_encode($row);
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID tidak diterima.";
}
?>
