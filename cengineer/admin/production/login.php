<html>
<head>
    <meta charset="utf-8">
    <title>Cengineer | Yönetim Giriş</title>
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

<div class="container">
    <div class="login-form">
        <div class="login">
            <h3>Cengineer Yönetim Paneli</h3>
        </div>
        <form action="../connect/islem.php" method="POST">
            <?php
            if ($_GET['durum'] == "no") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> E-posta ya da şifreniz hatalı
                </div>
            <?php } elseif ($_GET['durum']=='sifredegisti'){?>
                <div class="alert alert-danger">
                    <strong>Hata!</strong> Şifreniz Başarılı bir şekilde değiştirildi. Lütfen Tekrar giriş Yapınız.
                </div>
            <?php }?>
            <div>
                <input type="text" name="kullanici_mail" placeholder="kullanıcı Adınız(Mail)" required>
            </div>
            <div>
                <input type="password" name="kullanici_password" placeholder="Şifre" required>
            </div>
            <div align="center">
               <label class="mt-4"><a href="admin-kayit.php">Yöneticilik başvurusu için tıklayınız.</a></label>
            </div>
            <div>
                <button class="btn" type="submit" name="admingiris">Giriş Yap</button>
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