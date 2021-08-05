<?php
include "includes/header.php";
include "includes/navbarleft.php";

include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();


if (@$_GET['aktif']) {
    $id = htmlspecialchars($_GET['aktif']);
    $run->kitapact($id, 1);
}
if (@$_GET['pasif']) {
    $id = htmlspecialchars($_GET['pasif']);
    $run->kitapact($id, 0);
}
if ($_POST) {
    $id = htmlspecialchars($_POST['id']);
    $yazar = $_POST['yazar'];
    $kitapadi = $_POST['kitapadi'];
    $basimtar = $_POST['basimtar'];
    $basimtar = date("Y-m-d", strtotime($basimtar));
    $kategori = $_POST['kategori'];
    $yayinevi = $_POST['yayinevi'];
    $fotopath = $_POST['resimeski'];
    $konum = $_POST['konum'];
    $aciklama = $_POST['aciklama'];
    $isbn = $_POST['isbn'];
    $author = $_SESSION['kutuphane']['username'];
    if ($_POST['act']) $act = 1;
    else $act = 0;
    if (@$_FILES["resim"]["size"] > 10000) {
        $target_dir = '../kapak/';
        $target_file = $target_dir . basename($_FILES["resim"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["resim"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $_SESSION['message2'] = "DOsya resim değil.";
            $uploadOk = 0;
        }
        if ($_FILES["resim"]["size"] > 5000000) {
            $_SESSION['message2'] = "Dosya 5MB büyük";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $_SESSION['message2'] = "Yalnızca JPG, JPEG, PNG & GIF dosya tiplerini destekler.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $_SESSION['message2'] = "Dosya Yükleme Başarısız.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["resim"]["tmp_name"], $target_file)) {
                $fotopath = $target_dir . $_FILES["resim"]["name"];
            } else {
                $_SESSION['message2'] = "Dosya Yükleme Başarısız.";
            }
        }
    }
    $kitap = array(
        'id' => $id,
        'yazar' => $yazar,
        'kitapadi' => $kitapadi,
        'basimtar' => $basimtar,
        'kategori' => $kategori,
        'yayinevi' => $yayinevi,
        'konum' => $konum,
        'aciklama' => $aciklama,
        'isbn' => $isbn,
        'author' => $author,
        'resim' => $fotopath,
        'act' => $act
    );
    $run->kitapUpdate($kitap);
} else {
    $sayfa = @$_GET['sayfa'];
    $kacadet = 15;
    $kitap = $run->kitaplar($sayfa, $kacadet);
    $sonucSayisi = $run->kitapsayisi();
}
?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tüm Kitaplar</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row thumbnail">
            <?php
            $run->mesaj();
            if (@$_GET['duzenle']) //KİTAP DÜZENLEME
            {
                $id = $_GET['duzenle'];
                ?>
                <p><a href="index.php">Geri</a></p>
                <div class="col-md-8 thumbnail" style="padding-top:20px;">
                    <form class="form-horizontal" enctype="multipart/form-data" name="kitapform" id="kitapform"
                          action="" method="POST">
                        <div class="form-group">
                            <label for="yazar" class="col-md-2 control-label">Yazar adı:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="yazar"
                                       value="<?php echo $run->kitapget($id)->yazar; ?>"
                                       placeholder="Yazar adı giriniz">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kitapadi" class="col-md-2 control-label">Kitap adı:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="kitapadi"
                                       value="<?php echo $run->kitapget($id)->kitapadi; ?>"
                                       placeholder="Kitap adı giriniz">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="basimtar" class="col-md-2 control-label">Basım Tarihi:</label>
                            <div class="col-md-6 taryil">
                                <input type="text" class="form-control" name="basimtar"
                                       value="<?php echo date("d-m-Y", strtotime($run->kitapget($id)->basimtar)); ?>"
                                       placeholder="Basım tarihini giriniz.">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kategori" class="col-md-2 control-label">Kategori:</label>
                            <div class="col-md-6">
                                <select class="form-control" id="kategori" name="kategori">
                                    <?php $cat = $run->kitapget($id)->kategori; ?>
                                    <option value="<?php echo $cat; ?>"><?php echo $run->kategoriad($cat); ?></option>
                                    <?php $categories = $run->categories();
                                    foreach ($categories as $row) {
                                        if ($row['act'] == 1) {
                                            ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['kategori']; ?></option>
                                        <?php } else {
                                            ?>
                                            <option value="<?php echo $row['id']; ?>"
                                                    disabled><?php echo $row['kategori']; ?></option><?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="yayinevi" class="col-md-2 control-label">Yayın evi:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="yayinevi"
                                       value="<?php echo $run->kitapget($id)->yayinevi; ?>"
                                       placeholder="Yayın evi giriniz">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="konum" class="col-md-2 control-label">Konum:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="konum"
                                       value="<?php echo $run->kitapget($id)->konum; ?>" placeholder="Konum giriniz">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="aciklama" class="col-md-2 control-label">Açıklama:</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="aciklama" placeholder="Kitaba açıklama giriniz"
                                          rows="5"><?php echo $run->kitapget($id)->aciklama; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="isbn" class="col-md-2 control-label">ISBN:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="isbn"
                                       value="<?php echo $run->kitapget($id)->isbn; ?>" placeholder="ISBN no giriniz">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="resim" class="control-label col-md-2">Resim:</label>
                            <div class="col-md-6">
                                <input type="file" name="resim" id="resim" data-toggle="tooltip" data-placement="top"
                                       title="Yalnızca jpg dosya tiplerini yükleyebilirsiniz.">
                            </div>
                            <input type="hidden" name="resimeski" value="<?php echo $run->kitapget($id)->resim; ?>">
                            <input type="hidden" name="id" value="<?php echo $run->kitapget($id)->id; ?>">
                        </div>
                        <div class="form-group">
                            <label for="aktif" class="col-md-2 control-label">Aktif/Pasif:</label>
                            <div class="col-md-6">
                                <?php if ($run->kitapget($id)->act == 1) {
                                    $checked = "checked";
                                } else {
                                    $checked = "";
                                } ?>
                                <input type="checkbox" name="act" <?php echo $checked; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <input type="submit" value="Düzenle" class="btn btn-success btn-block">
                            </div>
                        </div>
                    </form>
                </div>
            <?php } //KİTAP DÜZENLEME
            else{
            ?>
                <script language="javascript" type="text/javascript">
                    function VoucherSourcetoPrint(source, id) {
                        return "<html><head><script>function step1(){\n" +
                            "setTimeout('step2()', 10);}\n" +
                            "function step2(){window.print();window.close()}\n" +
                            "</scri" + "pt></head><body onload='step1()'>\n" +
                            "<div style=\"width:90mm;\">\n" +
                            "<div style=\"width:40mm;float:left;margin-left:3mm\">\n" +
                            "<img style=\"width:40mm;height:25mm;float:left;\" src='" + source + "' />\n" +
                            "<center><p>" + id + "</p></center>\n" +
                            "</div>\n" +
                            "<div style=\"width:40mm;float:left;margin-left:4mm\">\n" +
                            "<img style=\"width:40mm;height:25mm;float:left;\" src='" + source + "' />\n" +
                            "<center><p>" + id + "</p></center>\n" +
                            "</div>\n" +
                            "</div>\n" +
                            "</body></html>";
                    }

                    function VoucherPrint(source, id) {
                        Pagelink = "about:blank";
                        var pwa = window.open(Pagelink, "_new");
                        pwa.document.open();
                        pwa.document.write(VoucherSourcetoPrint(source, id));
                        pwa.document.close();
                    }
                </script>
                <table class="table table-responsive table-striped table-bordered">
                    <tr>
                        <th>Resim</th>
                        <th>ID</th>
                        <th>Kitap adı</th>
                        <th>Yazar</th>
                        <th>Basım tarihi</th>
                        <th>ISBN</th>
                        <th>Düzenle</th>
                    </tr>
                    <?php
                    while ($row = $kitap->fetch()) {
                        $basimtar = explode("-", $row["basimtar"]);
                        $basimtar = $basimtar[0];
                        $barkodid = $row['id'];
                        $image = base64_encode($generatorPNG->getBarcode($barkodid, $generatorPNG::TYPE_CODE_128));
                        ?>
                        <tr>
                            <td>
                                <?php if ($row['resim'] == "") { ?><img class="img-responsive" width="80"
                                                                        src="../kapak/kitap.jpg"><?php } else { ?><img
                                    class="img-responsive" width="80" src="<?php echo $row['resim']; ?>"><?php } ?>

                            </td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['kitapadi']; ?></td>
                            <td><?php echo $row['yazar']; ?></td>
                            <td><?php echo $basimtar; ?></td>
                            <td><?php echo $row['isbn']; ?></td>
                            <td>
                                <a href="kitapduzenle.php?duzenle=<?php echo $row['id']; ?>">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip"
                                            data-placement="top" title="Düzenle"><i class="fa fa-pencil-square-o"></i>
                                    </button>
                                </a>
                                <?php if ($row['act'] == 1) {
                                    ?>
                                    <a href="kitapduzenle.php?pasif=<?php echo $row['id']; ?>">
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip"
                                                data-placement="top" title="Pasif yap"><i class="fa fa-check"></i>
                                        </button>
                                    </a>
                                <?php } elseif ($row['act'] == 0) { ?>
                                    <a href="kitapduzenle.php?aktif=<?php echo $row['id']; ?>">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                data-placement="top" title="Aktif yap"><i class="fa fa-ban"></i>
                                        </button>
                                    </a>
                                <?php } ?>
                                <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                                        title="Barkod al"
                                        onclick="VoucherPrint('data:image/png;base64,<?php echo $image; ?>', '<?php echo $barkodid; ?>');">
                                    <i class="fa fa-barcode"></i></button>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </table>
                <?php $run->pagination($sayfa, $sonucSayisi, $kacadet); ?>
            <?php } ?>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#kitapform').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                kitapadi: {
                    validators: {
                        notEmpty: {
                            message: 'Kitabın adını giriniz...'
                        }
                    }
                },
                kategori: {
                    validators: {
                        notEmpty: {
                            message: 'Kategori seçiniz...'
                        }
                    }
                },
                yazar: {
                    validators: {
                        notEmpty: {
                            message: 'Yazarı giriniz...'
                        }
                    }
                },
                yayinevi: {
                    validators: {
                        notEmpty: {
                            message: 'Yayınevi giriniz...'
                        }
                    }
                },
                isbn: {
                    validators: {
                        notEmpty: {
                            message: 'ISBN no Giriniz...'
                        }
                    }
                },
                resim: {
                    validators: {
                        file: {
                            extension: 'jpeg,jpg,png',
                            type: 'image/jpeg,image/png',
                            maxSize: 2048000,
                            message: 'Max dosya boyutu 2MB olan *.jpeg,*.jpg veya *.png uzantılı dosya yükleyiniz'
                        }
                    }
                }
            }
        });

    });
</script>
