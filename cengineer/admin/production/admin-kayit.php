<html>
<head>
    <meta charset="utf-8">
    <title>Cengineer | Yönetim Kayıt</title>
    <!-- Required meta tags -->
    <meta name="description" content="gelişim geliştir">
    <meta name="keywords" content="gelisim gelistir,gelisim,gelistir">
    <meta name="author" content="Gelisim Gelistir">
    <meta name=" viewport
    " content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../user/public/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="../../user/public/js/jquery-3.2.1.slim.min.js"></script>
    <script src="../../user/public/js/popper.js"></script>
    <script src="../../user/public/js/bootstrap.js"></script>


</head>
<body>

<div align="center" class="container">
    <div style="height: auto" class="login-form media_ayar">
        <div class="login">
            <h3 >Cengineer Yönetim Paneli Kayıt </h3>
        </div>
        <form action="../connect/islem.php" method="POST">
<!--            --><?php
//            if ($_GET['durum'] == "no") { ?>
<!---->
<!--                <div class="alert alert-danger">-->
<!--                    <strong>Hata!</strong> E-posta ya da şifreniz hatalı-->
<!--                </div>-->
<!--            --><?php //} ?>
            <div class=" col-md-12">
                <?php

                if ($_GET['durum']=="farklisifre") {?>

                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
                    </div>

                <?php } elseif ($_GET['durum']=="eksiksifre") {?>

                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Şifreniz min. 6 karakter uzunluğunda olmalıdır.
                    </div>

                <?php } elseif ($_GET['durum']=="mukerrerkayit") {?>

                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
                    </div>

                <?php } elseif ($_GET['durum']=="basarisiz") {?>

                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
                    </div>
                <?php }?>
                <div class="row">
                    <div class="col-md-5 mr-auto">
                        <div>
                            <input type="text" name="kullanici_adsoyad" placeholder="Ad ve Soyadınız*" required>
                        </div>
                        <div>
                            <input type="email" name="kullanici_mail" placeholder="Mail Adresiniz(Kullanıcı Adınız)*"
                                   required>
                        </div>
                        <div>
                            <input type="password" name="kullanici_passwordone" placeholder="Şifreniz*" required>
                        </div>
                        <div>
                            <input type="password" name="kullanici_passwordtwo" placeholder="Şifreniz (Tekrar)*" required>
                        </div>
                    </div>
                    <div class="col-md-5 mr-auto">
                        <div>
                            <input type="tel" name="kullanici_gsm" placeholder="Telefon Numaranız*" required>
                        </div>
                        <div>
                            <input type="text" name="kullanici_il" placeholder="Yaşadığınız İl*" required>
                        </div>
                        <div>
                            <input type="text" name="kullanici_ilce" placeholder="Yaşadığınız İlce*" required>
                        </div>
                        <div>
                            <input type="text" name="kullanici_adres" placeholder="Yaşadığınız adres" required>
                        </div>

                    </div>
                </div>
            </div>
            <div align="center">
                <label class="mt-4"><a href="login.php">Giriş Paneline Geri gönmek için Tıklayınız</a></label>
            </div>
            <div align="center">
                <label class=""><a href="../../index.php">Anasayfaya Dönmek için Tıklayın</a></label>
            </div>

            <div>
                <button style="margin-bottom: 15px;" class="btn" type="submit" name="adminkayit">Kayıt Ol</button>
            </div>
            <!--            <div>-->
            <!--                <a href="kayit-ol.php">Yöneticilik için Kayıt ol</a>-->
            <!--            </div>-->
        </form>
    </div>
    <video autoplay muted loop>
        <source src="video/video.mp4">
    </video>
</div>


</body>
</html>