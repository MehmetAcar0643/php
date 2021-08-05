<?php
include "includes/header.php";
include "includes/navbarleft.php";

include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

?>

<?php if ($_POST) {
    $yazar = $_POST['yazar'];
    $kitapadi = $_POST['kitapadi'];
    $basimtar = $_POST['basimtar'];
    $basimtar = date("Y-m-d", strtotime($basimtar));
    $kategori = $_POST['kategori'];
    $yayinevi = $_POST['yayinevi'];
    $konum = $_POST['konum'];
    $aciklama = $_POST['aciklama'];
    $isbn = $_POST['isbn'];
    $act = 1;
    $author = $_SESSION['kutuphane']['username'];

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

    $kitap = array('yazar' => $yazar, 'kitapadi' => $kitapadi,
        'kategori' => $kategori, 'yayinevi' => $yayinevi, 'basimtar' => $basimtar,
        'konum' => $konum, 'aciklama' => $aciklama, 'isbn' => $isbn, 'author' => $author, 'resim' => $fotopath, 'act' => $act);
    $run->kitapSave($kitap);

}
?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Kitap Ekle</h1>
            </div>
        </div>
        <?php if (isset($_SESSION['message']) || isset($_SESSION['message2'])) {
            echo $_SESSION['message'] . " <br>";
            echo $_SESSION['message2'];
            unset($_SESSION['message2']);
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['kitapid'])) {
            $barkodid = $_SESSION['kitapid'];
            $image = base64_encode($generatorPNG->getBarcode($barkodid, $generatorPNG::TYPE_CODE_128));
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


            <div class="row" id="message">
                <button class="btn btn-sm btn-primary"
                        onclick="VoucherPrint('data:image/png;base64,<?php echo $image; ?>', '<?php echo $barkodid; ?>'); return false;">
                    Barkod al
                </button>
            </div>
            <hr>
            <?php unset($_SESSION['kitapid']);
        }
        ?>
        <div class="row">
            <div class="col-md-8 thumbnail" style="padding-top:20px;">
                <form class="form-horizontal" enctype="multipart/form-data" name="kitapform" id="kitapform" action=""
                      method="POST">
                    <div class="form-group">
                        <label for="yazar" class="col-md-2 control-label">Yazar adı:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="yazar" placeholder="Yazar adı giriniz">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kitapadi" class="col-md-2 control-label">Kitap adı:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="kitapadi" placeholder="Kitap adı giriniz">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="basimtar" class="col-md-2 control-label">Basım Tarihi:</label>
                        <div class="col-md-6 taryil">
                            <input type="text" class="form-control" name="basimtar"
                                   placeholder="Basım tarihini giriniz.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="col-md-2 control-label">Kategori:</label>
                        <div class="col-md-6">
                            <select class="form-control" id="kategori" name="kategori">
                                <option value="">Kategori seçiniz</option>
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
                            <input type="text" class="form-control" name="yayinevi" placeholder="Yayın evi giriniz">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="konum" class="col-md-2 control-label">Konum:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="konum" placeholder="Konum giriniz">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aciklama" class="col-md-2 control-label">Açıklama:</label>
                        <div class="col-md-6">
                            <textarea class="form-control" placeholder="Kitaba açıklama giriniz" rows="5"
                                      name="aciklama"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="isbn" class="col-md-2 control-label">ISBN:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="isbn" placeholder="ISBN no giriniz">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="resim" class="control-label col-md-2">Resim:</label>
                        <div class="col-md-6">
                            <input type="file" name="resim" id="resim" data-toggle="tooltip" data-placement="top"
                                   title="Yalnızca jpg dosya tiplerini yükleyebilirsiniz.">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <input type="submit" value="Ekle" class="btn btn-success btn-block">
                        </div>
                    </div>
                </form>
            </div>
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

</body>

</html>
