<?php include "header.php";

require_once("../../connect/CalismalarimController.php");
$calismalarcont = new CalismalarimController();
$calismalar = $calismalarcont->calismalarim_getir();
require_once("../../connect/ProjelerimController.php");
$projelercont = new ProjelerimController();
$proje_sira = $projelercont->proje_sira_cek();

$error = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sira = $_POST['sira'];
    $sira++;
    $alan_id = $_POST['alan'];
    $durum = $_POST['durum'];

    if (empty(trim($_POST["baslik"]))) {
        array_push($error, "Lütfen İçerik Başlığı Giriniz...");
    } else {
        $baslik = $_POST['baslik'];
        $seo_url = seo($_POST['baslik']);
    }
    if (empty(trim($_POST["aciklama"]))) {
        array_push($error, "Lütfen İçerik Giriniz...");
    } else {
        $aciklama = $_POST['aciklama'];
    }
    if (count($error) == 0) {
        $flag = $projelercont->proje_ekle($baslik, $aciklama, $alan_id, $durum, $sira, $seo_url);
        if ($flag) {
            header("Location:projelerim.php?proje-ekleme=ok");
        } else {
            array_push($error, "Hata");
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
                            <strong>Proje Ekle</h4>
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
                    <?php } ?>
                    <div style="width:90%" class="widget-body container">
                        <form action="proje-ekle.php" method="POST">
                            <div class="form-group">
                                <label class="mt-2">İçerik Hangi Başlık Altında?</label>
                                <select name="alan" id="" class="form-control" required>
                                    <?php foreach ($calismalar as $calis) { ?>
                                        <option value="<?php echo $calis['id'] ?>"><?php echo $calis['ad'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-8 ">
                                    <label class="mt-2">İçerik Başlığı</label>
                                    <input type="text" name="baslik" value=""
                                           class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="mt-2">DURUM</label>
                                    <select name="durum" id="" class="form-control" required>
                                        <option value="1">
                                            Aktif
                                        </option>

                                        <option value="0">
                                            Pasif
                                        </option>

                                    </select>
                                </div>

                                <input type="hidden" name="sira" value="<?php echo $proje_sira['sira'] ?>"
                                       class="form-control">

                            </div>


                            <div class="form-group">
                                <label class="control-label  " for="first-name">İçerik
                                    <span class=""></span>
                                </label>
                                <div class="form-group">
                                        <textarea name="aciklama" id="editor"
                                                  class="form-control"></textarea>
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

                            <input type="hidden" name="id" value="<?php echo $proje['id'] ?>">
                            <div class="form-group pull-right pull-right">
                                <a href="projelerim.php">
                                    <button
                                            class="btn btn-outline mw-sm  btn-danger"
                                            type="button">
                                        İptal
                                    </button>
                                </a>
                            </div>

                            <div class="form-group pull-right">
                                <button style="margin-right: 5px;" class="btn btn-outline mw-xl btn-purple" type="submit"
                                        name="">
                                    Projeyi Ekle
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
</main>


<?php include "footer.php" ?>














