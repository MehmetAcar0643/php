<?php include "header.php";


if ($_GET['id']) {
    $id = $_GET['id'];
}
if ($_GET['durum'] == "ok") {
    $message = "Video başarıyla eklendi";
}
if ($_GET['durum'] == "hata") {
    $err = "Video Yüklemesi Başarısız";
}


require_once("../../connect/ProjelerimController.php");
$projelercont = new ProjelerimController();
$proje_videolari = $projelercont->proje_video_getir($id);
$proje_baslik = $projelercont->proje_baslik_getir($id);

if ($_GET['sil']) {
    $asd = $_GET['sil'];
    $flag = $projelercont->proje_video_klasörden_sil($asd);
    $proje_id = $flag['proje_id'];
    unlink($flag['video']);
    $flag2 = $projelercont->proje_video_sil($asd);
    $proje_videolari = $projelercont->proje_video_getir($proje_id);
    $proje_baslik = $projelercont->proje_baslik_getir($proje_id);
    if ($flag2) {
        $message = "Silindi";

    } else {
        $message = "Başarısız";
    }
}


?>


<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">

                <div class="col-md-12">
                    <div class="widget p-lg">
                        <div>
                            <div class="row">
                                <h4 class="m-b-lg"><i
                                            class="menu-icon fab fa-r-project"></i><strong>
                                        <?php echo mb_strtoupper($proje_baslik['baslik']) ?></strong>
                                    Proje Videoları
                                    <a href="proje-video-ekle.php?id=<?php echo $_GET['id']; ?>"
                                       class="btn btn-outline btn-purple btn-xs pull-right">
                                        <i class="fa fa-plus"></i>
                                        Yeni Videolar Ekle
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <hr class="widget-separator">
                        <?php if ($message != '' || $_GET['durum'] == "ok") { ?>
                            <div class="alert alert-success sonuc-cubuk" role="alert"><?php echo $message; ?></div>
                        <?php }
                        if ($err != '') { ?>
                            <div class="alert alert-danger sonuc-cubuk" role="alert"><?php echo $err; ?></div>
                        <?php } ?>
                        <div class="card-body">
                            <?php if (empty($proje_videolari)) { ?>
                                <div class="alert alert-danger alert-custom alert-dismissible text-center">
                                    <h4 class="alert-title">KAYIT BULUNAMADI!</h4>
                                    <p>Herhangi bir video bulunamadı.
                                    </p>
                                </div>
                            <?php } else { ?>
                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th width="50%">
                                                <center>Video</center>
                                            </th>
                                            <th width="5%">
                                                <center>Video Adı</center>
                                            </th>
                                            <th width="5%">
                                                <center>Durum</center>
                                            </th>
                                            <th width="15%">
                                                <center>İşlem</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-proje-videolar">
                                        <?php $say = 0;
                                        foreach ($proje_videolari as $video) {
                                            $say++; ?>
                                            <tr id="id_<?php echo $video['id'] ?>">
                                                <td>
                                                    <center>
                                                        <?php if (substr($video['video'], 0, 14) == "proje_videolar") { ?>
                                                            <video width="50%" src="<?php echo $video['video'] ?>"
                                                                   controls="controls"></video>
                                                        <?php } else { ?>
                                                            <iframe width="50%" height="50%"
                                                                    src="https://www.youtube.com/embed/<?php echo $video['video']?>"
                                                                    frameborder="0"
                                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                    allowfullscreen></iframe>

                                                        <?php } ?>

                                                    </center>
                                                </td>

                                                <td> <?php
                                                    if (substr($video['video'], 0, 14) == "proje_videolar") {
                                                        echo substr($video['video'], 35);
                                                    } else {
                                                        echo  $video['video'];
                                                    } ?>
                                                </td>
                                                <td><?php if ($video['durum'] == 1) { ?>
                                                        <div style="padding: 0 4px ;margin: 0;border-right-width: 7px"
                                                             id="asd"
                                                             class="alert alert-info alert-custom alert-dismissible text-center">
                                                            <p class="alert-title">AKTİF</p>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div style="padding: 0 4px ;margin: 0;border-right-width: 7px"
                                                             class="alert alert-warning alert-custom alert-dismissible text-center">
                                                            <p class="alert-title">PASİF</p>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <center><small><a
                                                                    href="proje-video-duzenle.php?duzenle=<?php echo $video['id'] ?>">
                                                                <button class="btn btn-outline mw-sm btn-primary btn-sm ">
                                                                    <i class="fa fa-edit"></i>Düzenle
                                                                </button>
                                                            </a>
                                                        </small>

                                                        <small>
                                                            <button data-url="proje-videolar.php?sil=<?php echo $video['id'] ?>"
                                                                    class="btn btn-outline mw-sm btn-danger btn-sm sil-video">
                                                                <i class="menu-icon fa fa-trash"></i>Sil
                                                            </button>
                                                        </small></center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div><!-- .widget -->
                </div><!-- END column -->

            </div>
        </section>
    </div>
</main>


<?php include "footer.php" ?>

