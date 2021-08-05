<?php include "user/ostatic/header.php";
include "enüst-saat.php";
$hakkimdasor = $db->prepare("SELECT * FROM hakkimda WHERE  hakkimda_id=:id");
$hakkimdasor->execute(array(
    'id' => 0
));
$hakkimdacek = $hakkimdasor->fetch(PDO::FETCH_ASSOC);


?>

    <div class="container arkaplantasarım">
        <div style="margin: 15px 0;" class="row animated fadeInUpBig">
    <div class="col-md-9 orta_alan">
        <section class="p-3">
            <div style="margin-left: -15px; width: 104%;">
                <h4 class="p-2 mt-3"><?php echo $hakkimdacek['hakkimda_baslik'] ?></h4>
                <hr>
                <!--                --><? // if (strlen($hakkimdacek['hakkimda_resim']) > 0) { ?>
                <img width="80%" height="350px" src="<?php echo $hakkimdacek['hakkimda_resim'] ?>" alt="">
                <!--                --><?php //}?>

                <p><?php echo $hakkimdacek['hakkimda_icerik'] ?></p>

                <? if (strlen($hakkimdacek['hakkimda_video']) > 0) { ?>
                    <div align="center" class="vdoyerlestir ml-2">
                        <iframe src="https://www.youtube.com/embed/<?= $hakkimdacek['hakkimda_video'] ?>"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                <?php } ?>

                <div class="tecrübelerim">
                    <h4 style="font-style: italic" class="p-5">İlgi Alanlarım ve Tecrübelerim</h4>
                    <div class="row ilerleme">
                        <div class="col-md-6">
                            <p>Php</p>
                            <div class="progress">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                     style="width: 75%">
                                    %75
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>HTML/CSS</p>
                            <div class="progress">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                     style="width: 90%">
                                    %90
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>C#</p>
                            <div class="progress">
                                <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated"
                                     style="width: 50%">
                                    %50
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>JAVA</p>
                            <div class="progress">
                                <div class="progress-bar bg-dark progress-bar-striped progress-bar-animated"
                                     style="width: 25%">
                                    %25
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>JavaScript</p>
                            <div class="progress">
                                <div class="progress-bar bg-dark progress-bar-striped progress-bar-animated"
                                     style="width: 25%">
                                    %25
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>Linux</p>
                            <div class="progress">
                                <div class="progress-bar bg-dark progress-bar-striped progress-bar-animated"
                                     style="width: 15%">
                                    %15
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <? if (strlen($hakkimdacek['hakkimda_vizyonicerik']) > 5) { ?>
                    <h4 class="p-2 mt-3"><?php echo $hakkimdacek['hakkimda_vizyonbaslik'] ?></h4>
                    <hr>
                    <p><?php echo $hakkimdacek['hakkimda_vizyonicerik'] ?></p>
                    <hr>
                <?php } ?>

                <? if (strlen($hakkimdacek['hakkimda_misyonicerik']) > 5) { ?>
                    <h4 class="p-2 mt-3"><?php echo $hakkimdacek['hakkimda_misyonbaslik'] ?></h4>
                    <hr>
                    <p><?php echo $hakkimdacek['hakkimda_misyonicerik'] ?></p>
                <?php } ?>

        </section>
    </div>
    <?php include "medya-sabit.php";
    include "kategori.php"; ?>
    </div>
    </div>


<?php include "user/ostatic/footer.php" ?>