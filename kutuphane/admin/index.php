<?php
include "includes/header.php";
include "includes/navbarleft.php";

if (@$_GET['aktif']) {
    $id = $_GET['aktif'];
    $run->kitapact($id, 1);
}
if (@$_GET['pasif']) {
    $id = $_GET['pasif'];
    $run->kitapact($id, 0);
}
?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row" style="padding-top: 20px">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <?php $run->mesaj(); ?>
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Son Eklenen Kitaplar</h3>
                    </div>
                    <div class="panel-body">
                        <?php $kitap = $run->kitaplar(@$sayfa, 7); ?>
                        <table class="table table-responsive table-stripped table-bordered">
                            <tr>
                                <th>Resim</th>
                                <th>ID</th>
                                <th>Kitap adı</th>
                                <th>Yazar</th>
                                <th>ISBN</th>
                                <th>Düzenle</th>
                            </tr>
                            <?php
                            while ($row = $kitap->fetch()) { ?>
                                <tr>
                                    <td>
                                        <?php if ($row['resim'] == "") { ?><img class="img-responsive" width="80"
                                                                                src="../kapak/kitap.jpg"><?php } else { ?>
                                            <img class="img-responsive" width="80"
                                                 src="<?php echo $row['resim']; ?>"><?php } ?>

                                    </td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['kitapadi']; ?></td>
                                    <td><?php echo $row['yazar']; ?></td>
                                    <td><?php echo $row['isbn']; ?></td>
                                    <td>
                                        <a href="kitapduzenle.php?duzenle=<?php echo $row['id']; ?>">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                    data-placement="top" title="Düzenle"><i
                                                        class="fa fa-pencil-square-o"></i></button>
                                        </a>
                                        <?php if ($row['act'] == 1) {
                                            ?>
                                            <a href="index.php?pasif=<?php echo $row['id']; ?>">
                                                <button type="button" class="btn btn-sm btn-success"
                                                        data-toggle="tooltip" data-placement="top" title="Pasif Yap"><i
                                                            class="fa fa-check"></i></button>
                                            </a>
                                        <?php } elseif ($row['act'] == 0) { ?>
                                            <a href="index.php?aktif=<?php echo $row['id']; ?>">
                                                <button type="button" class="btn btn-sm btn-danger"
                                                        data-toggle="tooltip" data-placement="top" title="Aktif Yap"><i
                                                            class="fa fa-ban"></i></button>
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                        <div class="text-right">
                            <a href="kitapduzenle.php">Tüm Kitaplar <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
<!-- /#wrapper -->

<?php include "includes/footer.php"; ?>
</body>
</html>


