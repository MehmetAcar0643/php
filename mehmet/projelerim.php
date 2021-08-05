<?php

require_once("front-end/connect/ProjelerimController.php");
$projelercont = new ProjelerimController();
$projelerim = $projelercont->projelerim_getir();


?>


<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio ">
    <div class="container">

        <div class="section-title">
            <h2>Projelerim</h2>
            <p></p>
        </div>

        <div style="padding-bottom: 250px;" class="row portfolio-container text-center" data-aos="fade-up" data-aos-delay="100">
            <?php $say = 0;
            foreach ($projelerim as $proje) {
                $say++; ?>
                <div class="col-lg-4 col-md-6 portfolio-item ">
                    <div class="portfolio-wrap">
                        <img style="width: 400px;height: 200px"
                             src="back-end-admin/dist/pages/<?php echo $proje['kapak_foto'] ?>" class="img-fluid"
                             alt="">
                        <div class="portfolio-links">
                            <a href="<?= seo($proje['ad']) ?>-projeler" title="More Details"><i
                                        class="bx bx-link"></i></a>
                        </div>
                        <div style="text-align: center;" class="title mt-1">
                            <h5><?php echo $proje['ad'] ?> Projelerim</h5>
                            <p></p>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <?php if ($say == 0) { ?>
                <div style="margin-top: 100px;" class=" col-sm-12 alert alert-dark text-center" role="alert">
                    <strong>Yüklenme Aşamasında...</strong>
                    <div class="spinner-grow text-muted"></div>
                    <div class="spinner-grow text-primary"></div>
                    <div class="spinner-grow text-success"></div>
                    <div class="spinner-grow text-info"></div>
                    <div class="spinner-grow text-warning"></div>
                    <div class="spinner-grow text-danger"></div>
                    <div class="spinner-grow text-secondary"></div>
                    <div class="spinner-grow text-dark"></div>
                    <div class="spinner-grow text-light"></div>
                </div>


            <?php } ?>
        </div>

    </div>
</section><!-- End Portfolio Section -->