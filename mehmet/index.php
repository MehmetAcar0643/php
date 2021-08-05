<?php include "header.php";

require_once("front-end/connect/AnaSayfaController.php");
$anaSayfacont=new AnaSayfaController();
$anasayfa=$anaSayfacont->anasayfa_getir();



?>

<!-- ======= Hero Section ======= -->
<section style="background: url('back-end-admin/dist/pages/<?php echo $anasayfa['site_resim']?>')  center" id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
        <h1><?php echo $anasayfa['isim']?></h1>
        <p>I'm <span class="typed" data-typed-items="Designer, Developer, Freelancer"></span></p>
    </div>
</section><!-- End Hero -->

<main id="main">

    <?php include "hakkimda.php" ?>

    <? include "calismalarim.php" ?>
    <br><br>
    <?php include "projelerim.php" ?>
    <br><br>
    <!-- ======= Contact Section ======= -->
    <?php include "iletisim.php" ?>
</main><!-- End #main -->

<?php include "footer.php" ?>
