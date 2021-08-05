<?php include "header.php";

require_once("../../connect/HakkimdaController.php");
$hakkimdacont = new HakkimdaController();
$hakkimda = $hakkimdacont->hakkimda_getir();

$error = [];
$message = "";
$uzantilar = array('jpg', 'jpeg', 'png');
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if ($_FILES['resim']["size"] > 2097152) {
        header("Location:hakkimda-foto.php?durum=dosya-buyuk");
    } else {
        $ext = strtolower(substr($_FILES['resim']["name"], strpos($_FILES['resim']["name"], '.') + 1));
        if (in_array($ext, $uzantilar) === false) {
            header("Location:hakkimda-foto.php?durum=no");
        } else {
            $uploads_dir = 'images';
            @$tmp_name = $_FILES['resim']["tmp_name"];
            @$name = $_FILES['resim']["name"];


            $benzersizsayi = rand(20000, 32000);
            $refimgyol = $uploads_dir . "/" . $benzersizsayi . $name;
            @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi$name");

            if (strlen($refimgyol) > 0) {
                $flag = $hakkimdacont->hakkimda_resim_guncelle($refimgyol);
                if ($flag) {
                    $logo_sil = $_POST['eski_resim'];
                    unlink($logo_sil);
                    $message = "Resim Başarıyla Güncellendi...";
                    $hakkimda = $hakkimdacont->hakkimda_getir();
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
                            <h4 class="widget-title"><i class="menu-icon fa fa-image"></i> Hakkımda</h4>
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
                        <div style="width:60%" class="widget-body container">
                            <form action="hakkimda-foto.php" method="POST"
                                  enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="mt-2">Hakkımda Resmi</label>
                                    <div style="text-align: center" class="form-group">
                                        <?php
                                        if (strlen($hakkimda['resim']) > 0) {
                                            ?>
                                            <img width="200"
                                                 src="<?php echo $hakkimda['resim']; ?>">
                                        <?php } else { ?>
                                            <img width="200" src="images/logo_yok.png">
                                        <?php } ?>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <input type="file" name="resim" value=""
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="eski_resim" value="<?php echo $hakkimda['resim'] ?>">

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
                                            name="">Fotoğrafı güncelle
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
