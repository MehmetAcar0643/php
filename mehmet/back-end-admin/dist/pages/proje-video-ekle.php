<?php include "header.php";

if ($_GET['id']) {
    $id = $_GET['id'];
}


require_once("../../connect/ProjelerimController.php");
$projelercont = new ProjelerimController();
$proje_video_sira = $projelercont->proje_video_sira_cek();
$proje_baslik = $projelercont->proje_baslik_getir($id);



if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $sira = $_POST['sira'];
    $sira++;

    $uploads_dir = 'proje_videolar';
    @$tmp_name = $_FILES['file']["tmp_name"];
    @$name = $_FILES['file']["name"];

    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);

    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = $uploads_dir . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $ids = $_POST['proje_id'];

    if (strlen($refimgyol) > 0) {
        $flag = $projelercont->proje_video_ekle($refimgyol, $ids, $sira);
    }
}

?>

<body>
<script src="../assets/js/sweetalert2.all.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>-->
<script type="text/javascript">
    var $asd;
    swal({
        title: 'Projeye Nereden Video Ekleyeceksiniz?',
        input: 'select',
        inputOptions: {
            '1': 'Kendi Cihazımdan',
            '2': 'Youtubeden'
        },
        inputPlaceholder: 'required',
        showCancelButton: true,
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value !== '') {
                    resolve();
                } else {
                    resolve('Herhangi bir seçim yapmadınız!!');
                }
            });
        }
    }).then(function (result) {
        if (result.value == 1) {
            $(".menu-baslik").fadeIn(500);
            $(".proje-video-pc").fadeIn(500);

        } else if(result.value==2) {
            $(".menu-baslik").fadeIn(50);
            $(".proje-video-net").fadeIn(500);
        }

    });


</script>
</body>

<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header menu-baslik">
                            <h4 class="widget-title">Projeye Video Ekle
                                <a href="proje-videolar.php?id=<?php echo $_GET['id']; ?>">
                                    <button class="btn btn-outline btn-purple btn-xs pull-right">
                                        <i class="fa fa-eye"></i> Yüklü Videoları Gör
                                    </button>
                                </a>
                            </h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">

                        <div class="widget-body proje-video-pc">
                            <form action="proje-video-ekle.php" enctype="multipart/form-data" class="dropzone"
                                  data-plugin="dropzone" data-options="{ url: '../api/dropzone'}">
                                <div class="dz-message">
                                    <h3 class="m-h-lg">Projeye Cihazından Videolar Ekle</h3>
                                    <p class="m-b-lg text-muted">Video eklemek için tıklayın ve istediğiniz resimleri
                                        projenize ekleyin</p>

                                    <input type="hidden" name="proje_id" value="<?php echo $_GET['id'] ?>">
                                    <input type="hidden" name="sira" value="<?php echo $proje_video_sira['sira'] ?>"
                                           class="form-control">
                                </div>
                            </form>
                        </div>
                        <div class="widget-body proje-video-net">
                            <form action="proje-youtube-video-ekle.php" method="POST" class="form-horizontal">
                                <div class="form-group">
                                    <div class="form-group col-md-7">
                                        <img width="80%" src="proje_videolar/video.png" alt="">
                                    </div>
                                    <div style="margin-left: 15px;" class="form-group col-md-5">
                                        <div style="width: 75%;" class="form-group">
                                            <label class="" for=""><strong>Youtube video linki(ÖRNEK:OxvMLMVNJOw)</strong> </label>
                                            <input type="text" name="video" value=""
                                                   class="form-control">
                                        </div>
                                        <input type="hidden" name="proje_id" value="<?php echo $_GET['id'] ?>">
                                        <input type="hidden" name="sira" value="<?php echo $proje_video_sira['sira'] ?>"
                                               class="form-control">
                                        <div class="form-group">
                                            <button style="float: right;margin-right: 15px;"
                                                    class="btn btn-outline mw-xl rounded btn-inverse" type="submit"
                                                    name="net_video_ekle">Video Ekle
                                            </button>
                                        </div>
                                    </div>
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

