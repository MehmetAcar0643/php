<?php include "header.php";

require_once("../../connect/CalismalarimController.php");
$calismalarcont = new CalismalarimController();
$calisma_sira = $calismalarcont->calisma_sira_cek();


$error = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sira = $_POST['sira'];
    $sira++;
    $yuzde = $_POST['yuzde'];
    $durum = $_POST['durum'];
    $projeler_durum = $_POST['projeler_durum'];

    if (empty(trim($_POST["ad"]))) {
        array_push($error, "Lütfen Konu Giriniz...");
    } else {
        $ad = trim($_POST["ad"]);
        $seo_url = seo($_POST['ad']);
        $dene = $calismalarcont->calisma_var_mı($ad);
        if ($dene['ad'] == mb_strtoupper($ad)) {
            $message = "Aynı çalışma konusundan var!!";
        } else {

            if (count($error) == 0) {
                $flag = $calismalarcont->calisma_ekle($ad, $yuzde, $durum, $projeler_durum, $seo_url, $sira);
                if ($flag) {
                    header("Location:calismalarim.php?calisma-ekleme=ok");
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
                                <strong>Çalışma Ekle</h4>
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
                            <form action="calisma-ekle.php" method="POST" oninput="asd.value=parseInt(a.value)">
                                <div style="width: 70%" class="form-group">
                                    <label class="mt-2">Konu</label>
                                    <input type="text" name="ad" value=""
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="mt-2">Bilgi Yüzdesi</label><br>
                                    <div class="form-group row">
                                        <div class="form-group col-md-11">
                                            <input type="range" id="a" name="yuzde"
                                                   value="0" class=""></div>
                                        <div class="form-group col-md-1">
                                            <input style="margin-top: -10px;" name="asd" for="a"
                                                   class="form-control"
                                                   value="" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-6">
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
                                    <div class="form-group col-md-6">
                                        <label style="font-weight: bold;" class="mt-2">PROJELER DURUM</label>
                                        <select style="font-weight: bold;" name="projeler_durum" id=""
                                                class="form-control" required>

                                            <option style="font-weight: bold;" value="1">
                                                Aktif
                                            </option>

                                            <option style="font-weight: bold;" value="0">
                                                Pasif
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="sira" value="<?php echo $calisma_sira['sira'] ?>">
                                <div class="form-group pull-right ">
                                    <a href="calismalarim.php">
                                        <button style="float: right"
                                                class="btn btn-outline mw-sm  btn-danger"
                                                type="button">
                                            İptal
                                        </button>
                                    </a>
                                </div>
                                <div style="margin-right: 5px;" class="form-group pull-right">
                                    <button class="btn btn-outline mw-xl btn-purple"
                                            type="submit" name="">Çalışmayı Ekle
                                    </button>
                                </div>
                            </form
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->


                </div>
            </section>
        </div>
    </main>

<?php include "footer.php" ?>