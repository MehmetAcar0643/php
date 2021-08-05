<?php include "header.php";

require_once("../../connect/ProjelerimController.php");
$projelercont = new ProjelerimController();

$error = [];
$message = "";
if ($_GET['duzenle']) {
    $id = $_GET['duzenle'];
}
$proje_resim = $projelercont->proje_resim_bul($id);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $durum = $_POST['durum'];

    if (count($error) == 0) {
        $flag = $projelercont->proje_durum_guncelle($durum, $id);
        if ($flag) {
            $message = "Proje Durumu Güncellendi";
        } else {
            array_push($error, "Hata");
        }
    }
    $proje_resim = $projelercont->proje_resim_bul($id);
}

?>


    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="widget p-lg">
                    <div class="row">
                        <header class="widget-header">
                            <h4 class="widget-title"><i class="menu-icon fas fa-bacon"></i>
                                Resmi Düzenle </h4>
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
                            <form action="proje-resim-duzenle.php" method="POST">
                                <div class="form-group col-md-8">
                                    <div class="form-group text-center">
                                        <img width="100%" src="<?php echo $proje_resim['resim'] ?>" alt="">
                                    </div>
                                </div>
                                <div style="" class="form-group col-md-4">
                                    <label class="mt-2">DURUM</label>
                                    <select name="durum" id="" class="form-control" required>
                                        <option value="1" <?php echo $proje_resim['durum'] == 1 ? 'selected=""' : ''; ?>>
                                            Aktif
                                        </option>

                                        <option value="0" <?php echo $proje_resim['durum'] == 0 ? 'selected=""' : ''; ?>>
                                            Pasif
                                        </option>
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $proje_resim['id'] ?>">
                                <div class="form-group pull-right">
                                    <a href="proje-resimler.php?id=<?php echo $proje_resim['proje_id'] ?>">
                                        <button style="float: right"
                                                class="btn btn-outline mw-sm rounded btn-danger"
                                                type="button">
                                            İptal
                                        </button>
                                    </a>
                                </div>
                                <div style="margin-right: 5px;" class="form-group pull-right">

                                    <button style="float: right"
                                            class="btn btn-outline mw-xl rounded btn-inverse"
                                            type="submit">
                                        Projeyi Düzenle
                                    </button>

                                </div>

                            </form>
                        </div>
                    </div><!-- .widget-body -->
                </div><!-- .widget -->

        </div>
        </section>
        </div>
    </main>

<?php include "footer.php" ?>