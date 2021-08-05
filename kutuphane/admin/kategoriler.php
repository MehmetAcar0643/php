<?php
include "includes/header.php";
include "includes/navbarleft.php"; ?>

<?php

if (isset($_POST["kategoriekle"])) {
    $title = $_POST["kategoriekle"];
    if ($title != "") {
        $kategori = array(':kategoriad' => $title);
        $run->kategoriekle($kategori);
    } else {
        $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Boş bırakmayınız.</div></div>';
    }

}

if (isset($_POST["kategoriduzenle"])) {
    $id = $_POST["id"];
    $title = $_POST["kategoriduzenle"];
    if ($title != "") {
        $kategori = array(
            ':kategoriad' => $title,
            ':id' => $id
        );
        $run->kategoriUpdate($kategori);
    } else {
        $_SESSION['message'] = '<div class="row" id="message"><div class="col-md-12 alert alert-danger">Boş bırakmayınız.</div></div>';
    }
}

if (!isset($_POST["kategoriekle"]) && !isset($_POST["kategoriduzenle"]) && isset($_GET["durum"])) {
    $id = $_GET["id"];
    $durum = $_GET["durum"];
    $kategori = array(
        ':id' => $id,
        ':act' => $durum
    );
    $run->kategoriDurum($kategori);
}

if (!isset($_POST["kategoriekle"]) && !isset($_POST["kategoriduzenle"]) && isset($_GET["sil"])) {
    $id = $_GET["sil"];
    $kategori = array(
        ':id' => $id
    );
    $run->kategoriSil($kategori);
}

$kategoriler = $run->categories();
?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Kategoriler</h1>
            </div>
        </div>
        <?php $run->mesaj(); ?>
        <div class="row">
            <div class="thumbnail" style="padding-top:20px;">
                <form class="form-horizontal" enctype="multipart/form-data" name="catform" id="catform" action=""
                      method="POST">
                    <div class="form-group">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="kategoriekle"
                                   placeholder="Kategori adını giriniz.">
                        </div>
                        <div class="col-md-1">
                            <input type="submit" value="Ekle" class="btn btn-success btn-block">
                        </div>
                    </div>
                </form>
            </div>
            <div class="thumbnail">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th style="width:85%">Kategori Başlığı</th>
                        <th style="width:15%">Düzenle</th>
                    </tr>

                    <?php $categories = $run->categories();
                    foreach ($categories as $row) { ?>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <tr>
                                <td><input type="text" class="form-control" name="kategoriduzenle"
                                           value="<?php echo $row['kategori']; ?>"
                                           placeholder="Kategori adını giriniz."></td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip"
                                            data-placement="top" title="Düzenle"><span
                                                class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                                    </a>
                                    <?php
                                    if ($row['act'] == 1) {
                                        ?>
                                        <a href="?durum=0&id=<?php echo $row['id']; ?>">
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip"
                                                    data-placement="top" title="Pasif Yap"><span
                                                        class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </button>
                                        </a>
                                    <?php }
                                    if ($row['act'] != 1) {?>
                                        <a href="?durum=1&id=<?php echo $row['id']; ?>">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Aktif Yap"><span
                                                        class="glyphicon glyphicon-star-empty"
                                                        aria-hidden="true"></span></button>
                                        </a>
                                    <?php } ?>
                                    <a href="?sil=<?php echo $row['id']; ?>">
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                data-placement="top" title="Sil"><span
                                                    class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        </form>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#catform').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'Başlık Giriniz...'
                        }
                    }
                }
            }
        });
    });
</script>
</body>

</html>
