<? include "../ostatic/header.php";


?>


<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Profil Bilgilerim<small>
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


                            <?php $zaman = explode(" ", $kullanicicek['kullanici_zaman']) ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı
                                    Kayıt Tarihi
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" id="first-name" name="kullanici_zaman"
                                           value="<?php echo $zaman[0]; ?>" required="required"
                                           class="form-control col-md-7 col-xs-12" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı
                                    Kayıt Saati
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="time" id="first-name" name="kullanici_zaman"
                                           value="<?php echo $zaman[1]; ?>" required="required"
                                           class="form-control col-md-7 col-xs-12" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Ad
                                    Soyad
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="kullanici_adsoyad"
                                           value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Mail
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="kullanici_mail"
                                           value="<?php echo $kullanicicek['kullanici_mail'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı
                                    Telefon
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="kullanici_gsm"
                                           value="<?php echo $kullanicicek['kullanici_gsm'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı İl
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="kullanici_il"
                                           value="<?php echo $kullanicicek['kullanici_il'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı İlçe
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="kullanici_ilce"
                                           value="<?php echo $kullanicicek['kullanici_ilce'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı
                                    Adres
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="kullanici_adres"
                                           value="<?php echo $kullanicicek['kullanici_adres'] ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>


                            <input type="hidden" name="kullanici_id"
                                   value="<?php echo $kullanicicek['kullanici_id'] ?>">

                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="adminbilgiguncelle" class="btn btn-success">Bilgilerimi
                                        Güncelle
                                    </button>
                                </div>
                            </div>

                        </form>
                        <br>
                        <hr>
                        <br>
                        <!--//////////////////////////////ŞİFRE İŞLEMLERİ////////////////////////////////////////////-->
                        <div class="x_title">
                            <h2>Şifre Düzenleme </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div>
                            <small>
                                <?php

                                if ($_GET['durum'] == "eskisifrehata") { ?>

                                    <div class="alert alert-danger">
                                        <strong>Hata!</strong> Şuan kullandığınız şifreyi yanlış girdiniz. Lütfen tekrar deneyin.
                                    </div>

                                <?php } elseif ($_GET['durum'] == "no") {
                                    ?>

                                    <div class="alert alert-success">
                                        <strong>Hata!</strong> Lütfen Daha Sonra Tekrar Deneyiniz!!
                                    </div>

                                <?php } elseif ($_GET['durum'] == "eksiksifre") {
                                    ?>

                                    <div class="alert alert-danger">
                                        <strong>Hata!</strong> Şifre uzunluğu minımum 6 karakterten oluşmalıdır!!
                                    </div>

                                <?php } elseif ($_GET['durum'] == "sifreleruyusmuyor") {
                                    ?>

                                    <div class="alert alert-danger">
                                        <strong>Hata!</strong> Girdiğiniz Yeni Şifreler Uyuşmuyor.
                                    </div>

                                <?php } elseif ($_GET['durum']=='eskisifreayni'){ ?>
                                    <div class="alert alert-danger">
                                        <strong>Hata!</strong> Eski şifre ile yeni şifre aynı olamaz.
                                    </div>
                                <?php }?>
                            </small>
                        </div>
                        <br>
                        <form action="../connect/islem.php" method="POST" id="demo-form2" data-parsley-validate
                              class="form-horizontal form-label-left">


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Güncel Şifre
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="first-name" name="kullanici_eskipassword"
                                           required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yeni Şifre
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="first-name" name="kullanici_passwordone"
                                           required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yeni Şifre
                                    (Tekrar)
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="first-name" name="kullanici_passwordtwo"
                                           required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <input type="hidden" name="kullanici_id"
                                   value="<?php echo $kullanicicek['kullanici_id'] ?>">

                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="adminsifreguncelle" class="btn btn-success">Şifremi
                                        Güncelle
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
