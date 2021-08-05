<?php
include "fonksiyon.php";

require_once("front-end/connect/DBController.php");

require_once("front-end/connect/AnaSayfaController.php");
$anaSayfacont = new AnaSayfaController();
$anasayfa = $anaSayfacont->anasayfa_getir();

$sosyal_medya = $anaSayfacont->sosyal_medya_getir();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $anasayfa['site_adi'] ?></title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="back-end-admin/dist/pages/<?php echo $anasayfa['site_logo'] ?>" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="front-end/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="front-end/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="front-end/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="front-end/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="front-end/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="front-end/assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="front-end/assets/css/style.css" rel="stylesheet">


</head>

<body>

<!-- ======= Mobile nav toggle button ======= -->
<button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

<!-- ======= Header ======= -->
<header id="header">
    <div class="d-flex flex-column">

        <div class="profile">
            <img src="back-end-admin/dist/pages/<?php echo $anasayfa['site_logo'] ?>" alt=""
                 class="img-fluid rounded-circle">
            <h1 class="text-light"><a href="../mehmet"><?php echo $anasayfa['isim'] ?></a></h1>
            <div class="social-links mt-3 text-center">
                <a href="<?php echo $sosyal_medya['twitter'] ?>" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="<?php echo $sosyal_medya['facebook'] ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="<?php echo $sosyal_medya['instagram'] ?>" class="instagram"><i
                            class="bx bxl-instagram"></i></a>
                <a href="<?php echo $sosyal_medya['linkedin'] ?>" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>

        <nav class="nav-menu">
            <ul>
                <!--          <li class="active"><a href="index.html"><i class="bx bx-home"></i> <span>Ana Sayfa</span></a></li>-->
                <li><a href="#about"><i class="bx bx-user"></i> <span>Hakkımda</span></a></li>
                <li><a href="#services"><i class="bx bx-server"></i> Çalışmalarım</a></li>
                <li><a href="#portfolio"><i class="bx bx-book-content"></i> Projelerim</a></li>
                <li><a href="#contact"><i class="bx bx-envelope"></i> İletişim</a></li>

            </ul>
        </nav><!-- .nav-menu -->
        <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    </div>
</header><!-- End Header -->