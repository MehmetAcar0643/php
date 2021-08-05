<? include "../ostatic/header.php";

$kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_sira ASC ");
$kategorisor->execute();


?>


<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Kategori Listeleme <small>
                                <?php if ($_GET['durum'] == 'ok') { ?>
                                    <b style="color: blue">İşlem Başarılı...</b>
                                <?php } else if ($_GET['durum'] == 'no') { ?>
                                    <b style="color: red">İşlem Başarısız...</b>
                                <?php } ?>
                            </small></h2>
                        <div align="right">
                            <a href="kategori-ekle.php"><button class="btn btn-success btn-sm">Yeni Ekle</button></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <table id="datatable-keytable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th> <center>S.No </center></th>
                                <th>Kategori Ad</th>
                                <th> <center>kategori Sıra </center></th>
                                <th>kategori Durum</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>


                            <tbody>

                            <?php
                            $say=0;
                            while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { $say++ ?>
                                <tr>
                                     <td width="150"><center><?php echo $say ?> </center></td>
                                    <td width="250"><?php echo $kategoricek['kategori_ad'] ?></td>
                                    <td width="150"> <center><?php echo $kategoricek['kategori_sira'] ?> </center></td>
                                    <td width="150">
                                        <?php if ($kategoricek['kategori_durum'] == 1) { ?>
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
                                            <a href="kategori-duzenle.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>">
                                                <button class="btn btn-primary btn-sm">Düzenle</button>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="../connect/islem.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>& kategorisil=ok">
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
