<?php
include "includes/header.php";
include "includes/navbarleft.php";
$sayfa = @$_GET['sayfa'];
$kacadet = 15;

if ($_POST['id'] && $_POST['id'] != "") {
    $id = $_POST['id'];
    $alinistar = $_POST['alinistar'];
    $alinistar = date("Y-m-d", strtotime($alinistar));
    $author = $_SESSION['kutuphane']['username'];
    $run->kitapal($id, $alinistar, $author);
}
if ($_GET['sil']) {
    $id = $_GET['sil'];
    $run->kitapislemact($id, 0);
}
if ($_GET['ara']) {
    $ara = htmlspecialchars($_GET['ara']);
    $kitapislemleri = $run->arakitapislemleri($ara, $sayfa, $kacadet);
    $sonucSayisi = $run->arakitapislemsayisi($ara);
} else {
    $kitapislemleri = $run->kitapislemleri($sayfa, $kacadet);
    $sonucSayisi = $run->kitapislemsayisi();
}
?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Kitap İade İşlemleri</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row thumbnail">

                <?php $run->mesaj();
                if (isset($_SESSION['islemid'])) {
                    $url = "kitapaltutanak.php?islemid=" . $_SESSION['islemid']; ?>
                    <div id="message">
                        <button class="btn btn-sm btn-primary"
                                onclick="window.open('<?php echo $url; ?>','popup2','width=500,height=600,top=0,left=20,scrollbars=yes');">
                            Tutanak al
                        </button>
                    </div>
                    <hr>
                    <?php unset($_SESSION['islemid']);
                } ?>
                <table class="table table-responsive table-striped table-bordered">
                    <tr>
                        <th>Resim</th>
                        <th>ID</th>
                        <th>Kitap adı</th>
                        <th>Kimde</th>
                        <th>TC</th>
                        <th>Ünvan</th>
                        <th>Tel</th>
                        <th>Verilen T.</th>
                        <th>Dönecek T.</th>
                        <th>Teslim T.</th>
                    </tr>
                    <?php
                    while ($row = $kitapislemleri->fetch()) {
                        ?>
                        <?php
                        if ($row['gelecektar'] < date('Y-m-d') && $row['alinistar'] == NULL) {
                            echo '<tr style="color:red;">';
                        } else {
                            echo '<tr>';
                        }
                        ?>
                        <td>
                            <?php
                            $kitapid = $row['kitapid'];
                            $resim = $run->kitapget($kitapid)->resim;
                            if ($resim == "") { ?>
                                <img class="img-responsive" width="80" src="../kapak/kitap.jpg">
                            <?php } else { ?>
                                <img class="img-responsive" width="80" src="<?php echo $resim; ?>">
                            <?php } ?>
                        </td>
                        <td><?php echo $row['kitapid']; ?></td>
                        <td><?php echo $run->kitapget($kitapid)->kitapadi; ?></td>
                        <td><?php echo $row['kimde']; ?></td>
                        <td><?php echo $row['tc']; ?></td>
                        <td><?php echo $row['unvan']; ?></td>
                        <td><?php echo $row['iletisim']; ?></td>
                        <td><?php echo $run->tarihci($row['verilistar']); ?></td>
                        <td><?php echo $run->tarihci($row['gelecektar']); ?></td>
                        <td>
                            <?php
                            if ($row['alinistar'] == NULL) { ?>
                                <div class="tar">
                                    <div class="input-group">
                                        <form class="form-horizontal" enctype="multipart/form-data" name="kitapform"
                                              id="kitapform" action="kitapal.php" method="POST">
                                            <input type="text" class="form-control" id="alinistar" name="alinistar"
                                                   placeholder="Alınan tarihi giriniz.">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <span class="input-group-btn">
                                                <input type="submit" class="btn btn-sm btn-primary" value="Al">
                                           		</span>
                                        </form>
                                    </div>
                                </div>
                            <?php } else {
                                echo $run->tarihci($row['alinistar']);
                            } ?>
                        </td>

                        </tr>
                    <?php }
                    ?>
                </table>
                <?php $run->pagination($sayfa, $sonucSayisi, $kacadet); ?>
            </div>
        </div>
    </div>
<?php include "includes/footer.php"; ?>