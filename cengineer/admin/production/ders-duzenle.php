<? include "../ostatic/header.php";

$derssor = $db->prepare("SELECT * FROM ders where ders_id=:id ");
$derssor->execute(array(
    'id' => $_GET['ders_id']
));
$derscek = $derssor->fetch(PDO::FETCH_ASSOC);

?>


<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ders Düzenleme <small>
                                <?php if ($_GET['durum'] == 'ok') { ?>
                                    <b style="color: blue">İşlem Başarılı...</b>
                                <?php } else if ($_GET['durum'] == 'no') { ?>
                                    <b style="color: red">İşlem Başarısız...</b>
                                <?php } ?>
                            </small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <form action="../connect/islem.php" method="POST" id="demo-form2" data-parsley-validate
                              class="form-horizontal form-label-left">


                            <!-- kategori seçme başlangıç -->


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ders
                                    Kategori
                                    Seç<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-6">

                                    <?php

                                    $ders_id = $derscek['kategori_id'];

                                    $kategorisor = $db->prepare("select * from kategori where kategori_ust=:kategori_ust order by kategori_sira");
                                    $kategorisor->execute(array(
                                        'kategori_ust' => 0
                                    ));

                                    ?>
                                    <select class="select2_multiple form-control" required=""
                                            name="kategori_id">


                                        <?php

                                        while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {

                                            $kategori_id = $kategoricek['kategori_id'];

                                            ?>

                                            <option <?php if ($kategori_id == $ders_id) {
                                                echo "selected='select'";
                                            } ?> value="<?php echo $kategoricek['kategori_id']; ?>"><?php echo $kategoricek['kategori_ad']; ?></option>

                                        <?php } ?>

                                    </select>
                                </div>
                            </div>


                            <!-- kategori seçme bitiş -->



                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ders Ad
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ders_ad"
                                           value="<?php echo $derscek['ders_ad'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ders Detay
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="ders_detay" id="editor1"
                                                  class="chkeditor"> <?php echo $derscek['ders_detay'] ?></textarea>
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
                                    <input type="text" id="first-name" name="ders_resim"
                                           value="<?php echo $derscek['ders_resim'] ?>"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ders_video"
                                           value="<?php echo $derscek['ders_video'] ?>"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ders URL
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ders_url"
                                           value="<?php echo $derscek['ders_url'] ?>"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ders sıra
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ders_sira"
                                           value="<?php echo $derscek['ders_sira'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ders
                                    Durum
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="ders_durum" id="heard" class="form-control" required>

                                        <option value="1" <?php echo $derscek['ders_durum'] == 1 ? 'selected=""' : ''; ?>>
                                            Aktif
                                        </option>

                                        <option value="0" <?php echo $derscek['ders_durum'] == 0 ? 'selected=""' : ''; ?>>
                                            Pasif
                                        </option>

                                    </select>
                                </div>
                            </div>


                            <input type="hidden" name="ders_id" value="<?php echo $derscek['ders_id']?>">

                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="dersduzenle" class="btn btn-success">Güncelle
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
