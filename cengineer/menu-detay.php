<?php include "user/ostatic/header.php";
include "enüst-saat.php";


$menusor = $db->prepare("SELECT * FROM menu WHERE  menu_seourl=:seourl");
$menusor->execute(array(
    'seourl' => $_GET['sef']
));
$menucek = $menusor->fetch(PDO::FETCH_ASSOC);


?>

    <div class="container arkaplantasarım">
        <div style="margin: 15px 0;" class="row animated fadeInUpBig">
            <div class="col-md-9 orta_alan">
                <section class="p-3">
                    <div style="margin-left: -15px; width: 104%;">
                        <h4 class="p-2 mt-3"><?php echo $menucek['menu_ad'] ?></h4>

                        <? if (strlen($menucek['menu_resim']) > 0) { ?>
                            <hr>
                            <img width="80%" height="350px" src="<?php echo $menucek['menu_resim'] ?>" alt="">
                        <?php } ?>

                        <p><?php echo $menucek['menu_icerik'] ?></p>

                        <? if (strlen($menucek['menu_video']) > 0) { ?>
                            <div class="vdoyerlestir">
                                <iframe src="h
                        https://www.youtube.com/embed/<?= $menucek['menu_video'] ?>"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        <?php } ?>


                        <!--                    <h4 class="p-2 mt-3">-->
                        <?php //echo $menucek['menu_detay'] ?><!--</h4>-->
                        <hr>
                        <p><?php echo $menucek['menu_detay'] ?></p>


                </section>
            </div>

            <?php include "medya-sabit.php";
            include "kategori.php"; ?>
        </div>
    </div>


<?php include "user/ostatic/footer.php" ?>