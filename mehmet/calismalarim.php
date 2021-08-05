<?php

require_once("front-end/connect/CalismalarimController.php");
$calismalarcont = new CalismalarimController();
$calisma_aciklama = $calismalarcont->calisma_aciklama_getir();
$calismalar_say = $calismalarcont->calismalarim_getir();
?>


<!-- ======= Services Section ======= -->
<section id="services" class="services">

    <div class="container">

        <div class="section-title">
            <h2>Çalışmalarım</h2><br>

        </div>
        <br>
        <?php $say = 0; ?>
        <div class="row skills-content">


            <?php $sayi = 0;
            foreach ($calismalar_say as $say) {
                $sayi++;
            }
            $bol = ceil($sayi / 2);
            $kalan = $sayi - $bol;


            foreach ($calismalar_say as $calismalar) {
                $bol--;
                if ($bol != 0) {
                    ?>
                    <div class="col-lg-6 mt-0 mb-5 yüzde" data-aos="fade-up">
                        <div class="">
                            <span class="skill"><?php echo $calismalar['ad'] ?></span>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"
                                     aria-valuenow="<?php echo $calismalar['yuzde'] ?>" aria-valuemin="0"
                                     aria-valuemax="100"><?php echo $calismalar['yuzde'] ?>
                                </div>
                            </div>
                            <span class="text-muted"
                                  style="font-size: 12px;float: right;">Son Güncelleme:<?php echo $calismalar['tarih'] ?>
                            </span>

                        </div>

                        <br>
                    </div>
                <?php } else { ?>
                    <br>


                    <div class="col-lg-6 mt-0 mb-5 yüzde" data-aos="fade-up">
                        <div class="">
                            <span class="skill"><?php echo $calismalar['ad'] ?></span>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"
                                     aria-valuenow="<?php echo $calismalar['yuzde'] ?>" aria-valuemin="0"
                                     aria-valuemax="100"><?php echo $calismalar['yuzde'] ?>
                                </div>
                            </div>
                            <span class="text-muted"
                                  style="font-size: 12px;float: right;">Son Güncelleme:<?php echo $calismalar['tarih'] ?>
                            </span>

                        </div>

                        <br>
                    </div>
                <?php }
            } ?>



            <?php if ($say == 0) { ?>
                <div style="margin-top: 20px;margin-bottom: 90px;"
                     class="col-md-6 col-sm-12 alert alert-dark text-center" role="alert">
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
</section><!-- End Services Section -->







