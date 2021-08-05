<? include "../ostatic/header.php";

$derssor = $db->prepare("SELECT * FROM ders order by kategori_id ASC ");
$derssor->execute();


?>


<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ders Listeleme <small>
                                <?php if ($_GET['durum'] == 'ok') { ?>
                                    <b style="color: blue">İşlem Başarılı...</b>
                                <?php } else if ($_GET['durum'] == 'no') { ?>
                                    <b style="color: red">İşlem Başarısız...</b>
                                <?php } ?>
                            </small></h2>
                        <div align="right">
                            <a href="ders-ekle.php"><button class="btn btn-success btn-sm">Yeni Ekle</button></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <table id="datatable-keytable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Ders İçerik Ad</th>
                                <th>Ders Kategori Adı</th>
                                <th>Ders İçerik Sıra</th>
                                <th>Ders İçerik Durum</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>


                            <tbody>

                            <?php
                            $say=0;
                            while ($derscek = $derssor->fetch(PDO::FETCH_ASSOC)) { $say++ ?>
                                <tr>
                                    <td width="20"><?php echo $say ?></td>
                                    <td ><?php echo $derscek['ders_ad'] ?></td>
                                    <td><?php echo $derscek['kategori_id'] ?></td>
                                    <td width="150" align="center"><?php echo $derscek['ders_sira'] ?></td>
                                    <td width="150">
                                        <?php if ($derscek['ders_durum'] == 1) { ?>
                                            <center>
                                                <button class="btn btn-success btn-sm">Aktif</button>
                                            </center>
                                        <?php } else { ?>
                                            <center>
                                                <button class="btn btn-danger btn-sm">Pasif</button>
                                            </center>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="ders-duzenle.php?ders_id=<?php echo $derscek['ders_id'] ?>">
                                                <button class="btn btn-primary btn-sm">Düzenle</button>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="../connect/islem.php?ders_id=<?php echo $derscek['ders_id'] ?>& derssil=ok">
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
