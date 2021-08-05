<?php
include 'olmadı.php';
include "olmadı-fonksiyon.php";
$ayarsor = $db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id' => 0
));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);


?>


<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $ayarcek['ayar_title'] ?></title>
    <!-- Required meta tags -->
    <meta name="description" content="<?php echo $ayarcek['ayar_description'] ?>">
    <meta name="keywords" content="<?php echo $ayarcek['ayar_keyword'] ?>">
    <meta name="author" content="<?php echo $ayarcek['ayar_author'] ?>">
    <meta name=" viewport " content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="user/public/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="user/public/css/style.css">
    <link rel="stylesheet" href="user/public/css/animate.css">
    <script src="user/public/js/jquery-3.2.1.slim.min.js"></script>
    <script src="user/public/js/popper.js"></script>
    <script src="user/public/js/bootstrap.js"></script>
    <script type="text/javascript" src="user/public/js/cengineer.js"></script>
</head>
<body>
<div class="headermenu">
    <div class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <div class="animated flip">
                <a href="#" class="navbar-brand "><?= $ayarcek['ayar_sitelogoisim'] ?></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerac">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="headerac">
                <ul class="navbar-nav mr-auto animated zoomInDown">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link"><i class="fa fa-home"></i></a>
                    </li>


                    <?php
                    $menusor = $db->prepare("SELECT * FROM menu where menu_durum=:durum order by menu_sira ASC limit 2 ");
                    $menusor->execute(array(
                        'durum' => 1
                    ));
                    while ($menucek = $menusor->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <li class="nav-item">
                            <a href="
                            <?php if(!empty($menucek['menu_url'])){
                               echo $menucek['menu_url'];
                            } else{

                                echo "sayfa-".seo($menucek['menu_ad']);

                            }
                                ?>



" class="nav-link "><?php echo $menucek['menu_ad'] ?></a>
                        </li>
                    <?php } ?>


                    <li class="nav-item">
                        <a href="hakkimda.php" class="nav-link">Hakkımda</a>
                    </li>
                    <li class="nav-item">
                        <a href="iletisim.php" class="nav-link">İletişim</a>
                    </li>
                </ul>
                <form class="form-inline animated bounceInRight">
                    <input id="arama" type="search" class="form-control form-control-sm">
                    <label for="arama">ARA</label>
                </form>
            </div>
        </div>
    </div>
</div>
