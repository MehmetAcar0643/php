<?php

require_once("front-end/connect/İletisimController.php");
$iletisimcont = new İletisimController();


$error = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["ad"])) || empty(trim($_POST["mail"])) || empty(trim($_POST["konu"])) || empty(trim($_POST["mesaj"]))) {
        array_push($error, "Lütfen Tüm Alanları eksiksiz doldurunuz....");
    } else {
        $ad = trim($_POST["ad"]);
        $mail = trim($_POST["mail"]);
        $konu = trim($_POST["konu"]);
        $mesaj = trim($_POST["mesaj"]);
    }

    if (count($error) == 0) {
        $flag = $iletisimcont->mesaj_gonder($ad, $konu, $mail, $mesaj);
        if ($flag) {
            $message = "Mesajın iletildi...";
        } else {
            array_push($error, "Hata");
        }
    }

}


?>


<section id="contact" class="contact">
    <div class="container">

        <div class="section-title">
            <h2>İletişim</h2>
        </div>

        <div class="row" data-aos="fade-in">


            <div class="col-lg-12 mt-lg-0 d-flex align-items-stretch">

                <form action="index.php#contact" method="POST" class="php-email-form">
                    <?php if (count($error) > 0) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($error as $er) { ?>
                                - <?php echo $er; ?><br>
                            <?php } ?>
                        </div>
                    <?php }
                    if ($message != '') { ?>
                        <div class="alert alert-success" role="alert"><?php echo $message; ?></div>
                    <?php } ?>
                    <div class="form-group">
                        <span style="color: red">* içerikli alanlar zorunlu</span><br>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label for="name">Ad-Soyad *</label>
                            <input type="text" name="ad" class="form-control" id="name" value="">
                            <div class="validate"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Mail Adresin *</label>
                            <input type="email" class="form-control" name="mail" id="email">
                            <div class="validate"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Konu *</label>
                        <input type="text" class="form-control" name="konu" id="subject">
                        <div class="validate"></div>
                    </div>
                    <div class="form-group">
                        <label for="name">Mesajın *</label>
                        <textarea class="form-control" name="mesaj" rows="8"></textarea>
                        <div class="validate"></div>
                    </div>
                    <div class="form-group bx-pull-right">
                        <button class="btn btn-outline mw-xl btn-purple"
                                type="submit" name="">Mesajını Gönder
                        </button>
                    </div>
                </form

            </div>

        </div>

    </div>
</section><!-- End Contact Section -->
