<?php include "header.php";

require_once("../../connect/AnaSayfaController.php");
$anaSayfacont = new AnaSayfaController();
$anaSayfa = $anaSayfacont->anasayfa_getir();

$error = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["isim"]))) {
        array_push($error, "Sayfa İsmi Giriniz...");
    } else {
        $isim = trim($_POST["isim"]);
    }
    if (empty(trim($_POST["site_adi"]))) {
        array_push($error, "Site Adı Giriniz...");
    } else {
        $site_adi = trim($_POST["site_adi"]);
    }
    if (empty(trim($_POST["footer_yazi"]))) {
        array_push($error, "Footer Yazısı Giriniz...");
    } else {
        $footer_yazi = trim($_POST["footer_yazi"]);
    }
    if (count($error) == 0) {
        $flag = $anaSayfacont->panel_bilgi_guncelle($isim, $site_adi, $footer_yazi);
        if ($flag) {
            $message = "Panel Başarıyla Güncellendi";
            $anaSayfa = $anaSayfacont->anasayfa_getir();
        } else {
            array_push($error, "Hata");
        }
    }

}
?>
<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">

                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title"><i class="menu-icon fa fa-cogs"></i> Ana Menü Panel Bilgileri</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">

                        <?php if (count($error) > 0) { ?>
                            <div class="alert alert-danger " role="alert">
                                <?php foreach ($error as $er) { ?>
                                    - <?php echo $er; ?><br>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if ($message != '') { ?>
                            <div class="alert alert-success sonuc-cubuk" role="alert">
                                <span><?php echo $message; ?></span>
                            </div>
                        <?php } ?>
                        <div style="width:50%" class="widget-body container">
                            <form action="ana-menu-panel.php" method="POST">
                                <div class="row form-group">
                                    <div class="form-group col-md-6">
                                        <label class="mt-2">Site Adı</label>
                                        <input type="text" name="isim"
                                               value="<?php echo $anaSayfa['isim'] ?>"
                                               class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="mt-2">Ana Sayfa Site İsim</label>
                                        <input type="text" name="site_adi"
                                               value="<?php echo $anaSayfa['site_adi'] ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="mt-2">Footer Yazısı</label>
                                    <input type="text" name="footer_yazi"
                                           value="<?php echo $anaSayfa['footer_yazi'] ?>"
                                           class="form-control">
                                </div>
                                <div class="form-group pull-right">
                                    <a href="index.php">
                                        <button
                                                class="btn btn-outline mw-sm rounded btn-danger"
                                                type="button">
                                            İptal
                                        </button>
                                    </a>
                                </div>
                                <div class="form-group pull-right">
                                    <button style="margin-right: 5px;" class="btn btn-outline mw-xl rounded btn-inverse" type="submit"
                                            name="">BİLGİLERİ GÜNCELLE
                                    </button>
                                </div>
                            </form>
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->

            </div>
        </section>
    </div>
</main>

<?php include "footer.php" ?>


