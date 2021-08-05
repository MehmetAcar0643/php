<?php include "includes/header.php"; ?>
<?php 
    if(isset($_GET["aranan"]))
    {

        $keyword        = $_GET["aranan"];
        $kategori       = $_GET["kategori"];      if($kategori == 0){ $kategori =""; }
        $kacadet        = 20;
        $data           = $run->arama($keyword,$kategori);
        $sonucSayisi    = $data["0"];
        $sonuclar       = $data["1"];
        if($sonucSayisi == 0)
        {
            $mesaj = '<div class="alert alert-danger">Aradığınız kelimeyle ilgili bir kitap bulunamadı.</div>';
        }
        else
        {
            $mesaj = '<div class="alert bgyesil"><b>'.$sonucSayisi.'</b> adet kitap bulundu.</div>';
        }


        // Kapak Göster Gizle Başlangıç
        if(isset($_POST["tick"]))
        {
            if(isset($_POST['kapak']))
            {
                $_SESSION['kapak']  = "checked";
                $baslik             = "Kapak Gizle";
            }
            else
            {
                $_SESSION['kapak']  = "";
                $baslik             = "Kapak Göster";
            }
        }

        if(isset($_SESSION['kapak']))
        {
            if($_SESSION['kapak'] == "checked")
            {
                $baslik = "Kapak Gizle";
            }
            else
            {
                $baslik = "Kapak Göster";
            }
        }
        else
        {
            $_SESSION["kapak"]  = "checked";
            $baslik             = "Kapak Gizle";
        }
        // Kapak Göster Gizle Bitiş
    }
    else
    {
        header("Refresh:0; url=index.php");
        die();
    }
?>
<script type="text/javascript">
$(document).ready(function(){
    $("#kapak").on("change", "input:checkbox", function(){
        $("#kapak").submit();
    });
});
</script>
<center><a href="index.php" style="color:#b3e2fa;"><button class="btn" style="margin-top:20px"><i class="fa fa-arrow-left"></i> Geri Dön</button></a></center>
    <div class="container thumbnail" style="margin-top:20px">

        <?php echo @$mesaj; ?>
        <table class="table table-bordered table-responsive table-hover">
            <thead>
                <tr class="bgyesil">
                    <th><form name="kapak" id="kapak" method="POST"><input type="hidden" name="tick" id="tick" value=""><input type="checkbox" name="kapak" <?php echo @$_SESSION['kapak']; ?>/> <?php echo $baslik; ?></form></th>
                    <th>Kitap Adı </a></th>
                    <th>Yazar Adı</th>
                    <th>Yayın Evi</th>
                    <th>Kategori </th>
                    <th>Basım Tarihi</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($sonuclar as $row) { 
                $kitapid    = $row["kitapid"];
                $basimtar   = explode("-", $row["basimtar"]);
                $basimtar   = $basimtar[0];
                //$resim      = $row["resim"];
                ?>
                <?php 
                    if($row['resim'] == null || $row['resim'] == ''){
                        $resim = "../kapak/kitap.png"; 
                    }
                    else{
                        $resim = $row['resim'];
                    }
                ?>
                <tr>
                    <td>
                        <?php if($_SESSION["kapak"] == "checked"){ ?>
                        <a href="kapak/<?php echo $resim; ?>" data-lightbox="roadtrip"><img class="img-responsive" width="80" height="117" src="kapak/<?php echo $resim; ?>"></a>
                        <?php } ?>
                    </td>
                    <td><?php echo $row["kitapadi"]; ?></td>
                    <td><?php echo $row["yazar"]; ?></td>
                    <td><?php echo $row["yayinevi"]; ?></td>
                    <td><?php echo $row["kategoriad"]; ?></td>
                    <td><?php echo $basimtar; ?></td>
                    <td><?php $run->kitapDurum($kitapid); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php $run->pagination($sayfa,$sonucSayisi,$kacadet,$keyword,$kategori); ?>
    </div>

    </div>

<?php include "includes/footer.php"; ?>