<?php include "header.php";


require_once("../../connect/AnaSayfaController.php");
$anaSayfacont = new AnaSayfaController();
$anaSayfa = $anaSayfacont->sosyal_medya_getir();

$error = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $twitter = $_POST['twitter'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];

    $flag = $anaSayfacont->sosyal_medya_guncelle($twitter, $facebook, $instagram, $linkedin);
    if ($flag) {
        $message = "Sosyal Medya Bilgileri Başarıyla Güncellendi";
        $anaSayfa = $anaSayfacont->sosyal_medya_getir();
    } else {
        array_push($error, "Hata");
    }


}


?>

    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="row">

                        <div class="widget">
                            <header class="widget-header">
                                <h4 class="widget-title"><i class="menu-icon fa fa-hashtag"></i> Sosyal Medya
                                </h4>
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
                            <div style="width:50%" class="widget-body container">
                                <form action="sosyal_medya.php" method="POST">

                                    <div class="form-group">
                                        <label class="mt-2">Twitter <i class="fa fa-twitter"></i></label>
                                        <input type="text" name="twitter" value="<?php echo $anaSayfa['twitter'] ?>"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="mt-2">Facebook <i class="fa fa-facebook"></i></label>
                                        <input type="text" name="facebook" value="<?php echo $anaSayfa['facebook'] ?>"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="mt-2">İnstagram <i class="fa fa-instagram"></i></label>
                                        <input type="text" name="instagram" value="<?php echo $anaSayfa['instagram'] ?>"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mt-2">Linkedin <i
                                                    class="fa fa-linkedin"></i></label>
                                        <input type="text" name="linkedin" value="<?php echo $anaSayfa['linkedin'] ?>"
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