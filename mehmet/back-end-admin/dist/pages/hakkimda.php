<?php include "header.php";

require_once("../../connect/HakkimdaController.php");
$hakkimdacont = new HakkimdaController();
$hakkimda = $hakkimdacont->hakkimda_getir();


$error = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["baslik"]))) {
        array_push($error, "Başlık Giriniz...");
    } else {
        $baslik = trim($_POST["baslik"]);
    }
    if (empty(trim($_POST["hakkimda"]))) {
        array_push($error, "Hakkımda İçeriği Giriniz...");
    } else {
        $hakkimda = trim($_POST["hakkimda"]);
    }
    if (empty(trim($_POST["web_site"]))) {
        array_push($error, "Web Site Adresi Giriniz...");
    } else {
        $web_site = trim($_POST["web_site"]);
    }
    if (empty(trim($_POST["mail"]))) {
        array_push($error, "E-Mail Adresi Giriniz...");
    } else {
        $mail = trim($_POST["mail"]);
    }
    if (count($error) == 0) {
        $flag = $hakkimdacont->hakkimda_guncelle($baslik, $hakkimda, $web_site, $mail);
        if ($flag) {
            $message = "Bilgiler Başarıyla Güncellendi";
            $hakkimda = $hakkimdacont->hakkimda_getir();
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
                                <h4 class="widget-title"><i class="menu-icon fa fa-info"></i> Hakkımda</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">

                            <?php if (count($error) > 0) { ?>
                                <div class="alert alert-danger" role="alert">
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
                            <div style="width:90%" class="widget-body container">
                                <form action="hakkimda.php" method="POST">

                                    <div class="form-group">
                                        <label class="mt-2">BAŞLIK</label>
                                        <input type="text" name="baslik" value="<?php echo $hakkimda['baslik'] ?>"
                                               class="form-control">
                                    </div>

                                    <div class="row form-group">
                                        <div class="form-group col-md-6">
                                            <label class="mt-2">WEB SİTE</label>
                                            <input type="text" name="web_site"
                                                   value="<?php echo $hakkimda['web_site'] ?>"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label class="mt-2">E-MAİL</label>
                                            <input type="text" name="mail" value="<?php echo $hakkimda['mail'] ?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="form-group col-md-4">
                                            <label class="mt-2">DOĞUM GÜNÜ</label>
                                            <input type="text" name="" value="<?php echo $hakkimda['dogum_tarihi'] ?>"
                                                   class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="mt-2">YAŞ</label>
                                            <input type="text" name="" value="<?php echo $hakkimda['yas'] ?>"
                                                   class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="mt-2"><strong>SON GÜNCELLEME TARİHİ</strong></label>
                                            <input type="text" name="" value="<?php echo $hakkimda['tarih'] ?>"
                                                   class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label  " for="first-name">HAKKIMDA
                                            <span class=""></span>
                                        </label>
                                        <div class="">
                                        <textarea name="hakkimda" id="editor"
                                                  class="form-control"><?php echo $hakkimda['hakkimda'] ?></textarea>
                                        </div>
                                    </div>

                                    <script type="text/javascript">

                                        CKEDITOR.replace('editor',
                                            {
                                                filebrowserBrowserUrl: 'ckfinder/ckfinder.html',
                                                filebrowserImageBrowserUrl: 'ckfinder/ckfinder.html?type=Images',
                                                filebrowserFlashBrowserUrl: 'ckfinder/ckfinder.html?type=Flash',
                                                filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                forcePasteAsPlainText: true
                                            }
                                        );

                                    </script>

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
                                        <button  style="margin-right: 5px;" class="btn btn-outline mw-xl rounded btn-inverse" type="submit"
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


