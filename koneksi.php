<?php
// Konfigurasi koneksi database
$host = "localhost";
$user = "root";
$password = ""; // Host database
$database = "sialmed"; // Nama database

// Buat koneksi ke database menggunakan MySQLi tanpa username dan password
$koneksi = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// Setel karakter set UTF-8 untuk koneksi
$koneksi->set_charset("utf8");

?>
