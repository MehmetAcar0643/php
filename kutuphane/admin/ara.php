<?php
include "includes/header.php";
include "includes/navbarleft.php";

include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

if($_POST['aranan']){
    $_SESSION['key']=$_POST['aranan'];
}
if(isset($_SESSION['key'])){
    $kitaps         = $run->arama($_SESSION['key']);
    if(!$kitaps){
        $_SESSION['message'] = '<div id="message"><div class="col-md-12 alert alert-danger">Kitap bulunamadı.</div></div>';
    }
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


    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Kitap Arama</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row thumbnail">
                <table class="table table-responsive table-striped table-bordered">
                    <tr><th>Id</th><th>Kitap adı</th><th>Yazar</th><th>Basım Tarihi</th><th>ISBN</th><th>Düzenle</th></tr>
                    <?php
                        foreach ($kitaps as $row){?>
                        <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['kitapadi'];?></td>
                            <td><?php echo $row['yazar'];?></td>
                            <?php $basimtar   = explode("-", $row["basimtar"]);
                			$basimtar   = $basimtar[0]; ?>
                            <td><?php echo $basimtar;?></td>
                            <td><?php echo $row['isbn'];?></td>
                            <td>
                            <a href="kitapduzenle.php?duzenle=<?php echo $row['id']; ?>"><button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="fa fa-pencil-square-o"></i></button></a>
                           </td>
                        </tr>
                       <?php }
                    ?>
                </table>

            </div>
            <?php } ?>
        </div>
    </div>
<?php include "includes/footer.php"; ?>
