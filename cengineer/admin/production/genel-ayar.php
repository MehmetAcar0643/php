<? include "../ostatic/header.php" ?>


<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Genel Ayarlar <small>
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

                        <form action="../connect/islem.php" method="POST" enctype="multipart/form-data"
                              data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Logo<br><span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <?php
                                    if (strlen($ayarcek['ayar_logo']) > 0) { ?>

                                        <img width="200" src="../../<?php echo $ayarcek['ayar_logo']; ?>">

                                    <?php } else { ?>


                                        <img width="200" src="../../aaimgimages/logo-yok.png">


                                    <?php } ?>


                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim
                                    Seç<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" id="first-name" name="ayar_logo"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <input type="hidden" name="eski_yol" value="<?php echo $ayarcek['ayar_logo']; ?>">

                            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" name="logoduzenle" class="btn btn-primary">Güncelle</button>
                            </div>

                        </form>

                        <hr>


                        <form action="../connect/islem.php" method="POST" id="demo-form2" data-parsley-validate
                              class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Adı
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ayar_title"
                                           value="<?php echo $ayarcek['ayar_title'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Logo İsmi
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ayar_sitelogoisim"
                                           value="<?php echo $ayarcek['ayar_sitelogoisim'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site
                                    Açıklaması
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ayar_description"
                                           value="<?php echo $ayarcek['ayar_description'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Anahtar
                                    Kelime
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ayar_keyword"
                                           value="<?php echo $ayarcek['ayar_keyword'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Yazar
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ayar_author"
                                           value="<?php echo $ayarcek['ayar_author'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="genelayarkaydet" class="btn btn-success">Güncelle
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
