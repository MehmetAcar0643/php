<?php
include "fonksiyon.php";
require_once("front-end/connect/DBController.php");

require_once("front-end/connect/AnaSayfaController.php");
$anaSayfacont = new AnaSayfaController();
$anasayfa = $anaSayfacont->anasayfa_getir();

require_once("front-end/connect/ProjelerimController.php");
$projelercont = new ProjelerimController();
$sosyal_medya = $anaSayfacont->sosyal_medya_getir();

if (isset($_GET['sef'])) {
    $konu_baslik = $_GET['sef'];
    $projelerim = $projelercont->proje_icerik_getir($konu_baslik);
    $projelerim_video = $projelercont->proje_icerik_video_getir($konu_baslik);
}
$proje_bilgiler = $projelercont->proje_baslik_getir($konu_baslik);



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
    <link href="front-end/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
            <img src="back-end-admin/dist/pages/<?PHP echo $anasayfa['site_logo'] ?>" alt=""
                 class="img-fluid rounded-circle">
            <h1 class="text-light"><a href="../mehmet">Mehmet Acar</a></h1>
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
                <li><a href="../mehmet#about"><i class="bx bx-user"></i> <span>Hakkımda</span></a></li>
                <li><a href="../mehmet#services"><i class="bx bx-server"></i> Çalışmalarım</a></li>
                <li><a href="../mehmet#portfolio"><i class="bx bx-book-content"></i> Projelerim</a></li>
                <li><a href="../mehmet#contact"><i class="bx bx-envelope"></i> İletişim</a></li>

            </ul>
        </nav><!-- .nav-menu -->
        <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    </div>
</header><!-- End Header -->

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="alert alert-primary text-center" role="alert">
                <h2 style="color: black;font-weight: bold;"><?php echo $proje_bilgiler['baslik'] ?></h2>
                <!--                <ol>-->
                <!--                    <li><a href="index.php">ANASAYFA</a></li>-->
                <!--                    <li>--><?php //echo $anasayfa?><!--</li>-->
                <!--                </ol>-->
                <a href="javascript:javascript:history.go(-1)">Geri Dön</a>
            </div>
        </div>


    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="owl-carousel portfolio-details-carousel col-md-8">
                    <?php foreach ($projelerim as $proje) { ?>
                        <img style="height: 315px;"
                             src="back-end-admin/dist/pages/<?php echo $proje['resim'] ?>" class="img-fluid" alt="">
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <?php foreach ($projelerim_video as $video) { ?>
                    <div class="col-md-6 mt-3">
                    <?php if (substr($video['video'], 0, 14) == "proje_videolar") { ?>
                        <video  width="100%" height="100%" src="back-end-admin/dist/pages/<?php echo $video['video'] ?>"
                               controls="controls"></video>
                    <?php } else { ?>

                        <iframe width="100%" height="100%"
                                src="https://www.youtube.com/embed/<?php echo $video['video'] ?>"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>

                    <?php } ?>  </div>
                <?php } ?>
            </div>

        </div>
        <div class="container">
            <div class="portfolio-description">
                <h2> <?php echo $proje_bilgiler['baslik'] ?></h2>
                <p>
                    <?php echo $proje_bilgiler['aciklama'] ?>
                </p>
            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <div class="copyright">
            &copy; 2020 <strong><span></span></strong>
        </div>
        <div class="credits">
            <!--        Mehmet Acar <a href="index.php">tarafından dizayn edilmiştir.</a>-->
        </div>
    </div>
</footer><!-- End  Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="front-end/assets/vendor/jquery/jquery.min.js"></script>
<script src="front-end/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="front-end/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="front-end/assets/vendor/php-email-form/validate.js"></script>
<script src="front-end/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="front-end/assets/vendor/counterup/counterup.min.js"></script>
<script src="front-end/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="front-end/assets/vendor/venobox/venobox.min.js"></script>
<script src="front-end/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="front-end/assets/vendor/typed.js/typed.min.js"></script>
<script src="front-end/assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="front-end/assets/js/main.js"></script>

</body>

</html>