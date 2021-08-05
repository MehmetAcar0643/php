<?php include "header.php";

require_once("../../connect/AnaSayfaController.php");
$anaSayfacont = new AnaSayfaController();
$anaSayfa = $anaSayfacont->anasayfa_getir();

$error = [];
$message = "";
$uzantilar = array('jpg', 'jpeg', 'png');
if (isset($_POST['site_logo_guncelle'])) {

    if ($_FILES['site_logo']["name"] > 2097152) {
        header("Location:ana-menu-panel-fotolari.php?durum=dosya-buyuk");
    } else {
        $ext = strtolower(substr($_FILES['site_logo']["name"], strpos($_FILES['site_logo']["name"], '.') + 1));
        if (in_array($ext, $uzantilar) === false) {
            header("Location:ana-menu-panel-fotolari.php?durum=no");
        } else {
            $uploads_dir = 'images';

            @$tmp_name = $_FILES['site_logo']["tmp_name"];
            @$name = $_FILES['site_logo']["name"];


            $benzersizsayi = rand(20000, 32000);
            $refimgyol = $uploads_dir . "/" . $benzersizsayi . $name;
            @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi$name");

            if (strlen($refimgyol) > 0) {
                $flag = $anaSayfacont->site_logo_guncelle($refimgyol);
                if ($flag) {
                    $logo_sil = $_POST['eski_logo'];
                    unlink($logo_sil);
                    $message = "Site Logosu Başarıyla Güncellendi...";
                    $anaSayfa = $anaSayfacont->anasayfa_getir();
                } else {
                    array_push($error, "Hata");
                }
            }
        }
    }
}
if (isset($_POST['site_resim_guncelle'])) {


    if ($_FILES['site_resim']["size"] > 2097152) {
        header("Location:ana-menu-panel-fotolari.php?durum=dosya-buyuk");
    } else {
        $ext = strtolower(substr($_FILES['site_resim']["name"], strpos($_FILES['site_resim']["name"], '.') + 1));
        if (in_array($ext, $uzantilar) === false) {
            header("Location:ana-menu-panel-fotolari.php?durum=no");
        } else {
            $uploads_dir1 = 'images';
            @$tmp_name = $_FILES['site_resim']["tmp_name"];
            @$name = $_FILES['site_resim']["name"];

            $benzersizsayi1 = rand(20000, 32000);
            $refimgyol1 = $uploads_dir1 . "/" . $benzersizsayi1 . $name;
            @move_uploaded_file($tmp_name, "$uploads_dir1/$benzersizsayi1$name");

            if (strlen($refimgyol1) > 0) {
                $flag = $anaSayfacont->site_resim_guncelle($refimgyol1);
                if ($flag) {
                    $resim_sil = $_POST['eski_resim'];
                    unlink($resim_sil);
                    $message = "Site Anasayfa Resmi Başarıyla Güncellendi...";
                    $anaSayfa = $anaSayfacont->anasayfa_getir();
                } else {
                    array_push($error, "Hata");
                }
            }
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
                            <h4 class="widget-title"><i class="menu-icon fa fa-image"></i> Panel Fotoları
                            </h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">

                        <?php if (count($error) > 0) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php foreach ($error as $er) { ?>
                                    - <?php echo $er; ?><br>
                                <?php } ?>
                            </div>
                        <?php }
                        if ($message != '') { ?>
                            <div class="alert alert-success sonuc-cubuk" role="alert"><?php echo $message; ?></div>
                        <?php }
                        if ($_GET['durum'] == "no") { ?>
                            <div class="alert alert-danger" role="alert">
                                Sadece "<?php foreach ($uzantilar as $row) {
                                    echo "." . $row . " ";
                                } ?>" uzantılı dosyalar kabul...
                            </div>
                        <?php } elseif ($_GET['durum'] == "dosya-buyuk") { ?>
                            <div class="alert alert-danger" role="alert">
                                DOSYA BOYUTU BÜYÜK...
                            </div>
                        <?php } ?>
                        <div style="width:50%" class="widget-body container">
                            <div class="row">
                                <div class="col-md-5">
                                    <form action="ana-menu-panel-fotolari.php" method="POST" class="form-horizontal"
                                          enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="mt-2">Site LOGOSU</label>
                                            <div style="text-align: center" class="form-group">
                                                <?php
                                                if (strlen($anaSayfa['site_logo']) > 0) {
                                                    ?>
                                                    <img width="200"
                                                         src="<?php echo $anaSayfa['site_logo']; ?>">
                                                <?php } else { ?>
                                                    <img width="200" src="images/logo_yok.png">
                                                <?php } ?>
                                            </div>
                                            <div class="">
                                                <div class="">
                                                    <input type="file" name="site_logo" value=""
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="eski_logo"
                                               value="<?php echo $anaSayfa['site_logo'] ?>">
                                        <div class="form-group">
                                            <button style="float: right"
                                                    class="btn btn-outline mw-xl rounded btn-inverse" type="submit"
                                                    name="site_logo_guncelle">Site Logosu GÜNCELLE
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                    <form action="ana-menu-panel-fotolari.php" method="POST" class="form-horizontal"
                                          enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="mt-2">Site Anasayfa Resmi</label>
                                            <div style="text-align: center" class="form-group">
                                                <?php
                                                if (strlen($anaSayfa['site_resim']) > 0) {
                                                    ?>
                                                    <img width="200"
                                                         src="<?php echo $anaSayfa['site_resim']; ?>">
                                                <?php } else { ?>
                                                    <img width="200" src="images/logo_yok.png">
                                                <?php } ?>
                                            </div>
                                            <div class="">
                                                <div class="">
                                                    <input type="file" name="site_resim" value=""
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="eski_resim"
                                               value="<?php echo $anaSayfa['site_resim'] ?>">
                                        <div class="form-group">
                                            <button style="float: right"
                                                    class="btn btn-outline mw-xl rounded btn-inverse" type="submit"
                                                    name="site_resim_guncelle">Anasayfa Resmini Güncelle
                                            </button>
                                        </div>
                                    </form
                                </div>
                            </div>
                        </div><!-- .widget-body -->
                        <div class="form-group text-center">
                            <a href="index.php">
                                <button
                                        class="btn btn-outline mw-xl rounded btn-danger"
                                        type="button">
                                    İptal
                                </button>
                            </a>
                        </div>
                    </div><!-- .widget -->

                </div>
            </section>
        </div>
    </main>

<?php include "footer.php" ?>