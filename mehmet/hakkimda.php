<?php


require_once("front-end/connect/HakkimdaController.php");
$hakkimdacont=new HakkimdaController();
$hakkimda=$hakkimdacont->hakkimda_getir();

?>

<!-- ======= About Section ======= -->
<section style="margin-bottom: 100px;" id="about" class="about">
    <div class="container">

        <div class="section-title">
            <h2>Hakkımda</h2>
            <!--          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>-->
        </div>

        <div class="row">
            <div class="col-lg-4" data-aos="fade-right">
                <img src="back-end-admin/dist/pages/<?php echo $hakkimda['resim']?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                <h3><?php echo $hakkimda['baslik']?></h3>
                <p class="font-italic">
                    <!--              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore-->
                    <!--              magna aliqua.-->
                </p>
                <div class="row">
                    <div class="col-lg-6">
                        <ul>
                            <li><i class="icofont-rounded-right"></i> <strong>Doğum Tarihi:</strong> <?php echo $hakkimda['dogum_tarihi']?>
                            </li>
                            <li><i class="icofont-rounded-right"></i> <strong>Website:</strong> <?php echo $hakkimda['web_site']?>
                            </li>
                            <!--                  <li><i class="icofont-rounded-right"></i> <strong>Phone:</strong> +123 456 7890</li>-->
                            <!--                  <li><i class="icofont-rounded-right"></i> <strong>City:</strong> Şehir : New York, USA</li>-->
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul>
                            <li><i class="icofont-rounded-right"></i> <strong>Yaş:</strong> <?php echo $hakkimda['yas']?></li>
                            <!--                  <li><i class="icofont-rounded-right"></i> <strong>Degree:</strong> Master</li>-->
                            <li><i class="icofont-rounded-right"></i> <strong>Mail:</strong> <?php echo $hakkimda['mail']?></li>
                            <!--                  <li><i class="icofont-rounded-right"></i> <strong>Freelance:</strong> Available</li>-->
                        </ul>
                    </div>
                    <p>
                        <?php echo $hakkimda['hakkimda']?>
                    </p>
                </div>

                <p style="float: right">
                    <span class="text-muted" style="font-size: 12px">Son Güncelleme:<?php echo $hakkimda['tarih']?></span>
                </p>

            </div>
        </div>

    </div>
</section><!-- End About Section -->
