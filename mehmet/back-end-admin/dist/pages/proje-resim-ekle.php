<?php include "header.php";


if ($_GET['id']) {
    $id = $_GET['id'];
}

require_once("../../connect/ProjelerimController.php");
$projelercont = new ProjelerimController();
$proje_resim_sira = $projelercont->proje_resim_sira_cek();
echo $proje_resim_sira['sira'];
$proje_baslik = $projelercont->proje_baslik_getir($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sira=$_POST['sira'];
    $sira++;
    $uploads_dir = 'proje_resimler';
    @$tmp_name = $_FILES['file']["tmp_name"];
    @$name = $_FILES['file']["name"];

    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);

    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = $uploads_dir . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $id=$_POST['proje_id'];

    if (strlen($refimgyol) > 0) {
        $flag = $projelercont->proje_resim_ekle($refimgyol, $id, $sira);
    }
}

?>

<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Projeye Resim Ekle
                                <a href="proje-resimler.php?id=<?php echo $_GET['id']; ?>">
                                    <button class="btn btn-outline btn-purple btn-xs pull-right">
                                        <i class="fa fa-eye"></i> Yüklü Resimleri Gör
                                    </button>
                                </a></h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                            <form action="proje-resim-ekle.php" enctype="multipart/form-data" class="dropzone"
                                  data-plugin="dropzone" data-options="{ url: '../api/dropzone'}">
                                <div class="dz-message">
                                    <h3 class="m-h-lg">Projeye Resimler Ekle</h3>
                                    <p class="m-b-lg text-muted">Resim eklemek için tıklayın ve istediğiniz resimleri
                                        projenize ekleyin</p>

                                    <input type="hidden" name="proje_id" value="<?php echo $_GET['id'] ?>">
                                    <input type="hidden" name="sira" value="<?php echo $proje_resim_sira['sira'] ?>"
                                           class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php include "footer.php" ?>

