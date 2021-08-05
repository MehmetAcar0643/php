<?php include "user/ostatic/header.php";
include "enüst-saat.php";

if (isset($_GET['sef'])) {
    $kategorisor = $db->prepare("SELECT * FROM kategori where kategori_seourl=:seourl ");
    $kategorisor->execute(array(
        'seourl' => $_GET['sef']
    ));
    $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);
    $kategori_id = $kategoricek['kategori_id'];


    $derssor = $db->prepare("SELECT * FROM ders where kategori_id=:kategori_id and ders_durum=:durum order by ders_sira ASC ");
    $derssor->execute(array(
        'kategori_id' => $kategori_id,
        'durum' => 1
    ));
    $say = $derssor->rowCount();
} else {
    $derssor = $db->prepare("SELECT * FROM ders order by ders_sira ASC ");
    $derssor->execute();
}


?>
    <div class="container arkaplantasarım">
        <div style="margin: 15px 0;" class="row animated fadeInUpBig">
            <div class="col-md-9 orta_alan">
                <section class="p-3">
                    <div style="border: 2px solid yellow;min-height: 550px">
                        <h4 class="p-2 mt-3"><?php echo $kategoricek['kategori_ad'] ?></h4>
                        <hr>
                        <ol class=" ml-5 listeleme">

                            <?php
                            if ($say == 0) {
                                echo "Henüz bir içerik eklenmemiştirr...";
                            }

                            while ($derscek = $derssor->fetch(PDO::FETCH_ASSOC)) { ?>

                                <div class="mt-4">
                                    <li>
                                        <a href="#"> <?php echo $derscek['ders_ad'] ?></a>
                                    </li>
                                </div>
                            <?php } ?>
                        </ol>

                    </div>
                </section>
            </div>
            <?php include "medya-sabit.php";
            include "kategori.php"; ?>
        </div>
    </div>


<?php include "user/ostatic/footer.php" ?>