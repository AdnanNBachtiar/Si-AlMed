<?php
include "session.php";
include "koneksi.php";
require 'koneksi.php';



$get1 = mysqli_query($koneksi, "select * from md_alat");
$count1 = mysqli_num_rows($get1);

$get2 = mysqli_query($koneksi, "select * from md_alat where status='Valid'");
$count2 = mysqli_num_rows($get2);

$get3 = mysqli_query($koneksi, "select * from md_alat where status='Tidak Valid'");
$count3 = mysqli_num_rows($get3);

$get4 = mysqli_query($koneksi, "select * from md_alat where status='Dalam Perbaikan'");
$count4 = mysqli_num_rows($get4);

$kalibrasi = "SELECT * FROM md_alat";
$hasilkan = $koneksi->query($kalibrasi);

if ($hasilkan->num_rows > 0) {
    while ($row1 = $hasilkan->fetch_assoc()){
        $kalibrasikan = new DateTime($row1['kalibrasi_ulang']);

        $selisih = $kalibrasikan->diff(new DateTime())->days;

        if($selisih <= 7 && $selisih >= 0) {
            $pesanArray[] = "Perhatian: Alat {$row1['nama_alat']} perlu dikalibrasi ulang pada tanggal {$row1['kalibrasi_ulang']}.";
            //kirimNotifikasi($pesan);
        }
    }
} else {
    echo"Tidak ada data alat dalam database.";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sistem Informasi Alat Medis</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->

<!-- Navbar & Carousel Start -->
<div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="index.php" class="navbar-brand p-0">
                <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>Si AlMed</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.html" class="nav-item nav-link active">Beranda</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Service</a>
                        <div class="dropdown-menu m-0">
                            <a href="blog.html" class="dropdown-item">Dalam Perbaikan</a>
                            <a href="detail.html" class="dropdown-item">Masa Kalibrasi</a>
                            <a href="detail.html" class="dropdown-item">Tidak Valid</a>                            
                            <a href="detail.html" class="dropdown-item">Valid</a>

                        </div>
                    </div>
                </div>                    
                <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $_SESSION['nama']; ?></a>
                        <div class="dropdown-menu m-0">
                            <a href="logout.php" class="dropdown-item">LogOut</a>
                        </div>
                    </div>
            </div>
        </nav>
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-5" src="img/logo_pmi.jpeg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    </div>
                </div>
        </div>
    </div>
    <!-- Navbar & Carousel End -->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- Facts Start -->
    <div class="container-fluid  facts py-2 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class=" wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-2" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="bi bi-gear text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Dalam Perbaikan</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up"><?php  echo $count4;  ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts Start -->

    <!-- Conten Utama -->
    <div class="container-fluid">
    <div class="px-5 py-3 py-lg-0">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaltambah"
                data-bs-whatever="@mdo">Tambahkan</button>
            <div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="modaltambah"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalcreate">Tambahkan alat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="tambah.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Nama Alat</label>
                                            <input type="text" class="form-control" id="namaalat" name="namaalat"
                                                placeholder="Nama Alat">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Serial Number</label>
                                            <input type="text" class="form-control" id="snalat" name="snalat"
                                                placeholder="No Serial">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">No Inventaris</label>
                                            <input type="text" class="form-control" id="ninven" name="ninven"
                                                placeholder="No Inventaris">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Tanggal Kalibrasi</label>
                                            <input type="date" class="form-control" id="tglkalibrasi" name="tglkalibrasi">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Tanggal Kalibrasi Ulang</label>
                                            <input type="date" class="form-control" id="kalibrasiulang" name="kalibrasiulang">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lokasialat" class="col-form-label">Lokasi Alat</label>
                                            <select class="form-select" id="lokasialat" name="lokasialat">
                                                <option selected disabled>Pilih Lokasi</option>
                                                <option value="UDD PMI Provinsi DKI Jakarta">UDD PMI Provinsi DKI Jakarta</option>
                                                <option value="UDD PMI Kota Jakarta Pusat">UDD PMI Kota Jakarta Pusat</option>
                                                <option value="UDD PMI Kota Jakarta Timur">UDD PMI Kota Jakarta Timur</option>
                                                <option value="UDD PMI Kota Jakarta Selatan">UDD PMI Kota Jakarta Selatan</option>
                                                <option value="UDD PMI Kota Jakarta Utara">UDD PMI Kota Jakarta Utara</option>
                                                <option value="UDD PMI Kota Jakarta Barat">UDD PMI Kota Jakarta Barat</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Petugas Kalibrasi</label>
                                            <input type="text" class="form-control" id="petugas" name="petugas"
                                                placeholder="Nama Petugas">
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="col-form-label">Status</label>
                                            <select class="form-select" id="statusalat" name="statusalat">
                                                <option selected disabled>Pilih Status</option>
                                                <option value="Valid">Valid</option>
                                                <option value="Tidak Valid">Tidak Valid</option>
                                                <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Catatan</label>
                                            <textarea class="form-control" id="catatanalat" name="catatanalat" rows="3"
                                                placeholder="Catatan anda"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="simpanalat">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
// Query untuk mengambil data kalibrasi ulang
$sql = "SELECT * FROM md_alat WHERE kalibrasi_ulang";
$result = $koneksi->query($sql);

// Cek jika ada hasilnya
if ($result->num_rows > 0) {
    // output data setiap baris
    while($row = $result->fetch_assoc()) {
        $tanggalKalibrasiUlang = new DateTime($row["kalibrasi_ulang"]);
        $tanggalSekarang = new DateTime();
        $interval = $tanggalSekarang->diff($tanggalKalibrasiUlang);

        // Jika selisih hari sama dengan 7
        if ($interval->days == 7 && $interval->invert == 0) {
            echo "Alert: Alat " . $row["nama_alat"] . " harus dikalibrasi ulang dalam 7 hari lagi.";
        }
    }
} else {
    echo "<p>Tidak ada data kalibrasi ulang</p>";
}
$koneksi->close();
?>


 
    <div>
    <table class="table table-striped">
  <thead>
    <tr style= text-align:center;>
    <th scope="col">No</th>
      <th scope="col">Nama Alat</th>
      <th scope="col">Series Number</th>
      <th scope="col">No Inventaris</th>
      <th scope="col">Tanggal Kalibrasi</th>
      <th scope="col">Kalibrasi Ulang</th>
      <th scope="col">Lokasi Alat</th>
      <th scope="col">Petugas</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
    include "koneksi.php";
    // mengurutkan no secara otomatis
    $no=1;

    // memanggil semua data yang ada di md_alat
    $ambildata = mysqli_query($koneksi, "select * from md_alat WHERE status = 'Dalam Perbaikan'");
    while ($tampil = mysqli_fetch_array($ambildata)){
         // Menentukan warna berdasarkan status
    $warna = '';
    switch ($tampil['status']) {
        case 'Valid':
            $warna = 'green';
            break;
        case 'Tidak Valid':
            $warna = 'red';
            break;
        case 'Dalam Perbaikan':
            $warna = 'grey';
            break;
        default:
            $warna = 'black'; // Default jika status tidak sesuai
            break;
    }
            // Memformat tanggal kalibrasi ke dalam format "d M Y"
    $tgl_kalibrasi = date('d F Y', strtotime($tampil['tgl_kalibrasi']));
    $tgl_kalibrasi_ulang = date('d F Y', strtotime($tampil['kalibrasi_ulang']));
    // menampilkan data kedalam table
        echo "
        <tr>
        <td style= text-align:center;> $no </td>
        <td> $tampil[nama_alat]</td>
        <td style= text-align:center;> $tampil[sn]</td>
        <td style= text-align:center;> $tampil[no_inventaris]</td>
        <td style= text-align:center;> $tgl_kalibrasi</td>
        <td style= text-align:center;> $tgl_kalibrasi_ulang</td>
        <td style= text-align:center;> $tampil[lokasi]</td>
        <td style= text-align:center;> $tampil[petugas]</td>
        <td style='color: $warna; font-weight:bold; text-align:center;'> $tampil[status]</td>
        <td style= text-align:center;> <a href='delete.php?hapus=$tampil[sn]' style='float:center;' onClick = \"return confirm('Yakin akan menghapus data?');\"> hapus</a>
 
        <a href='update.php?sn=$tampil[sn]' style='float:right; margin-right:10px ;border-left: 1px solid black; padding-left: 25px; margin-left: 1px;' onclick=\"return confirm('Yakin akan memperbarui data?');\"> Update</a>
</td>

        </tr>";
        

        // jika ada data lebih dari 1 maka no akan berlanjut
        $no++;
    }
    ?>
  </tbody>
</table>
    </div>
    </div>
    </div>
    <!-- Conten Utama -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-md-6 footer-about">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-4">
                        <a href="index.html" class="navbar-brand">
                            <h1 class="m-0 text-white"><i class="fa fa-user-tie me-2"></i>SiAlMed</h1>
                        </a>
                        <p class="mt-3 mb-4">Sistem Informasi Alat Medis merupakan sistem untuk memantau ketersediaan dan waktu maintanance alat - alat medis yang berada di semua cabang PMI Provinsi DKI Jakarta.</p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">Hubungi Kami</h3>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <p class="mb-0">Jl Kramat Raya No 47, Jakarta Pusat, DKI Jakarta</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0">uddpmidkijakarta@gmail.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0">(+62) 21 3906666</p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-primary btn-square me-2" href="https://twitter.com/dondar_jakarta"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="https://www.facebook.com/uddpmidkijakarta"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="https://www.linkedin.com/company/indonesian-red-cross/mycompany/"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square" href="https://www.instagram.com/donordarahjakarta/?hl=en"><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">Pintasan</h3>
                            </div>
                            <div class="link-animated d-flex flex-column justify-content-start">
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Dalam Perbaikan</a>
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Perbaikan</a>
                                <a class="text-light" href="#exampleFormControlInput1"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">Tinggalkan Pesan</h3>
                            </div>
                            <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Komentar</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Komentar anda"></textarea>
                            </div>
                            <div class="col-12">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-white" style="background: #061429;">
        <div class="container text-center">
            <div class="row justify-content-end">
                <div class="col-lg-8 col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                        <p class="mb-0">&copy; <a class="text-white border-bottom" href="#">sialmed.com</a>. All Rights Reserved. 
						
						<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
						Designed by <a class="text-white border-bottom" href="https://htmlcodex.com">ANB x HTML Codex</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>



</body>

</html>