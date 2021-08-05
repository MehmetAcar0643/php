<?php
include "includes/header.php";
include "includes/navbarleft.php"; ?>

<?php if ($_POST) {
    $kitapid = $_POST['kitapid'];
    $flag = $run->kitapmusait($kitapid);
    if ($flag == "true") {
        $kimde = $_POST['kimde'];
        $tc = $_POST['tc'];
        $unvan = $_POST['unvan'];
        $verilistar = date("Y-m-d", strtotime($_POST['verilistar']));
        $gelecektar = date("Y-m-d", strtotime($_POST['gelecektar']));
        $iletisim = $_POST['iletisim'];
        $veren = $_SESSION['kutuphane']['username'];
        $kitap = array('kitapid' => $kitapid, 'kimde' => $kimde, 'tc' => $tc,
            'unvan' => $unvan, 'verilistar' => $verilistar, 'gelecektar' => $gelecektar,
            'iletisim' => $iletisim, 'veren' => $veren);
        $run->kitapver($kitap);
    }
}
?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Kitap Ver</h1>
            </div>
        </div>
        <?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['islemid'])) {
            $url = "kitapvertutanak.php?islemid=" . $_SESSION['islemid']; ?>
            <div id="message">
                <button class="btn btn-sm btn-primary"
                        onclick="window.open('<?php echo $url; ?>','popup2','width=500,height=600,top=0,left=20,scrollbars=yes');">
                    Tutanak al
                </button>
            </div>
            <hr>
            <?php unset($_SESSION['islemid']);
        }
        ?>
        <div class="row">
            <div class="col-md-8 thumbnail" style="padding-top:20px;">
                <form class="form-horizontal" enctype="multipart/form-data" name="kitapform" id="kitapform" action=""
                      method="POST">
                    <div class="form-group">
                        <label for="kitapid" class="col-md-2 control-label">Kitap id:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="kitapid" name="kitapid"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kimde" class="col-md-2 control-label">Kime veriliyor:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="kimde" name="kimde"
                                   placeholder="Verilen kişinin adının giriniz">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tc" class="col-md-2 control-label">Tc:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="tc" name="tc"
                                   placeholder="Verilen kişinin TCsini giriniz">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unvan" class="col-md-2 control-label">Ünvan:</label>
                        <div class="col-md-6">
                            <select class="form-control" id="unvan" name="unvan">
                                <option value="">Ünvan Seçiniz</option>
                                <option value="Öğretim Görevlisi">Öğretim Görevlisi</option>
                                <option value="Öğrenci">Öğrenci</option>
                                <option value="Mezun">Mezun</option>
                                <option value="Ziyaretçi">Ziyaretçi</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verilistar" class="col-md-2 control-label">Verilen Tarih:</label>
                        <div class="col-md-6 tar">
                            <input type="text" class="form-control" id="verilistar" name="verilistar"
                                   placeholder="Veriliş tarihini giriniz.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gelecektar" class="col-md-2 control-label">Gelecek Tarih:</label>
                        <div class="col-md-6 tar">
                            <input type="text" class="form-control" id="gelecektar" name="gelecektar"
                                   placeholder="Alınacak tarihi giriniz.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="iletisim" class="col-md-2 control-label">İletişim:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="iletisim" name="iletisim"
                                   placeholder="Telefon no giriniz.">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="button" onclick="myFunction()" value="Ekle" class="btn btn-success btn-block">
                                Teslim et
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
<script>
    function myFunction() {
        var x = document.getElementById("verilistar").value;
        var y = document.getElementById("gelecektar").value;
        var kitapid = document.getElementById("kitapid").value;
        var tc = document.getElementById("tc").value;
        var iletisim = document.getElementById("iletisim").value;
        dateFirst = x.split('-');
        dateSecond = y.split('-');
        var value = new Date(dateFirst[2], dateFirst[1], dateFirst[0]);
        var current = new Date(dateSecond[2], dateSecond[1], dateSecond[0]);

        if (kitapid == "") {
            alert("Kitap barkodu okutunuz...");
        } else {
            if (x == "" || y == "") {
                alert("Tarihleri seçiniz...");

            } else {
                if (iletisim == "") {
                    alert("Kitabı alan kişinin telefonunu giriniz..");
                    error = false;
                } else {
                    if (value >= current) {
                        alert("Veriliş tarihi alış tarihinden sonra olamaz.");
                    } else {
                        document.kitapform.submit();
                    }
                }
            }
        }
    }
</script>
</body>
</html>
