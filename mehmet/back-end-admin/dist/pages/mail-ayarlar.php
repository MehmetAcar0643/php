<?php include "header.php";


require_once("../../connect/İletisimController.php");
$iletisimcont = new İletisimController();
$iletisim = $iletisimcont->mail_ayar_getir();
$iletisim_smtp = $iletisimcont->mail_smtp_getir();


$error = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $host = $_POST['host'];
    $gonderen = $_POST['gonderen'];
    $mail = $_POST['mail'];
    $sifre = $_POST['sifre'];
    $secure = $_POST['secure'];



    $flag = $iletisimcont->mesaj_ayar_guncelle($host,$gonderen, $mail, $sifre, $secure);
    if ($flag) {
        $message = "Bilgiler Başarıyla Güncellendi";
        $iletisim = $iletisimcont->mail_ayar_getir();
    } else {
        array_push($error, "Hata");
    }


}


?>

    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="row">

                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title"><i class="menu-icon fa fa-mail-reply-all"></i> Mail Ayarları
                            </h4>
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
                        <div style="width:50%" class="widget-body container">
                            <form action="mail-ayarlar.php" method="POST">

                                <div style="width: 75%;" class="form-group">
                                    <label class="mt-2">SMTP Host</label>
                                    <input type="text" name="host" value="<?php echo $iletisim['smtp_host'] ?>"
                                           class="form-control">
                                </div>
                                <div style="width: 75%;" class="form-group">
                                    <label class="mt-2">Mail Gönderen</label>
                                    <input type="text" name="gonderen" value="<?php echo $iletisim['smtp_gonderen'] ?>"
                                           class="form-control">
                                </div>
                                <div style="width: 75%;" class="form-group">
                                    <label class="mt-2">SMTP E-Posta Adresi</label>
                                    <input type="text" name="mail" value="<?php echo $iletisim['smtp_mail'] ?>"
                                           class="form-control">
                                </div>
                                <div style="width: 75%;" class="form-group">
                                    <label class="mt-2">SMTP E-Posta Şifresi</label>
                                    <input type="text" name="sifre" value="<?php echo $iletisim['smtp_sifre'] ?>"
                                           class="form-control">
                                </div>
                                <div style="width: 25%;" class="form-group">
                                    <label class="mt-2">SMTP Secure</label>
                                    <select name="secure" id="" class="form-control" required>
                                        <option value="<? echo $iletisim['smtp_secure_id'] ?>"><?php echo $iletisim['smtp_secure'] ?></option>
                                        <?php foreach ($iletisim_smtp as $smtp) { ?>
                                            <option value="<?php echo $smtp['id'] ?>"><?php echo $smtp['smtp_secure'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>


                                <div style="width: 25%;" class="form-group pull-right">
                                    <a href="index.php">
                                        <button
                                                class="btn btn-outline mw-sm rounded btn-danger"
                                                type="button">
                                            İptal
                                        </button>
                                    </a>
                                </div>
                                <div class="form-group pull-right">
                                    <button style="margin-right: 5px;" class="btn btn-outline mw-xl rounded btn-inverse"
                                            type="submit"
                                            name="">BİLGİLERİ GÜNCELLE
                                    </button>
                                </div>
                            </form>
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->

                </div>
            </section>
        </div>
    </main>

<?php include "footer.php" ?>