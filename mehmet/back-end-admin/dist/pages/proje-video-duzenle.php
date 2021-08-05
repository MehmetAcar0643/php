<?php include "header.php";

require_once("../../connect/ProjelerimController.php");
$projelercont = new ProjelerimController();

$error = [];
$message = "";
if ($_GET['duzenle']) {
    $id = $_GET['duzenle'];
}
$proje_video = $projelercont->proje_video_bul($id);


if (isset($_POST['cihaz-duzenle'])) {

    $id = $_POST['id'];
    $durum = $_POST['durum'];
    $video_link=$_POST['cihaz-video-link'];

    if (count($error) == 0) {
        $flag = $projelercont->proje_video_guncelle($video_link,$durum, $id);
        if ($flag) {
            $message = "Proje Durumu Güncellendi";
        } else {
            array_push($error, "Hata");
        }
    }
    $proje_video = $projelercont->proje_video_bul($id);
}

if (isset($_POST['youtube-duzenle'])) {

    $id = $_POST['id'];
    $durum = $_POST['durum'];
    $video_link=$_POST['video_link'];

    if (count($error) == 0) {
        $flag = $projelercont->proje_video_guncelle($video_link,$durum, $id);
        if ($flag) {
            $message = "Proje Durumu Güncellendi";
        } else {
            array_push($error, "Hata");
        }
    }
    $proje_video = $projelercont->proje_video_bul($id);
}



?>


    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="widget p-lg">
                    <div class="row">
                        <header class="widget-header">
                            <h4 class="widget-title"><i class="menu-icon fas fa-bacon"></i>
                                Video Düzenle </h4>
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
                            <form action="proje-video-duzenle.php" method="POST">
                                <div class="form-group col-md-7">
                                    <div class="form-group text-center">
                                        <?php if (substr($proje_video['video'], 0, 14) == "proje_videolar") { ?>
                                            <video width="100%" src="<?php echo $proje_video['video'] ?>"
                                                   controls="controls"></video>
                                        <?php } else { ?>
                                            <iframe width="100%" height="315"
                                                    src="https://www.youtube.com/embed/<?php echo $proje_video['video'] ?>"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if (substr($proje_video['video'], 0, 14) != "proje_videolar") { ?>
                                    <div style="" class="form-group col-md-5">
                                        <label class="mt-2">Video Linki</label>
                                        <input type="text" name="video_link" class="form-control"
                                               value="<?php echo $proje_video['video'] ?>">
                                    </div>
                                <?php } ?>
                                <div style="" class="form-group col-md-5">
                                    <label class="mt-2">DURUM</label>
                                    <select name="durum" id="" class="form-control" required>
                                        <option value="1" <?php echo $proje_video['durum'] == 1 ? 'selected=""' : ''; ?>>
                                            Aktif
                                        </option>

                                        <option value="0" <?php echo $proje_video['durum'] == 0 ? 'selected=""' : ''; ?>>
                                            Pasif
                                        </option>
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $proje_video['id'] ?>">
                                <div class="form-group pull-right">
                                    <a href="proje-videolar.php?id=<?php echo $proje_video['proje_id'] ?>">
                                        <button style="float: right"
                                                class="btn btn-outline mw-sm rounded btn-danger sonuc-iptal"
                                                type="button">
                                            İptal
                                        </button>
                                    </a>
                                </div>
                                <?php if (substr($proje_video['video'], 0, 14) == "proje_videolar") { ?>
                                    <input type="hidden" name="cihaz-video-link" value="<?php echo $proje_video['video'] ?>">
                                <?php } ?>
                                <div style="margin-right: 5px;" class="form-group pull-right">
                                    <?php if (substr($proje_video['video'], 0, 14) == "proje_videolar") { ?>
                                        <button style="float: right"
                                                class="btn btn-outline mw-xl rounded btn-inverse sonuc-duzenle"
                                                type="submit" name="cihaz-duzenle">
                                            Projeyi Düzenle
                                        </button>
                                    <?php } else { ?>
                                        <button style="float: right"
                                                class="btn btn-outline mw-xl rounded btn-info sonuc-duzenle"
                                                type="submit" name="youtube-duzenle">
                                            Projeyi Düzenle
                                        </button>
                                    <?php } ?>
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