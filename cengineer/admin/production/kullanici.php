<? include "../ostatic/header.php";

$kullanicisor = $db->prepare("SELECT * FROM kullanici ");
$kullanicisor->execute();


?>


<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Kullanıcı Listeleme <small>
                                <?php if ($_GET['durum'] == 'ok') { ?>
                                    <b style="color: blue">İşlem Başarılı...</b>
                                <?php } else if ($_GET['durum'] == 'no') { ?>
                                    <b style="color: red">İşlem Başarısız...</b>
                                <?php } ?>
                            </small></h2>
                        <div align="right">
                            <button class="btn btn-success btn-sm">Yeni Ekle</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <table id="datatable-keytable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Kayıt Tarihi</th>
                                <th>Ad Soyad</th>
                                <th>Mail Adresi</th>
                                <th>Telefon</th>
                                <th>Yetki</th>
                                <th>Durum</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>


                            <tbody>

                            <?php while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td width="100"><?php echo $kullanicicek['kullanici_zaman'] ?></td>
                                    <td><?php echo $kullanicicek['kullanici_adsoyad'] ?></td>
                                    <td><?php echo $kullanicicek['kullanici_mail'] ?></td>
                                    <td width="100"><?php echo $kullanicicek['kullanici_gsm'] ?></td>
                                    <td width="100">
                                        <?php if ($kullanicicek['kullanici_yetki'] == 5) { ?>
                                            <center>
                                                <button class="btn btn-warning btn-sm">Yönetici</button>
                                            </center>
                                        <?php } elseif ($kullanicicek['kullanici_yetki'] == 1) { ?>
                                            <center>
                                                <button class="btn btn-info btn-sm">Kullanıcı</button>
                                            </center>
                                        <?php } elseif ($kullanicicek['kullanici_yetki'] == 2) { ?>
                                            <center>
                                                <button class="btn btn-secondary btn-sm">Sınırlı Yetkide Yönetici
                                                </button>
                                            </center>
                                        <?php } ?>
                                    </td>
                                    <td width="100">
                                        <?php if ($kullanicicek['kullanici_durum'] == 1) { ?>
                                            <center>
                                                <button class="btn btn-success btn-sm">Aktif</button>
                                            </center>
                                        <?php } elseif($kullanicicek['kullanici_durum'] == 8) { ?>
                                            <center>
                                                <button class="btn btn-dark btn-sm">Yeni Kayıt</button>
                                            </center>
                                        <?php } else{?>
                                            <center>
                                                <button class="btn btn-danger btn-sm">Pasif</button>
                                            </center>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="kullanici-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>">
                                                <button class="btn btn-primary btn-sm">Düzenle</button>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="../connect/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>& kullanicisil=ok">
                                                <button class="btn btn-danger btn-xs">Sil</button>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<? include "../ostatic/footer.php" ?>
