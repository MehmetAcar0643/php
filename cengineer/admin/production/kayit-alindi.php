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
            <h3>Cengineer Yönetim Kayıt </h3>
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

                if ($_GET['durum']=="kayitbasarili") {?>

                    <div class="alert alert-success">
                        <strong> Cengineer Yönetim Kayıt Talebiniz Oluşturuldu. </strong>
                        <strong> Sonucu mail olarak iletilecektir.</strong>
                    </div>


                <?php }?>
            </div>
            <div>
                <a href="../../index.php"><button style="margin-bottom: 15px;" class="btn" type="button">Ana Sayfaya Dön!!</button></a>
            </div>

            <div >
                <a href="login.php"><button style="margin-bottom: 15px;" class="btn" type="button">Yönetim Paneline Giriş</button></a>
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