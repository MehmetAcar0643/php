<?php
ob_start();
session_start();
include "../../../fonksiyon.php";
include "time.php";

if ($_SESSION['kullanici_nickname'] == null) {
    header("Location:login.php?durum=izinsizgiris");
    exit;
}
require_once("../../connect/DBController.php");


require_once("../../connect/İletisimController.php");
$iletisimcont = new İletisimController();
$mesajlar = $iletisimcont->mesajlar_durum_getir();

require_once("../../connect/AnaSayfaController.php");
$anasayfacont = new AnaSayfaController();
$anasayfa_logo = $anasayfacont->anasayfa_logo_getir();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap"/>
    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
    <title>Admin Panel</title>


    <link rel="stylesheet" href="../assets/css/ekleme.css">
    <link rel="stylesheet" href="../libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css ../assets/css/app.min.css -->
    <link rel="stylesheet" href="../libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="../libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="../libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <!-- endbuild -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
    <script src="../libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
    <script>
        Breakpoints();
    </script>

    <!--    ckeditor-->
    <script src="../ckeditor/ckeditor.js"></script>

    <!--    Tablo yer değiştirme-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <!--    Tablo Özellik-->


</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<!-- APP NAVBAR ==========-->
<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">

    <!-- navbar header -->
    <div class="navbar-header">
        <button type="button" id="menubar-toggle-btn"
                class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
        </button>

        <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse"
                data-target="#app-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="zmdi zmdi-hc-lg zmdi-more"></span>
        </button>

        <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse"
                data-target="#navbar-search" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="zmdi zmdi-hc-lg zmdi-search"></span>
        </button>

        <a href="index.php" class="navbar-brand">
            <span class="brand-icon"><i class="fa fa-gg"></i></span>
            <span class="brand-name">Mehmet ACAR</span>
        </a>
    </div><!-- .navbar-header -->

    <div class="navbar-container container-fluid">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
                <li class="hidden-float hidden-menubar-top">
                    <a href="javascript:void(0)" role="button" id="menubar-fold-btn"
                       class="hamburger hamburger--arrowalt is-active js-hamburger">
                        <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                    </a>
                </li>
                <li>
                    <h5 class="page-title hidden-menubar-top hidden-float">Panel</h5>
                </li>
            </ul>

            <ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">
                <!--                <li class="nav-item dropdown hidden-float">-->
                <!--                    <a href="javascript:void(0)" data-toggle="collapse" data-target="#navbar-search"-->
                <!--                       aria-expanded="false">-->
                <!--                        <i class="zmdi zmdi-hc-lg zmdi-search"></i>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!--                -->

                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-hc-lg zmdi-settings"></i></a>
                    <ul class="dropdown-menu animated flipInY">
                        <li><a href="profil-ayar.php"><i
                                        class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>Profilim</a>
                        </li>
                        <li>
                        <li><a href="logout.php"><i class="menu-icon fa fa-sign-out"></i>Çıkış Yap</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- navbar-container -->
</nav>
<!--========== END app navbar -->

<!-- APP ASIDE ==========-->
<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="index.php"><img class="img-responsive" src="<?php echo $anasayfa_logo['site_logo'] ?>"
                                             alt="avatar"/></a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5 style="margin-top: 20px;"><a href="index.php" class="username">Mehmet ACAR</a></h5>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">
                <li><a href="mailler.php"><span class="menu-text"><i class=" menu-icon m-r-sm fa fa-envelope"></i>Mailler</span>
                        <?php $say = 0;
                        foreach ($mesajlar as $mesaj) {
                            if ($mesaj['durum'] == 1) {
                                $say++;
                            }
                        }
                        if ($say != 0){ ?>
                        <span class="badge bg-white"><?php echo $say ?></span></a>
                    <?php } else { ?>
                        <span class="badge bg-white">BOŞ</span></a>
                    <?php } ?>
                </li>
                <li><a href="mail-ayarlar.php"><span class="menu-text"> <i class="menu-icon fa fa-mail-reply-all"></i>Mail Cevaplama Ayarları</span></a>
                </li>
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon fa fa-bars"></i>
                        <span class="menu-text">Ana Menü Panel Ayarı</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="ana-menu-panel.php"><span class="menu-text "> <i
                                            class="menu-icon fa fa-low-vision"></i></i>Panel Bilgileri</span></a></li>
                        <li><a href="ana-menu-panel-fotolari.php"><span class="menu-text"><i
                                            class="menu-icon fa fa-image"></i>Panel Fotoları</span></a>
                        </li>
                        <li><a href="sosyal_medya.php"><span class="menu-text"><i class="menu-icon fa fa-hashtag"></i> Sosyal Medya</span></a>
                        </li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon fa fa-info"></i>
                        <span class="menu-text">Hakkımda</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="hakkimda.php"><span class="menu-text "> <i
                                            class="menu-icon fa fa-info"></i></i>Hakkımda İçerik Ayarları</span></a>
                        </li>
                        <li><a href="hakkimda-foto.php"><span class="menu-text"><i class="menu-icon fa fa-image"></i>Hakkımda Panel Fotoğrafı</span></a>
                        </li>
                    </ul>
                </li>
                <li><a href="calismalarim.php"><span class="menu-text"><i class="menu-icon fa fa-server"></i>Çalışmalarım</span></a>
                </li>
                <li><a href="projelerim.php"><span class="menu-text"><i
                                    class="menu-icon fa fa-laptop"></i>Projelerim</span></a>
                </li>

            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>
<!--========== END app aside -->

<!-- navbar search -->
<div id="navbar-search" class="navbar-search collapse">
    <div class="navbar-search-inner">
        <form action="#">
            <span class="search-icon"><i class="fa fa-search"></i></span>
            <input class="search-field" type="search" placeholder="search..."/>
        </form>
        <button type="button" class="search-close" data-toggle="collapse" data-target="#navbar-search"
                aria-expanded="false">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="navbar-search-backdrop" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false"></div>
</div><!-- .navbar-search -->