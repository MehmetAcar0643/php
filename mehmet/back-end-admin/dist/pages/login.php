<?php

require_once("../../connect/LoginController.php");

if ($_POST['kullanici_nickname']) {
    $username = $_POST['kullanici_nickname'];
    $password = $_POST['kullanici_password'];
    $logincont = new LoginController();
    $logincont->kullanicigiris($username, $password);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Giriş</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap"/>
    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">

    <link rel="stylesheet" href="../libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/misc-pages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
</head>
<body class="simple-page">
<div id="back-to-home">
    <a href="../../../index" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
</div>

<div class="simple-page-wrap">
    <div style="color: white" class="simple-page-logo animated swing">
            <span><i class="fa fa-gg"></i></span>
            <span>Yönetim Paneli Giriş</span>

    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="login-form">
        <?php if($_GET['durum']=="no"){?>
        <div class="alert alert-danger" role="alert">
            <strong>HATA! </strong>
            <span>E-mail adresiniz ya da şifreniz yanlış...</span>
        </div>
        <?php }?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input id="sign-in-email" name="kullanici_nickname" type="email" class="form-control"
                       placeholder="Email">
            </div>

            <div class="form-group">
                <input id="sign-in-password" name="kullanici_password" type="password" class="form-control"
                       placeholder="Şifre">
            </div>
            <div class="form-group m-b-xl">
                <div class="checkbox checkbox-primary">
                    <input type="checkbox" id="keep_me_logged_in"/>
                    <label for="keep_me_logged_in"> Beni Hatırla</label>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Giriş Yap">
        </form>
    </div><!-- #login-form -->

    <div class="simple-page-footer">
        <p><a href="password-forget.html">Şifreni mi unuttun ?</a></p>

    </div><!-- .simple-page-footer -->


</div><!-- .simple-page-wrap -->
</body>
</html>