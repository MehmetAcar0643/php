<?php include "header.php";

require_once("../../connect/İletisimController.php");
$iletisimcont = new İletisimController();
$mesaj_sayi = $iletisimcont->mesajlar_sayisi_getir();


$sayfa = isset($_GET['sayfa']) && is_numeric($_GET['sayfa']) ? $_GET['sayfa'] : 1;
$limit = 8;
$toplamMesaj = $mesaj_sayi['toplam'];
$toplamSayfa = ceil($toplamMesaj / $limit);
$baslangic = ($sayfa * $limit) - $limit;
$sol = $sayfa - 3;
$sag = $sayfa + 3;
if ($sayfa <= 3) {
    $sag = 7;
}
if ($sag > $toplamSayfa) {
    $sol = $toplamSayfa - 6;
}
$mesajlar = $iletisimcont->mesajlar_getir($baslangic, $limit);

$message = "";
if ($_GET['sil']) {
    $id = $_GET['sil'];
    $flag = $iletisimcont->mesaj_sil($id);
    if ($flag) {
        header("Location:mailler.php");
        $message = "Mail Silindi";
    } else {
        $message = "Başarısız";
    }
}

if ($_GET['mail-gonder'] == "ok") {
    $message = "Mail Gönderme İşlemi Başarıyla Gerçekleştirildi...";
}

?>


<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="mail-toolbar m-b-lg">
                                <div class=" btn-group" role="group">
                                    <h4 class="m-b-lg"><i class=" menu-icon m-r-sm fa fa-envelope"></i>MAİLLER</h4>
                                </div>
                            </div>
                            <?php if ($message != '') { ?>
                                <div class="alert alert-success sonuc-cubuk" role="alert"><?php echo $message; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <?php if (empty($mesajlar)) { ?>
                            <div class="alert alert-danger alert-custom alert-dismissible text-center">
                                <h4 class="alert-title">KAYIT BULUNAMADI!</h4>
                                <p>Herhangi bir mail yok.</p>
                            </div>
                        <?php } else { ?>
                            <table class="table mail-list">
                                <tr>
                                    <td>
                                        <?php foreach ($mesajlar as $mesaj) { ?>
                                            <div class="mail-item">
                                                <table class="mail-container">
                                                    <tr>
                                                        <td class="mail-center">
                                                            <div class="mail-item-header">
                                                                <h4 class="mail-item-title">
                                                                    <a href="mail-oku.php?id=<?php echo $mesaj['id'] ?>"
                                                                       style="font-size: 25px" class="title-color">
                                                                        <strong><?php echo $mesaj['konu'] ?></strong>
                                                                    </a>
                                                                </h4>
                                                                <span class="">
                                                                Gönderen=<?php echo $mesaj['ad'] ?>(<?php echo $mesaj['mail'] ?>)
                                                            </span>
                                                            </div>
                                                            <?php $say = substr($mesaj['mesaj'], 0, 130);
                                                            $uzunluk = strlen($mesaj['mesaj']) ?>
                                                            <p class="mail-item-excerpt uzunluk">
                                                                <?php if ($uzunluk > 130) {
                                                                    echo $say;
                                                                    ?> ...<?php } else {
                                                                    echo $mesaj['mesaj'];
                                                                } ?>
                                                            </p>
                                                        </td>
                                                        <td class="mail-right">
                                                            <p class="mail-item-date"><?php echo timeConvert($mesaj['tarih']) ?>
                                                                göderildi</p>

                                                            <?php if ($mesaj['durum'] == 1) { ?>
                                                                <p style="font-size: 15px"
                                                                   class="label label-danger pull-right">
                                                                    Okunmadı</p>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div><!-- END mail-item -->
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>

                    </div>


                    <div class="btn-group sayfalama" role="group">
                        <a href="mailler.php?sayfa=<?php if($sayfa>1){ echo ($sayfa-1); } else{ echo 1; } ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Önceki</a>
                    </div>
                    <?php
                    for ($i = $sol; $i <= $sag; $i++) {
                        if ($i > 0 && $i <= $toplamSayfa) { ?>
                            <div class="btn-group sayfalama">
                                <a <?php if ($i == $sayfa) { ?>
                                    class="btn btn-default active"
                                <?php } else { ?>
                                    class="btn btn-default "
                                <?php } ?>
                                        href="mailler.php?sayfa=<?php echo $i ?>">
                                    <?php echo $i; ?>
                                </a>
                            </div>
                        <?php }
                    } ?>
                    <div class="btn-group sayfalama" role="group">
                        <a href="mailler.php?sayfa=<?php if($sayfa<$toplamSayfa){ echo ($sayfa+1); } else{ echo $toplamSayfa; } ?>"
                           class="btn btn-default">Sonraki <i class="fa fa-chevron-right"></i></a>
                    </div>

                    <?php } ?>
                </div><!-- END column -->
            </div><!-- .row -->
        </section><!-- .app-content -->
    </div><!-- .wrap -->

    <!-- new label Modal -->
    <div id="labelModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create / update label</h4>
                </div>
                <form action="#" id="newCategoryForm">
                    <div class="modal-body">
                        <div class="form-group m-0">
                            <input type="text" id="catLabel" class="form-control" placeholder="Label">
                        </div>
                    </div><!-- .modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                    </div><!-- .modal-footer -->
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- delete item Modal -->
    <div id="deleteItemModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete item</h4>
                </div>
                <div class="modal-body">
                    <h5>Do you really want to delete this item ?</h5>
                </div><!-- .modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div><!-- .modal-footer -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</main>


<?php include "footer.php" ?>
