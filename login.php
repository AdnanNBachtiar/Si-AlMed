<?php

session_start();
include "koneksi.php";


?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style2.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(img/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Selamat Datang <br> SISTEM INFORMASI ALAT MEDIS</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">MASUK</h3>
		      	<form action="#" class="signin-form"  method="POST">
		      		<div class="form-group">
		      			<input type="text" class="form-control" placeholder="Kode User" name="username" required >
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" name="password" class="form-control" placeholder="Password" required>
	              <span></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3" name="proseslog">MASUK</button>
	            </div> <br><br><br><br><br> <br><br><br><br><br><br>


	          </form>
			  <?php

if(isset($_POST['proseslog'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sql = mysqli_query($koneksi, "SELECT * FROM masuk where username = '$username' and password = '$password'");


	$cek = mysqli_num_rows($sql);
	if($cek > 0){
		$_SESSION['username'] = $_POST['username'];
		    // Mengambil informasi nama dari tabel masuk
			$data = mysqli_fetch_assoc($sql);
			// Menyimpan nama ke dalam sesi
			$_SESSION['nama'] = $data['nama'];

		echo "<meta http-equiv=refresh content=0;URL='index.php'>";
	} else {
		echo "<p align=center><b>Username dan Password SALAH !</b></p>";
		echo "<meta http-equiv=refresh content=2;URL='login.php'>";
	};
}

?>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

