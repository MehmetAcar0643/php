<?php include "header.php";

if (!$yetkiler['index']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
}
require_once("../../controller/IlanController.php");
$ilancont = new IlanController();
$personelcont = new PersonelController();
$personelsayisi = $personelcont->personelSayisi();
$basvurusayisi = $personelcont->basvuruSayisi();
$personelBilisim = $personelcont->personelTur(3);
$personelSekreter = $personelcont->personelTur(2);
$personelMudur = $personelcont->personelTur(4);
$personelCeo = $personelcont->personelTur(1);
$izindekiPersoneller = $personelcont->izindekiPersoneller();

$projecont = new ProjeController();
$projesayisi = $projecont->projeSayisi();
$aktifisilanlari = $ilancont->aktifIlanlar();
$bitisiYaklasanProjeler = $projecont->projeleri_bitis_yaklasan();


?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Ş&M Mühendislik</h1>
            <p><b>Teknoloji/Bilişim</b></p>
        </div>
    </div>
    <div id="anasayfa_div" class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Personel Sayısı</h4>
                        <p><b><?= $personelsayisi['personelsayisi'] ?></b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-bell fa-3x"></i>
                    <div class="info">
                        <h4>İş Başvuru Sayısı</h4>
                        <p><b><?= $basvurusayisi['basvurusayisi'] ?></b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-edit fa-3x"></i>
                    <div class="info">
                        <h4>Aktif İş İlanları</h4>
                        <p><b><?= $aktifisilanlari['aktifIlanlSayisi'] ?></b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-tasks fa-3x"></i>
                    <div class="info">
                        <h4>Proje Sayısı</h4>
                        <p><b><?= $projesayisi['projesayisi'] ?></b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 tile">
                <h3 class="tile-title">Departman Personel Dağılımı</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                </div>
            </div>
            <?php if ($yetkiler['personeller']['sayfa_goruntuleme']) { ?>
                <div class="col-md-6 col-lg-4 tile">
                    <h3 class="tile-title">İzindeki Personeller</h3>
                    <a href="izinli-<?= seo("tumunu-gor") ?>" class="btn btn-outline-primary pull-right">Tümünü
                        gör</a>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" width="100%"
                               cellspacing="0">
                            <thead>
                            <tr>
                                <th>
                                    <center>Sicil No</center>
                                </th>
                                <th>
                                    <center>Ad Soyad</center>
                                </th>
                                <?php if ($yetkiler['personeller']['genel']) { ?>
                                    <th></th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $izinlisay = 0;
                            foreach ($izindekiPersoneller

                                     as $izinli) {
                                $izinlisay++;
                                if ($izinlisay > 4) {
                                    break;
                                } else { ?>
                                    <tr>
                                        <td><?= $izinli['sicil_no'] ?></td>
                                        <td><?= $izinli['ad'] . " " . $izinli['soyad'] ?></td>
                                        <?php if ($yetkiler['personeller']['genel']) { ?>

                                            <td>
                                                <center>
                                                    <a href="personel-<?= seo($izinli['sicil_no']) ?>"><i
                                                                class="fa fa-eye"></i></a>
                                                </center>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php }
            if ($yetkiler['projeler']['sayfa_goruntuleme']) {
                ?>
                <div class="col-md-6 col-lg-4 tile">
                    <h3 class="tile-title">Bitiş Tarihi Yaklaşan Projeler</h3>
                    <a href="bitecekProje-<?= seo("tumunu-gor") ?>" class="btn btn-outline-primary pull-right">Tümünü
                        gör</a>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" width="100%"
                               cellspacing="0">
                            <thead>
                            <tr>
                                <th>
                                    <center>Proje Adı</center>
                                </th>
                                <th>Bitiş Tarihi</th>
                                <th>Kalan Süre</th>
                                <?php if ($yetkiler['projeler']['duzenleme']) { ?>
                                    <th></th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $projesay = 0;
                            foreach ($bitisiYaklasanProjeler as $bitecekProje) {
                                $projesay++;
                                if ($projesay > 4) {
                                    break;
                                } else { ?>
                                    <tr>
                                        <td><?= $bitecekProje['proje_adi'] ?></td>
                                        <td> <?= date("d/m/Y", strtotime($bitecekProje['bitis_tarih'])) ?></td>
                                        <td> <?= $bitecekProje['kalanSure'] ?> GÜN</td>
                                        <?php if ($yetkiler['projeler']['duzenleme']) { ?>

                                            <td>
                                                <center>
                                                    <a href="proje-<?= seo($bitecekProje['proje_adi']) ?>""><i
                                                            class="fa fa-eye"></i></a>
                                                </center>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php include "footer.php"; ?>
<script type="text/javascript">
    var veriler = [
        {
            value: <?=$personelBilisim['personelTur']?>,
            color: "#3deb54",
            highlight: "#a8ffa8",
            label: "Bilişim Personeli"
        },
        {
            value: <?=$personelMudur['personelTur']?>,
            color: "#365eff",
            highlight: "#9ecbff",
            label: "Müdür"
        },
        {
            value: <?=$personelSekreter['personelTur']?>,
            color: "#ff00e6",
            highlight: "#ff91fa",
            label: "Sekreter"
        },
        {
            value: <?=$personelCeo['personelTur']?>,
            color: "#ff0008",
            highlight: "#ff7a8a",
            label: "Ceo"
        }
    ]
    var grafik = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(grafik).Pie(veriler);
</script>