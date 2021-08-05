<?php include "header.php";


require_once("../../connect/ProjelerimController.php");
$projelercont = new ProjelerimController();


$message = "";
if ($_GET['sil']) {
    $id = $_GET['sil'];
    $resim_sil = $projelercont->proje_resim_getir($id);
    foreach ($resim_sil as $item) {
        unlink($item['resim']);
    }
    $flag = $projelercont->proje_sil($id);
    if ($flag) {
        $message = "Silindi";
    } else {
        $err = "Başarısız";
    }
}
$projelerim = $projelercont->projelerim_getir();


if ($_GET['proje-ekleme'] == 'ok') {
    $message = "Ekleme İşlemi Başarılı";
}
?>


<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="widget p-lg">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="m-b-lg"><i class="menu-icon fa fa-laptop"></i>
                            Projelerim
                            <a href="proje-ekle.php" class="btn btn-outline btn-purple btn-xs pull-right">
                                <i class="fa fa-plus"></i>
                                Yeni Proje Ekle
                            </a>
                        </h4>
                    </div>
                    <div class="col-md-12">

                        <?php if ($message != '') { ?>
                            <div class="alert alert-success sonuc-cubuk" role="alert"><?php echo $message; ?></div>
                        <?php } elseif ($err != '') { ?>
                            <div class="alert alert-danger" role="alert"><?php echo $err; ?></div>
                        <?php } ?>
                        <div class="card-body">
                            <?php if (empty($projelerim)) { ?>
                                <div class="alert alert-danger alert-custom alert-dismissible text-center">
                                    <h4 class="alert-title">KAYIT BULUNAMADI!</h4>
                                    <p>Herhangi bir proje bulunamadı.</p>
                                </div>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th width="15%">
                                                <center>Konu</center>
                                            </th>
                                            <th width="25%">
                                                <center>Başlık</center>
                                            </th>
                                            <th>
                                                <center>VİDEOLAR</center>
                                            </th>
                                            <th>
                                                <center>RESİMLER</center>
                                            </th>
                                            <th>
                                                <center>Durum</center>
                                            </th>
                                            <th>
                                                <center>İşlem</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-projeler">
                                        <?php $say = 0;
                                        foreach ($projelerim as $proje) {
                                            $say++; ?>
                                            <tr id="id_<?php echo $proje['id'] ?>">
                                                <td> <?php echo mb_strtoupper($proje['ad']) ?></td>
                                                <td> <?php echo mb_strtoupper($proje['baslik']) ?></td>
                                                <td>
                                                    <center><small><a
                                                                    href="proje-videolar.php?id=<?php echo $proje['id'] ?>">
                                                                <button class="btn btn-outline btn-xs btn-dark">Video
                                                                    ekle-düzenle-sil
                                                                </button>
                                                            </a> </small></center>
                                                </td>
                                                <td>
                                                    <center><small><a
                                                                    href="proje-resimler.php?id=<?php echo $proje['id'] ?>">
                                                                <button class="btn btn-outline btn-xs btn-dark">Resim
                                                                    ekle-düzenle-sil
                                                                </button>
                                                            </a> </small></center>
                                                </td>
                                                <td><?php if ($proje['durum'] == 1) { ?>
                                                        <div style="padding: 0 4px ;margin: 0;border-right-width: 7px"
                                                             class="alert alert-success alert-custom alert-dismissible text-center">
                                                            <p class="alert-title">AKTİF</p>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div style="padding: 0 4px ;margin: 0;border-right-width: 7px"
                                                             class="alert alert-danger alert-custom alert-dismissible text-center">
                                                            <p class="alert-title">PASİF</p>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <center><small><a
                                                                    href="proje-duzenle.php?id=<?php echo $proje['id'] ?>">
                                                                <button class="btn btn-outline mw-xs btn-primary btn-sm">
                                                                    <i class="fa fa-edit"></i> Düzenle
                                                                </button>
                                                            </a>
                                                            <button data-url="projelerim.php?sil=<?php echo $proje['id'] ?>"
                                                                    class="btn btn-outline mw-xs btn-danger btn-sm sil-proje">
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


