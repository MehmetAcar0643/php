<?php include "header.php";


if ($_GET['id']) {
    $id = $_GET['id'];
}


require_once("../../connect/ProjelerimController.php");
$projelercont = new ProjelerimController();
$proje_resimleri = $projelercont->proje_resim_getir($id);
$proje_baslik = $projelercont->proje_baslik_getir($id);

if ($_GET['sil']) {
    $asd = $_GET['sil'];
    $flag = $projelercont->proje_resim_klasörden_sil($asd);
    $proje_id = $flag['proje_id'];
    unlink($flag['resim']);
    $flag2 = $projelercont->proje_resim_sil($asd);
    $proje_resimleri = $projelercont->proje_resim_getir($proje_id);
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
                                    Proje Resimleri
                                    <a href="proje-resim-ekle.php?id=<?php echo $_GET['id']; ?>"
                                       class="btn btn-outline btn-purple btn-xs pull-right">
                                        <i class="fa fa-plus"></i>
                                        Yeni Resimler Ekle
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <hr class="widget-separator">
                        <?php if ($message != '') { ?>
                            <div class="alert alert-success sonuc-cubuk" role="alert"><?php echo $message; ?></div>
                        <?php } ?>
                        <div class="card-body">
                            <?php if (empty($proje_resimleri)) { ?>
                                <div class="alert alert-danger alert-custom alert-dismissible text-center">
                                    <h4 class="alert-title">KAYIT BULUNAMADI!</h4>
                                    <p>Herhangi bir resim bulunamadı.
                                    </p>
                                </div>
                            <?php } else { ?>
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                       cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th width="10%">
                                            <center>resim</center>
                                        </th>
                                        <th width="30%">
                                            <center>Resim Adı</center>
                                        </th>
                                        <th width="5%">
                                            <center>Durum</center>
                                        </th>
                                        <th width="20%">
                                            <center>İşlem</center>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-proje-resimler">
                                    <?php $say = 0;
                                    foreach ($proje_resimleri as $proje) {
                                        $say++; ?>
                                        <tr id="id_<?php echo $proje['id'] ?>">
                                            <td>
                                                <center><img width="30%" src="<?php echo $proje['resim'] ?>" alt="">
                                                </center>
                                            </td>
                                            <td> <?php echo substr($proje['resim'], 15) ?></td>
                                            <td><?php if ($proje['durum'] == 1) { ?>
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
                                                <center><small><a href="proje-resim-duzenle.php?duzenle=<?php echo $proje['id'] ?>">
                                                            <button class="btn btn-outline mw-sm btn-primary btn-sm ">
                                                                <i class="fa fa-edit"></i>Düzenle
                                                            </button>
                                                        </a>
                                                    </small>

                                                    <small>
                                                        <button data-url="proje-resimler.php?sil=<?php echo $proje['id'] ?>"
                                                                class="btn btn-outline mw-sm btn-danger btn-sm sil-resim">
                                                            <i class="menu-icon fa fa-trash"></i>Sil
                                                        </button>
                                                    </small></center>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php }?>
                        </div>
                    </div><!-- .widget -->
                </div><!-- END column -->

            </div>
        </section>
    </div>
</main>


<?php include "footer.php" ?>

