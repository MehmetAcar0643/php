<?php include "header.php";


require_once("../../connect/LoginController.php");
$logincont=new LoginController();
$kullanici=$logincont->kullanici_getir();




$error = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["sifre_eski"])) || empty(trim($_POST["sifre"])) || empty(trim($_POST["sifre_tekrar"]))) {
        array_push($error, "Lütfen Şifre Bilgileriniz Doldurunuz.");
    } else {
        if ($kullanici['sifre'] != md5($_POST["sifre_eski"])) {
            array_push($error, "Şuan Kullandığınız Şifreyi Yanlış Girdiniz.");
        } else {
            if (md5($_POST["sifre"]) != md5($_POST["sifre_tekrar"])) {
                array_push($error, "Girdiğiniz Yeni Şifreler Uyuşmuyor.");
            } else {
                if ($kullanici['sifre'] == md5($_POST["sifre"])) {
                    array_push($error, "Eski Şifreniz ile Yeni Şifreniz Aynı Olamaz.");
                }
                else{
                    $sifre=md5($_POST["sifre"]);
                }
            }
        }
    }
    if (count($error) == 0) {
        $flag = $logincont->kullanici_guncelle($sifre);
        if ($flag) {
            $message = "Kullanıcı Adı-Şifre Bilgileriniz Başarıyla Güncellendi.";
        } else {
            array_push($error, "Hata");
        }
    }
}
?>

<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">

                <div class="widget">
                    <header class="widget-header">
                        <h4 class="widget-title"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i> Kişisel Bilgiler</h4>
                    </header><!-- .widget-header -->
                    <hr class="widget-separator">

                    <?php if (count($error) > 0) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($error as $er) { ?>
                                - <?php echo $er; ?><br>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if ($message != '') { ?>
                        <div class="alert alert-success sonuc-cubuk" role="alert">
                            <span><?php echo $message; ?></span>
                        </div>
                    <?php } ?>
                    <div style="width:90%" class="widget-body container">
                        <form action="profil-ayar.php" method="POST">
                            <div class="form-group row">
                                <div class="form-group col-md-3">
                                    <label class="mt-2">AD</label>
                                    <input type="text" name="ad" value="<?php echo ucwords($kullanici['ad'])?>" class="form-control" disabled>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="mt-2">Soyad</label>
                                    <input type="text" name="soyad" value="<?php echo ucwords($kullanici['soyad'])?>"  class="form-control" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="mt-2">Mail</label>
                                    <input type="text" name="mail" value="<?php echo $kullanici['mail']?>"  class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <div class="form-group col-md-4">
                                    <label class="mt-2">Şu an Kullandığınız Şifre</label>
                                    <input type="password" name="sifre_eski" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="mt-2">Yeni Şifre</label>
                                    <input type="password" name="sifre" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="mt-2">Yeni Şifre (Tekrar)</label>
                                    <input type="password" name="sifre_tekrar" class="form-control">
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <a href="index.php">
                                    <button
                                        class="btn btn-outline mw-sm rounded btn-danger"
                                        type="button">
                                        İptal
                                    </button>
                                </a>
                            </div>
                            <div style="margin-right: 20px;" class="form-group pull-right">
                                <button  class="btn btn-outline mw-xl rounded btn-inverse" type="submit" name="">
                                    Şifremi Güncelle
                                </button>
                            </div>
                        </form>
                    </div><!-- .widget-body -->
                </div><!-- .widget -->

            </div>
        </section>
    </div>
</main>


<?php include "footer.php"?>
