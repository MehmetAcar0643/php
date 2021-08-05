<?php include "header.php";

require_once("../../connect/CalismalarimController.php");
$calismalarcont = new CalismalarimController();

$error = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $calisma = $calismalarcont->calisma_bul($id);
}
$id = $_POST['id'];
if (isset($_POST['duzenle'])) {

    $yuzde = $_POST['yuzde'];
    $durum = $_POST['durum'];
    $projeler_durum = $_POST['projeler_durum'];

    if (empty(trim($_POST["ad"]))) {
        array_push($error, "Lütfen Konu Giriniz...");
    } else {
        $ad = trim($_POST["ad"]);
        $seo_url = seo($_POST['ad']);
    }

    if (count($error) == 0) {
        $flag = $calismalarcont->calisma_guncelle($ad, $yuzde, $durum, $projeler_durum, $seo_url, $id);
        if ($flag) {
            $message = "Çalışma Güncellendi";
        } else {
            array_push($error, "Hata");
        }
    }
    $calisma = $calismalarcont->calisma_bul($id);
}
$uzantilar = array('jpg', 'jpeg', 'png');
if (isset($_POST['kapak_foto_guncelle'])) {


    if ($_FILES['kapak_foto']["size"] > 2097152) {
        header("Location:calisma-duzenle.php?id=$id&durum=dosya-buyuk");
    } else {
        $ext = strtolower(substr($_FILES['kapak_foto']["name"], strpos($_FILES['kapak_foto']["name"], '.') + 1));
        if (in_array($ext, $uzantilar) === false) {
            header("Location:calisma-duzenle.php?id=$id&durum=no");
        } else {
            $id = $_POST['id'];
            $uploads_dir = 'images';

            @$tmp_name = $_FILES['kapak_foto']["tmp_name"];
            @$name = $_FILES['kapak_foto']["name"];


            $benzersizsayi = rand(20000, 32000);
            $refimgyol = $uploads_dir . "/" . $benzersizsayi . $name;
            @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi$name");

            if (strlen($refimgyol) > 0) {
                $flag = $calismalarcont->kapak_foto_guncelle($refimgyol, $id);
                if ($flag) {
                    $logo_sil = $_POST['eski_foto'];
                    unlink($logo_sil);
                    $message = "Fotoğraf Başarıyla Güncellendi...";
                    $calisma = $calismalarcont->calisma_bul($id);
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
                <div class="widget p-lg">
                <div class="row">


                            <header class="widget-header">
                                <h4 class="widget-title"><i class="menu-icon fas fa-bacon"></i>
                                    <strong><?php echo $calisma['ad'] ?></strong> Çalışmasının Bilgilerini Düzenle </h4>
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
                            <div style="width:90%" class="widget-body container">
                                <div class="form-group row">
                                    <div style="margin-bottom: 100px;" class="form-group col-md-4">
                                        <form action="calisma-duzenle.php" method="POST"
                                              enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div  class="form-group text-center">
                                                    <?php
                                                    if (strlen($calisma['kapak_foto']) > 0) {
                                                        ?>
                                                        <img width="40%"
                                                             src="<?php echo $calisma['kapak_foto']; ?>">
                                                    <?php } else { ?>
                                                        <img width="40%" src="images/logo_yok.png">
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input type="file" name="kapak_foto" value=""
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="eski_foto"
                                                   value="<?php echo $calisma['kapak_foto'] ?>">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?php echo $calisma['id'] ?>">
                                                <button style="float: right" class="btn btn-outline mw-xl rounded btn-inverse" type="submit"
                                                        name="kapak_foto_guncelle">Fotoğrafı Güncelle
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <form action="calisma-duzenle.php" method="POST"
                                              oninput="asd.value=parseInt(a.value)">
                                            <div style="width: 70%" class="form-group mb-1">
                                                <label class="mt-2">Konu</label>
                                                <input type="text" name="ad" value="<?php echo $calisma['ad'] ?>"
                                                       maxlength="2000" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="mt-2">Bilgi Yüzdesi</label><br>
                                                <div class="form-group row">
                                                    <div class="form-group col-md-10">
                                                        <input type="range" id="a" name="yuzde"
                                                               value="<?php echo $calisma['yuzde'] ?>"
                                                               class="">
                                                    </div>
                                                    <div style="margin-top: -10px;" class="form-group col-md-2">
                                                        <input name="asd" for="a" class="form-control"
                                                               value="<?php echo $calisma['yuzde'] ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class=" form-group row">
                                                <div class="form-group col-md-6">
                                                    <label class="mt-2">DURUM</label>
                                                    <select name="durum" id="" class="form-control" required>

                                                        a

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="mt-2"><strong>PROJELER DURUM</strong></label>
                                                    <select style="background-color: #f5c6cb;font-weight: bold;"
                                                            name="projeler_durum" id="" class="form-control" required>

                                                        <option style="font-weight: bold;"
                                                                value="1" <?php echo $calisma['projeler_durum'] == 1 ? 'selected=""' : ''; ?>>
                                                            Aktif
                                                        </option>

                                                        <option style="font-weight: bold;"
                                                                value="0" <?php echo $calisma['projeler_durum'] == 0 ? 'selected=""' : ''; ?>>
                                                            Pasif
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>

                                            <input type="hidden" name="id" value="<?php echo $calisma['id'] ?>">

                                            <div style="margin-right: 5px;" class="form-group pull-right">
                                                <button  class="btn btn-outline mw-xl rounded btn-inverse" type="submit" name="duzenle">
                                                    Çalışmayı Düzenle
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- .widget-body -->

                    <div class="form-group text-center ">
                        <a href="calismalarim.php">
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