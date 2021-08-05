<?php include "header.php";

require_once("../../connect/ProjelerimController.php");
$projelercont = new ProjelerimController();

require_once("../../connect/CalismalarimController.php");
$calismalarcont = new CalismalarimController();


$error = [];
$message = "";
$id = $_GET['id'];
$proje = $projelercont->proje_bul($id);
$calisma = $calismalarcont->calisma_bul($proje['alan_id']);
$calismalar = $calismalarcont->calismalarim_getir();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $alan_id = $_POST['alan'];
    $durum = $_POST['durum'];

    if (empty(trim($_POST["baslik"]))) {
        array_push($error, "Lütfen İçerik Başlığı Giriniz...");
    } else {
        $baslik = trim($_POST["baslik"]);
        $seo_url = seo($_POST['baslik']);
    }
    if (empty(trim($_POST["aciklama"]))) {
        array_push($error, "Lütfen İçerik Giriniz...");
    } else {
        $aciklama = trim($_POST["aciklama"]);
    }

    if (count($error) == 0) {
        $flag = $projelercont->proje_guncelle($baslik, $aciklama, $alan_id, $durum, $seo_url, $id);
        if ($flag) {
            $message = "Proje Güncellendi";
        } else {
            array_push($error, "Hata");
        }
    }
    $proje = $projelercont->proje_bul($id);
    $calisma = $calismalarcont->calisma_bul($proje['alan_id']);
    $calismalar = $calismalarcont->calismalarim_getir();
}


?>


<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="widget p-lg">
            <div class="row">


                    <header class="widget-header">
                        <h4 class="widget-title"><i class="menu-icon fas fa-bacon"></i>
                            <strong><?php echo $proje['baslik'] ?></strong> Projesinin Bilgilerini Düzenle
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
                        <div class="row">
                            <form action="proje-duzenle.php" method="POST" class="form-horizontal">
                                <div class="form-group">
                                    <label class="mt-2">İçerik Hangi Başlık Altında?</label>
                                    <select name="alan" id="" class="form-control" required>
                                        <option value="<? echo $calisma['id'] ?>"><?php echo $calisma['ad'] ?></option>
                                        <?php foreach ($calismalar as $calis) { ?>
                                            <option value="<?php echo $calis['id'] ?>"><?php echo $calis['ad'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="row form-group">
                                    <div class="form-group col-md-8">
                                        <label class="mt-2">İçerik Başlığı</label>
                                        <input type="text" name="baslik" value="<?php echo $proje['baslik'] ?>"
                                               class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="mt-2">DURUM</label>
                                        <select name="durum" id="" class="form-control" required>
                                            <option value="1" <?php echo $proje['durum'] == 1 ? 'selected=""' : ''; ?>>
                                                Aktif
                                            </option>

                                            <option value="0" <?php echo $proje['durum'] == 0 ? 'selected=""' : ''; ?>>
                                                Pasif
                                            </option>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label  " for="first-name">İçerik
                                        <span class=""></span>
                                    </label>
                                    <div class="form-group">
                                        <textarea name="aciklama" id="editor"
                                                  class="form-control"><?php echo $proje['aciklama'] ?></textarea>
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
                                <div class="form-group pull-right">
                                    <a href="projelerim.php">
                                        <button
                                                class="btn btn-outline mw-sm rounded btn-danger"
                                                type="button">
                                            İptal
                                        </button>
                                    </a>
                                </div>
                                <div style="margin-right: 20px;" class="form-group pull-right">
                                    <button  class="btn btn-outline mw-xl rounded btn-inverse" type="submit" name="">
                                        Projeyi Düzenle
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include "footer.php" ?>




