<? include "../ostatic/header.php";

$hakkimdasor = $db->prepare("SELECT * FROM hakkimda WHERE  hakkimda_id=:id");
$hakkimdasor->execute(array(
    'id' => 0
));
$hakkimdacek = $hakkimdasor->fetch(PDO::FETCH_ASSOC);



?>


<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Hakkımda Ayarlar <small>
                                <?php if ($_GET['durum'] == 'ok') { ?>
                                    <b style="color: blue">İşlem Başarılı...</b>
                                <?php }  else if ($_GET['durum'] == 'no'){ ?>
                                    <b style="color: red">İşlem Başarısız...</b>
                                <?php } ?>
                            </small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <form action="../connect/islem.php" method="POST" id="demo-form2" data-parsley-validate
                              class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlık
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="hakkimda_baslik"
                                           value="<?php echo  $hakkimdacek['hakkimda_baslik'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İçerik
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="hakkimda_icerik" id="editor1"
                                                  class="chkeditor"> <?php echo $hakkimdacek['hakkimda_icerik'] ?></textarea>
                                </div>
                            </div>


                            <script type="text/javascript">

                                CKEDITOR.replace('editor1',
                                    {
                                        filebrowserBrowserUrl: 'ckfinder/ckfinder.html',
                                        filebrowserImageBrowserUrl: 'ckfinder/ckfinder.html?type=Images',
                                        filebrowserFlashBrowserUrl: 'ckfinder/ckfinder.html?type=Flash',
                                        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                        forcePasteAsPlainText: true
                                    }
                                );

                            </script>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim
                                   
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="hakkimda_resim"
                                           value="<?php echo $hakkimdacek['hakkimda_resim'] ?>"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="hakkimda_video"
                                           value="<?php echo $hakkimdacek['hakkimda_video'] ?>"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vizyon Başlığı

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="hakkimda_vizyonbaslik"
                                           value="<?php echo $hakkimdacek['hakkimda_vizyonbaslik'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vizyon İçerik

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="hakkimda_vizyonicerik" id="editor2"
                                                  class="chkeditor"> <?php echo $hakkimdacek['hakkimda_vizyonicerik'] ?></textarea>
                                </div>
                            </div>


                            <script type="text/javascript">

                                CKEDITOR.replace('editor2',
                                    {
                                        filebrowserBrowserUrl: 'ckfinder/ckfinder.html',
                                        filebrowserImageBrowserUrl: 'ckfinder/ckfinder.html?type=Images',
                                        filebrowserFlashBrowserUrl: 'ckfinder/ckfinder.html?type=Flash',
                                        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                        forcePasteAsPlainText: true
                                    }
                                );

                            </script>
                            <hr>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Misyon Başlık
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="hakkimda_misyonbaslik"
                                           value="<?php echo $hakkimdacek['hakkimda_misyonbaslik'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Misyon İçerik
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="hakkimda_misyonicerik" id="editor3"
                                                  class="chkeditor"> <?php echo $hakkimdacek['hakkimda_misyonicerik'] ?></textarea>
                                </div>
                            </div>


                            <script type="text/javascript">

                                CKEDITOR.replace('editor3',
                                    {
                                        filebrowserBrowserUrl: 'ckfinder/ckfinder.html',
                                        filebrowserImageBrowserUrl: 'ckfinder/ckfinder.html?type=Images',
                                        filebrowserFlashBrowserUrl: 'ckfinder/ckfinder.html?type=Flash',
                                        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                        forcePasteAsPlainText: true
                                    }
                                );

                            </script>

                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="hakkimdaayarkaydet" class="btn btn-success">Güncelle
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<? include "../ostatic/footer.php" ?>
