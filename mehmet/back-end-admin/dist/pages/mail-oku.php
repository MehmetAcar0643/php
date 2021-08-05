<?php include "header.php";

require_once("../../connect/İletisimController.php");
$iletisimcont = new İletisimController();
if ($_GET['id']) {
    $id = $_GET['id'];
    $mesaj_durum = $iletisimcont->mesaj_durum_guncelle($id);

}

$mesaj_icerik = $iletisimcont->mesajlar_secilen_getir($id);

?>

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">
                <div class="col-md-12">
                    <!-- toolbar -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mail-toolbar m-b-md">
                                <div class="btn-group pull-right" role="group">
                                    <button class="btn btn-default mail-don">
                                        <strong><?php echo $mesaj_icerik['konu']?></strong> konulu maile geri dön
                                    </button>
                                    <button class="btn btn-default cevapla">
                                        <i class="menu-icon fa fa-mail-reply-all"></i>
                                        Cevapla
                                    </button>
                                    <button
                                            data-url="mailler.php?sil=<?php echo $mesaj_icerik['id'] ?>"
                                            class="btn btn-default  sil-mail">
                                        <i class="menu-icon fa fa-trash"></i>Sil
                                    </button>
                                    <a href="mailler.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Maillere Geri
                                        Dön</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- END toolbar -->

                    <div class="mail-view kapat-mail">

                        <div class="media">
                            <div class="media-body">
                                <div class="m-b-sm">
                                    <h4 class="m-0 inline-block m-r-lg">
                                        <strong><?php echo $mesaj_icerik['konu'] ?></strong>
                                    </h4>
                                </div>
                                <p><b>Kimden: </b><?php echo $mesaj_icerik['ad'] ?>
                                    <br><?php echo $mesaj_icerik['mail'] ?></p>
                            </div>
                        </div>
                        <div class="divid"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-h-lg lh-xl">
                                    <p><?php echo $mesaj_icerik['mesaj']?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 50px;" class="row cevapla-menu">
                        <div class="col-md-12">
                            <form action="mail-gonder.php" method="POST">
                                <div class="panel panel-default new-message">
                                    <h4 style="padding: 15px 15px" class="m-0 inline-block m-r-lg">
                                        <a href="#" class="title-color"><strong>CEVAPLA</strong></a>
                                    </h4>
                                    <hr class="widget-separator">
                                    <div class="row">
                                        <div style="margin: 10px" class="form-group col-md-5">
                                            <label class="mt-2">Konu</label>
                                            <input type="text" name="konu" value="<?php echo $mesaj_icerik['konu'] ?>"
                                                   class="form-control">
                                        </div>
                                        <div style="margin: 10px" class="form-group col-md-5 ">
                                            <label class="mt-2">Gönderilecek mail</label>
                                            <input type="text" name="mail" value="<?php echo $mesaj_icerik['mail'] ?>"
                                                   class="form-control">
                                        </div>

                                    </div>
                                    <div style="margin: 10px" class="form-group">
                                        <textarea name="mesaj" id="editor"
                                                  class="form-control">Mesajızını Yazınız...</textarea>
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
                                    <div class="panel-footer pull-right">
                                        <button type="submit" class="btn btn-primary" name="cevapla">Cevapla</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
<!--========== END app main -->


<?php include "footer.php"; ?>
