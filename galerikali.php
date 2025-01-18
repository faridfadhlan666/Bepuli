<?php
	include_once "adm-dc/koneksi.php";
	//get the function
	include_once('function.php');

	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
	//$limit untuk menentukan banyaknya baris halaman dalam tabel
	$limit = 3;
	//menentukan nomor mulai pada paaging untuk halaman berikutnya
	$startpoint = ($page * $limit) - $limit;

	//tabel yang mau di tampilin pake paging 
	$tabel = "galeri";
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Desa Ciasmara</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
   <!-- Favicons -->
  <link href="logo/logo.jpg" rel="icon">
  <link href="logo/logo.jpg" rel="apple-touch-icon">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
   <link href="assets/css/style.css" rel="stylesheet">
  <style>
  .float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
  z-index:100;
}

.my-float{
	margin-top:16px;
}
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <a href="https://api.whatsapp.com/send?phone=6285881687152&text=" class="float" target="_blank">
  <i class="fa fa-whatsapp my-float"></i>
  </a>
  		<link href="pagination.css" rel="stylesheet" type="text/css" />
		<link href="B_red.css" rel="stylesheet" type="text/css" />

</head>




<body>

    <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <?php include "top-bar.php" ?>
  </section>




  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo"><a href="index.php"><img src="logo/logo.jpg" alt="DesaCiasmara" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Beranda</a></li>
          <li><a href="tentang-kami.php">Tentang Kami</a></li>
          <li><a href="paket-wisata.php">Paket Wisata</a></li>
          <li><a href="produkekonomikreatif.php">Produk Ekonomi Kreatif</a></li>
		  <li><a href="artikel.php">Artikel</a></li>
          <li><a  class="active" href="galeri.php">Galeri</a></li>
		  <li><a href="testimonial.php">Testimonial</a></li>
          <li><a href="kontak.php">Kontak Kami</a></li>
                         
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

 
 
 
 

  <main id="main">
	 <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Galeri</h2>
          <ol>
            <li><a href="index.php">Beranda</a></li>
            <li>Galeri</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Galeri Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">
		<p align="center"><center>	
		<?php echo "&nbsp;". pagination($tabel,$limit,$page);?>				
       
		</center></p>
        <div class="row portfolio-container" data-aos="fade-up">
					<?php 
						include "adm-dc/koneksi.php";
								
						 $perintah_sql = "select * from $tabel ORDER BY id_galeri DESC LIMIT $startpoint , $limit";
									$data = mysqli_query($koneksi,$perintah_sql);
									while($row=mysqli_fetch_array($data)){
										?>
                        
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
		   <img src="adm-dc/galeri/<?php echo $row['gambar'];?>"  alt="" width="350 px" height="300 px" >
            <div class="portfolio-info">
              <a href="adm-dc/galeri/<?php echo $row['gambar'];?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Galeri Ciasmara"><i class="bx bx-plus"></i></a>
              <a>Klik + untuk Ukuran Asli</a>
            </div>
          </div>

                                  						
						<?php 
						

									}?>
									
		
        </div>

      </div>
    </section><!-- End Galeri Section -->
    

  </main><!-- End #main -->















<!-- ======= Footer ======= -->
  <?php
	include "footer.php";
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>