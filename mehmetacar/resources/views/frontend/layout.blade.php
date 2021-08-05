<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta name="author" content="Mehmet Acar">
    <meta name="description" content="Bilgisayar mühendisi, Web Geliştici,Laravel,PHP and more!" />
    <link rel="canonical" href="https://mertdy.com/" />
    <meta name="keywords"
          content="Mehmet Acar, Bilgisayar Mühendisi, Frontend Geliştirici, Javascript Geliştirici,Backend Geliştirici">
    <meta name="robots" content="index, follow">
    <meta name="application-name" content="mehmetacar.com">

    <!-- Favicons -->
    <link href="/frontend/img/favicon.png" rel="icon">
    <link href="/frontend/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/frontend/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="/frontend/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/frontend/vendor/venobox/venobox.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/frontend/css/style.css" rel="stylesheet">


</head>

<body id="page-top">

<!-- ======= Header/ Navbar ======= -->
<nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll" href="#page-top">
            <img width="20%" src="" alt="mehmetacar logo" class="navbar-logo">
{{--            {{$about->file}}--}}
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
                aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link js-scroll active" href="{{route("home.index")}}">Anasayfa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll" href="{{route("home.index")}}#hakkimda">Hakkımda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll" href="{{route("home.index")}}#hizmetler">Hizmetler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll" href="{{route("home.index")}}#calismalar">Çalışmalar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll" href="{{route("home.index")}}#blog">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll" href="{{route("home.index")}}#iletisim">İletişim</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



@yield('content')

<!-- ======= Footer ======= -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="copyright-box">
                    <p class="copyright">&copy; 2021 <strong>Mehmet Acar</strong></p>
                    <div class="credits">
                        Tüm Hakları Saklıdır.
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer><!-- End  Footer -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="/frontend/vendor/jquery/jquery.min.js"></script>
<script src="/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/frontend/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="/frontend/vendor/php-email-form/validate.js"></script>
<script src="/frontend/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="/frontend/vendor/counterup/jquery.counterup.min.js"></script>
<script src="/frontend/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="/frontend/vendor/typed.js/typed.min.js"></script>
<script src="/frontend/vendor/venobox/venobox.min.js"></script>

<!-- Template Main JS File -->
<script src="/frontend/js/main.js"></script>

</body>

</html>
