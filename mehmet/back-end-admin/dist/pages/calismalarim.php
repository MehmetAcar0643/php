<?php include "header.php";


require_once("../../connect/CalismalarimController.php");
$calismalarcont = new CalismalarimController();



$message = "";
if ($_GET['sil']) {
    $id = $_GET['sil'];
    $resim_sil = $calismalarcont->calisma_resim_klasörden_sil($id);
    unlink($resim_sil['kapak_foto']);
    $flag = $calismalarcont->calisma_sil($id);
    if ($flag) {
        $message = "Silindi";
    } else {
        $message = "Başarısız";
    }
}


$calismalarim = $calismalarcont->calismalarim_getir();
$calisma_aciklama = $calismalarcont->calisma_aciklama_getir();

if ($_GET['calisma-ekleme'] == 'ok') {
    $message = "Ekleme İşlemi Başarılı";
}


?>

<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="widget p-lg">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="m-b-lg"><i class="menu-icon fa fa-server"></i>
                            Çalışmalarım
                            <a href="calisma-ekle.php" class="btn btn-outline btn-purple btn-xs pull-right">
                                <i class="fa fa-plus"></i>
                                Yeni Çalışma Ekle
                            </a>
                        </h4>
                    </div>

                    <div class="col-md-12">
                        <?php if ($message != '') { ?>
                            <div class="alert alert-success sonuc-cubuk" role="alert"><?php echo $message; ?></div>
                        <?php } ?>
                        <div class="card-body">
                            <?php if (empty($calismalarim)) { ?>
                                <div class="alert alert-danger alert-custom alert-dismissible text-center">
                                    <h4 class="alert-title">KAYIT BULUNAMADI!</h4>
                                    <p>Herhangi bir çalışma bulunamadı.</p>
                                </div>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered " id="dataTable" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th width="150">
                                                <center>Kapak Fotoğrafı</center>
                                            </th>
                                            <th width="25%">
                                                <center>Konu</center>
                                            </th>
                                            <th width="200">
                                                <center>Yüzde</center>
                                            </th>
                                            <th width="5%">
                                                <center>Durum</center>
                                            </th>
                                            <th width="10%">
                                                <center>Projeler Durum</center>
                                            </th>
                                            <th width="">
                                                <center> İŞLEMLER</center>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody class=" table-calismalar">
                                        <?php foreach ($calismalarim as $calisma) {?>
                                            <tr id="id_<?php echo $calisma['id'] ?>">
                                                <td>
                                                    <center><?php
                                                        if (strlen($calisma['kapak_foto']) > 0) {
                                                            ?>
                                                            <img width="30%"
                                                                 src="<?php echo $calisma['kapak_foto'] ?>">
                                                        <?php } else { ?>
                                                            <img width="30%" src="images/logo_yok.png">
                                                        <?php } ?></center>
                                                </td>
                                                <td> <?php echo mb_strtoupper($calisma['ad']) ?></td>
                                                <td>
                                                    <div style="border: 1px solid;margin: 0;" class=" progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                             aria-valuemin="0" aria-valuemax="100"
                                                             style="width:<?php echo $calisma['yuzde'] ?>%">
                                                            <?php echo $calisma['yuzde'] ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php if ($calisma['durum'] == 1) { ?>
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
                                                <td><?php if ($calisma['projeler_durum'] == 1) { ?>
                                                        <div style="padding: 0 4px ;margin: 0;border-right-width: 7px"
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
                                                                    href="calisma-duzenle.php?id=<?php echo $calisma['id'] ?>">
                                                                <button class="btn btn-outline mw-sm btn-primary btn-sm">
                                                                    <i
                                                                            class="fa fa-edit"></i>Düzenle
                                                                </button>
                                                            </a> </small>

                                                        <small>
                                                            <button
                                                                    data-url="calismalarim.php?sil=<?php echo $calisma['id'] ?>"
                                                                    class="btn btn-outline mw-sm btn-danger btn-sm sil-calisma">
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


