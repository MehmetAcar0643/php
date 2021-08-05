<? include "../ostatic/header.php";

$kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id=:id ");
$kullanicisor->execute(array(
    'id' => $_GET['kullanici_id']
));
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

?>


<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Kullanici Düzenleme <small>
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


                            <?php $zaman=explode(" ",$kullanicicek['kullanici_zaman'])?>
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
                                    Yekti
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="kullanici_yetki" id="heard" class="form-control" required>

                                        <option value="1" <?php echo $kullanicicek['kullanici_yetki'] == 1 ? 'selected=""' : ''; ?>>
                                            Kullanıcı(1)
                                        </option>

                                        <option value="2" <?php echo $kullanicicek['kullanici_yetki'] == 2 ? 'selected=""' : ''; ?>>
                                            Sınırlı Yetkide Yönetici(2)
                                        </option>

                                        <option value="5" <?php echo $kullanicicek['kullanici_yetki'] == 5 ? 'selected=""' : ''; ?>>
                                            Yönetici(5)
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı
                                    Durum
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="kullanici_durum" id="heard" class="form-control" required>

                                        <option value="1" <?php echo $kullanicicek['kullanici_durum'] == 1 ? 'selected=""' : ''; ?>>
                                            Aktif
                                        </option>

                                        <option value="0" <?php echo $kullanicicek['kullanici_durum'] == 0 ? 'selected=""' : ''; ?>>
                                            Pasif
                                        </option>
                                        <option value="8" <?php echo $kullanicicek['kullanici_durum'] == 8 ? 'selected=""' : ''; ?>>
                                            Yeni Kayıt
                                        </option>

                                    </select>
                                </div>
                            </div>


                            <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']?>">

                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="kullaniciayarkaydet" class="btn btn-success">Güncelle
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
