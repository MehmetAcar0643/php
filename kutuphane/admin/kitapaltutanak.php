<!DOCTYPE html>
<html>
<head>
    <title>Kitap Al</title>
    <style type="text/css">
        .icerik
        {
            width: 400px;
            margin: auto;
        }
        table
        {
            width: 100%;
        }
        table tr td
        {
            padding: 4px;
        }
        .baslik
        {
            text-align: right;
            font-weight: bold;
        }
        .ortabaslik
        {
            text-align: center;
            font-weight: bold;
        }
        .imza
        {
            width: 100%;
        }
        .veren
        {
            width: 50%;
            text-align: left;
            float: left;
        }
        .alan
        {
            width: 50%;
            text-align: right;
            float: left;
        }
    </style>
</head>
<!-- <body onload="window.print()"> -->
<body onload="window.print()">
<?php 
include "includes/function.php";
include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');

$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

if($_GET['islemid'])
{   

    $id         = $_GET['islemid'];
    $islem      = $run->getkitapislemleri($id);
    $kitapid    = $islem->kitapid;
    $kimde      = $islem->kimde;
    $tc = $islem->tc;

    $unvan      = $islem->unvan;
    $verilistar = $islem->verilistar;
    $verilistar = $run->tarihci($verilistar);
    $gelecektar = $islem->gelecektar;
    $gelecektar = $run->tarihci($gelecektar);
    $author     = $islem->veren;
    $image      = base64_encode($generatorPNG->getBarcode($kitapid, $generatorPNG::TYPE_CODE_128)); 


    $kitap      = $run->kitapget($kitapid);
    $kitapadi   = $kitap->kitapadi;
    $yazar      = $kitap->yazar;

    $vericikisi = $run->getAuthor($author);
    $verici     = $vericikisi->adsoyad;
    

?>
<div class="icerik">
    <table border="1" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" class="ortabaslik">Kitap Teslim Tutanağı</td>
        </tr>
        <tr>
            <td colspan="2">
                <center>
                    <img style="margin-top:5px" width="250px" src="data:image/png;base64,<?php echo $image; ?>">
                    <p style="font-size:12px;margin: 0"><?php echo $kitapid; ?></p>
                </center>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="ortabaslik">Kitap Bilgileri</td>
        </tr>
        <tr>
            <td class="baslik">Kitap adı:</td>
            <td><?php echo $kitapadi; ?></td>
        </tr>
        <tr>
            <td class="baslik">Yazar:</td>
            <td><?php echo $yazar; ?></td>
        </tr>
        <tr>
            <td colspan="2" class="ortabaslik">Alıcı Bilgileri</td>
        </tr>
        <tr>
            <td class="baslik">Alıcı:</td>
            <td><?php echo $kimde." - ".$tc; ?></td>
        </tr>
        <tr>
            <td class="baslik">Unvan:</td>
            <td><?php echo $unvan; ?></td>
        </tr>
        <tr>
            <td colspan="2"><center><?php echo date('d-m-Y'); ?> tarihinde Üniversite Kütüphanesine teslim edilmiştir.</center></td>
        </tr>
    </table>
    <div class="imza">
        <div class="veren">
            <p>Teslim Eden</p>
            <p>İmza</p>
            <br/>
            <p><?php echo $kimde; ?></p>
        </div>
        <div class="alan">
            <p>Teslim Alan</p>
            <p>İmza</p>
            <br/>
            <p><?php echo $verici; ?></p>
        </div>
    </div>
</div>
<?php } ?>
</body>
</html>