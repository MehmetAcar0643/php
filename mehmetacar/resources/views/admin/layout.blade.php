<!DOCTYPE html>
<html lang="tr">
<head>
    {{--    <meta name="description"--}}
    {{--          content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">--}}
    {{--    <!-- Twitter meta-->--}}
    {{--    <meta property="twitter:card" content="summary_large_image">--}}
    {{--    <meta property="twitter:site" content="@pratikborsadiya">--}}
    {{--    <meta property="twitter:creator" content="@pratikborsadiya">--}}
    {{--    <!-- Open Graph Meta-->--}}
    {{--    <meta property="og:type" content="website">--}}
    {{--    <meta property="og:site_name" content="Vali Admin">--}}
    {{--    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">--}}
    {{--    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">--}}
    {{--    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">--}}
    {{--    <meta property="og:description"--}}
    {{--          content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">--}}
    <title>Mehmet ACAR</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/style.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/cropit.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

{{--    <link rel="stylesheet" href="css/iziToast.min.css">--}}
{{--    <script src="js/iziToast.min.js"></script>--}}
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->


</head>
<body class="app sidebar-mini">
<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="index.php">Yönetim Paneli</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
                                    aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i
                    class="fa fa-bell-o fa-lg"></i></a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
                <li class="app-notification__title">1 Yeni Mesaj!!</li>
                <div class="app-notification__content">


                    <div class="app-notification__content">
                        <li><a class="app-notification__item" href="javascript:;"><span
                                    class="app-notification__icon"><span class="fa-stack fa-lg"><i
                                            class="fa fa-circle fa-stack-2x text-success"></i><i
                                            class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                                <div>
                                    <p class="app-notification__message">Mesaj Konusu</p>
                                    <p class="app-notification__meta">2 Saat Önce</p>
                                </div>
                            </a></li>
                    </div>
                </div>
                <li class="app-notification__footer"><a href="#">Tüm mesajları gör</a></li>
            </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
                    class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="">
                        <i class="fa fa-user fa-lg"></i>
                        Profilim
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="">
                        <i class="fa fa-sign-out fa-lg"></i>
                        Çıkış Yap
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img width="30%" height="30%" class="app-sidebar__user-avatar"
             src="https://images.unsplash.com/photo-1593642634315-48f5414c3ad9?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80">
        <div>
            <p class="app-sidebar__user-name">Mehmet ACAR</p>
            {{--            <p class="app-sidebar__user-designation"><?= $personel['departman'] ?></p>--}}
        </div>
    </div>
    <ul class="app-menu">

        <li>
            <a class="app-menu__item" href="{{route("admin.index")}}">
                <i class="app-menu__icon fa fa-envelope"></i>
                <span class="app-menu__label">Mailler</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="{{route("about.index")}}">
                <i class="app-menu__icon fa fa-info"></i>
                <span class="app-menu__label">Hakkımda</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="{{route('calismalar.index')}}">
                <i class="app-menu__icon fa fa-university"></i>
                <span class="app-menu__label">Çalışmalar</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="{{route('bloglar.index')}}">
                <i class="app-menu__icon fa fa-map-marker"></i>
                <span class="app-menu__label">Bloglar</span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-home"></i>
                <span class="app-menu__label">Home1</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="">
                        <i class="icon fa fa-home"></i>
                        HomeAlt1
                    </a>
                </li>
                <li>
                    <a class="treeview-item" href="">
                        <i class="icon fa fa-home"></i>
                        HomeAlt2
                    </a>
                </li>
                <li>
                    <a class="treeview-item" href="">
                        <i class="icon fa fa-home"></i>
                        HomeAlt3
                    </a>
                </li>

            </ul>
        </li>



    </ul>


</aside>

@yield('content')
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form id="kapakform" action="#">
                    <div style="width: 100%" class="image-editor">
                        <input type="file" class="cropit-image-input">
                        <div class="cropit-preview"></div>
                        <div class="image-size-label">
                            Resmi Boyutlandır
                        </div>
                        <input style="width: 100%" type="range" class="cropit-image-zoom-input">
                        <button type="submit" class="btn btn-sm btn-danger">Kırp</button>
                        <button type="button" id="kapakok" class="btn btn-sm btn-success" data-dismiss="modal">
                            Tamam
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <span style="float: left; color:red;"><b>Fotoğraf işlemleri için önce kırpın.</b></span>
            </div>
        </div>
    </div>
</div>

<!-- Essential javascripts for application to work-->
{{--<script src="/admin/js/jquery-3.3.1.min.js"></script>--}}
<script src="/admin/js/jquery.min.js"></script>
<script src="/admin/js/jquery-ui.js"></script>
<script src="/admin/js/jquery.cropit.js"></script>

<script src="/admin/js/popper.min.js"></script>
<script src="/admin/js/bootstrap.min.js"></script>
<script src="/admin/js/main.js"></script>
<script src="/admin/ckeditor/ckeditor.js"></script>
<script src="/admin/js/custom.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

{{--<script src="js/custom.js"></script>--}}
<!-- The javascript plugin to display page loading on top-->
{{--<script src="js/plugins/pace.min.js"></script>--}}
<!-- Page specific javascripts-->
{{--<script type="text/javascript" src="js/plugins/chart.js"></script>--}}
{{--<script src="js/sweetalert2.all.js"></script>--}}
{{--<script type="text/javascript" src="js/plugins/dropzone.js"></script>--}}
{{--<script src="../ckeditor/ckeditor.js"></script>--}}


<script>
    CKEDITOR.replace('editor1');
</script>

@yield('scriptler')

@if(session()->has('success'))
    <script>alertify.success('{{session('success')}}')</script>
@endif
@if(session()->has('error'))
    <script>alertify.error('{{session('error')}}')</script>
@endif

@foreach($errors->all() as  $error)
    <script>
        alertify.error('{{$error}}');
    </script>
@endforeach

{{--<script>--}}
{{--    Dropzone.options.myawesomedropzone = {--}}
{{--        paramName: "file", // The name that will be used to transfer the file--}}
{{--        maxFilesize: 2 // MB--}}
{{--    };--}}
{{--</script>--}}




<!--<script type="text/javascript">-->
<!--    var data = {-->
<!--        labels: ["January", "February", "March", "April", "May"],-->
<!--        datasets: [-->
<!--            {-->
<!--                label: "My First dataset",-->
<!--                fillColor: "rgba(220,220,220,0.2)",-->
<!--                strokeColor: "rgba(220,220,220,1)",-->
<!--                pointColor: "rgba(220,220,220,1)",-->
<!--                pointStrokeColor: "#fff",-->
<!--                pointHighlightFill: "#fff",-->
<!--                pointHighlightStroke: "rgba(220,220,220,1)",-->
<!--                data: [65, 59, 80, 81, 56]-->
<!--            },-->
<!--            {-->
<!--                label: "My Second dataset",-->
<!--                fillColor: "rgba(151,187,205,0.2)",-->
<!--                strokeColor: "rgba(151,187,205,1)",-->
<!--                pointColor: "rgba(151,187,205,1)",-->
<!--                pointStrokeColor: "#fff",-->
<!--                pointHighlightFill: "#fff",-->
<!--                pointHighlightStroke: "rgba(151,187,205,1)",-->
<!--                data: [28, 48, 40, 19, 86]-->
<!--            }-->
<!--        ]-->
<!--    };-->
<!--    var pdata = [-->
<!--        {-->
<!--            value: 300,-->
<!--            color:"#F7464A",-->
<!--            highlight: "#FF5A5E",-->
<!--            label: "Red"-->
<!--        },-->
<!--        {-->
<!--            value: 50,-->
<!--            color: "#46BFBD",-->
<!--            highlight: "#5AD3D1",-->
<!--            label: "Green"-->
<!--        },-->
<!--        {-->
<!--            value: 100,-->
<!--            color: "#FDB45C",-->
<!--            highlight: "#FFC870",-->
<!--            label: "Yellow"-->
<!--        }-->
<!--    ]-->
<!---->
<!--    var ctxl = $("#lineChartDemo").get(0).getContext("2d");-->
<!--    var lineChart = new Chart(ctxl).Line(data);-->
<!---->
<!--    var ctxb = $("#barChartDemo").get(0).getContext("2d");-->
<!--    var barChart = new Chart(ctxb).Bar(data);-->
<!---->
<!--    var ctxr = $("#radarChartDemo").get(0).getContext("2d");-->
<!--    var radarChart = new Chart(ctxr).Radar(data);-->
<!---->
<!--    var ctxpo = $("#polarChartDemo").get(0).getContext("2d");-->
<!--    var polarChart = new Chart(ctxpo).PolarArea(pdata);-->
<!---->
<!--    var ctxp = $("#pieChartDemo").get(0).getContext("2d");-->
<!--    var pieChart = new Chart(ctxp).Pie(pdata);-->
<!---->
<!--    var ctxd = $("#doughnutChartDemo").get(0).getContext("2d");-->
<!--    var doughnutChart = new Chart(ctxd).Doughnut(pdata);-->
<!--</script>-->
<!---->
<!--<script type="text/javascript">-->
<!--    if(document.location.hostname == 'pratikborsadiya.in') {-->
<!--        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){-->
<!--            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),-->
<!--            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)-->
<!--        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');-->
<!--        ga('create', 'UA-72504830-1', 'auto');-->
<!--        ga('send', 'pageview');-->
<!--    }-->
<!--</script>-->


</body>
</html>
