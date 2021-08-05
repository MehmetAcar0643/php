@extends('frontend.layout')
@section('title',"Mehmet Acar | Kişisel Blog Sitesi")
@section('content')

    <!-- ======= Intro Section ======= -->
    <div id="home" class="intro route bg-image" style="background-image: url(/frontend/img/intro-bg.jpg)">
        <div class="overlay-itro"></div>
        <div class="intro-content display-table">
            <div class="table-cell">
                <div class="container">
                    <!--<p class="display-6 color-d">Hello, world!</p>-->
                    <h1 class="intro-title mb-4">Mehmet ACAR</h1>
                    <p class="intro-subtitle"><span class="text-slider-items">Web Geliştirici,Web Tasarımcısı,Frontend Geliştirici,Backend Geliştirici</span><strong
                            class="text-slider"></strong></p>
                    <!-- <p class="pt-3"><a class="btn btn-primary btn js-scroll px-4" href="#about" role="button">Learn More</a></p> -->
                </div>
            </div>
        </div>
    </div><!-- End Intro Section -->
    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="hakkimda" class="about-mf sect-pt4 route">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box-shadow-full">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-5">
                                            <div class="about-img">
                                                <img src="{{$about->file}}"
                                                     class="img-fluid rounded b-shadow-a" alt="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-7">
                                            <div class="about-info">
                                                <p><span class="title-s">Ad-Soyad: </span> <span>Mehmet ACAR</span></p>
                                                <p><span class="title-s">Profil: </span>
                                                    <span>Web Geliştirici</span>
                                                </p>
                                                <p><span class="title-s">E-mail: </span>
                                                    <span>mehmetacar0643@gmail.com</span>
                                                </p>
                                                <p><span class="title-s">Telefon: </span> <span>---</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="skill-mf">
                                        <p class="title-s">Beceriler</p>
                                        @foreach($skills as $skill)
                                            <span>{{$skill->title}}</span> <span
                                                class="pull-right">{{$skill->percent}}%</span>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                     style="width: {{$skill->percent}}%;"
                                                     aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="about-me pt-4 pt-md-0">
                                        <div class="title-box-2">
                                            <h5 class="title-left">
                                                Hakkımda
                                            </h5>
                                        </div>
                                        <p class="lead">
                                            {!! $about->description !!}
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End About Section -->

        <!-- ======= Services Section ======= -->
        <section id="hizmetler" class="services-mf pt-5 route">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box text-center">
                            <h3 class="title-a">
                                Hizmetler
                            </h3>
                            <p class="subtitle-a">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            </p>
                            <div class="line-mf"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="service-box">
                            <div class="service-ico">
                                <span class="ico-circle"><i class="ion-monitor"></i></span>
                            </div>
                            <div class="service-content">
                                <h2 class="s-title">Web Tasarımı</h2>
                                <p class="s-description text-center">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni adipisci eaque autem
                                    fugiat! Quia,
                                    provident vitae! Magni
                                    tempora perferendis eum non provident.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-box">
                            <div class="service-ico">
                                <span class="ico-circle"><i class="ion-code-working"></i></span>
                            </div>
                            <div class="service-content">
                                <h2 class="s-title">Web Geliştirme</h2>
                                <p class="s-description text-center">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni adipisci eaque autem
                                    fugiat! Quia,
                                    provident vitae! Magni
                                    tempora perferendis eum non provident.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-box">
                            <div class="service-ico">
                                <span class="ico-circle"><i class="ion-android-phone-portrait"></i></span>
                            </div>
                            <div class="service-content">
                                <h2 class="s-title">Responsive Tasarım</h2>
                                <p class="s-description text-center">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni adipisci eaque autem
                                    fugiat! Quia,
                                    provident vitae! Magni
                                    tempora perferendis eum non provident.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Services Section -->

        <!-- ======= Counter Section ======= -->
        <div class="section-counter paralax-mf bg-image" style="background-image: url(/frontend/img/counters-bg.jpg)">
            <div class="overlay-mf"></div>
            <div class="container">
                {{--                <div class="row">--}}
                {{--                    <div class="col-sm-3 col-lg-3">--}}
                {{--                        <div class="counter-box counter-box pt-4 pt-md-0">--}}
                {{--                            <div class="counter-ico">--}}
                {{--                                <span class="ico-circle"><i class="ion-checkmark-round"></i></span>--}}
                {{--                            </div>--}}
                {{--                            <div class="counter-num">--}}
                {{--                                <p class="counter">450</p>--}}
                {{--                                <span class="counter-text">WORKS COMPLETED</span>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-sm-3 col-lg-3">--}}
                {{--                        <div class="counter-box pt-4 pt-md-0">--}}
                {{--                            <div class="counter-ico">--}}
                {{--                                <span class="ico-circle"><i class="ion-ios-calendar-outline"></i></span>--}}
                {{--                            </div>--}}
                {{--                            <div class="counter-num">--}}
                {{--                                <p class="counter">15</p>--}}
                {{--                                <span class="counter-text">YEARS OF EXPERIENCE</span>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-sm-3 col-lg-3">--}}
                {{--                        <div class="counter-box pt-4 pt-md-0">--}}
                {{--                            <div class="counter-ico">--}}
                {{--                                <span class="ico-circle"><i class="ion-ios-people"></i></span>--}}
                {{--                            </div>--}}
                {{--                            <div class="counter-num">--}}
                {{--                                <p class="counter">550</p>--}}
                {{--                                <span class="counter-text">TOTAL CLIENTS</span>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-sm-3 col-lg-3">--}}
                {{--                        <div class="counter-box pt-4 pt-md-0">--}}
                {{--                            <div class="counter-ico">--}}
                {{--                                <span class="ico-circle"><i class="ion-ribbon-a"></i></span>--}}
                {{--                            </div>--}}
                {{--                            <div class="counter-num">--}}
                {{--                                <p class="counter">36</p>--}}
                {{--                                <span class="counter-text">AWARD WON</span>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div><!-- End Counter Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="calismalar" class="portfolio-mf sect-pt4 route">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box text-center">
                            <h3 class="title-a">
                                Çalışmalar
                            </h3>
                            <p class="subtitle-a">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            </p>
                            <div class="line-mf"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($studies as $study)
                        <div class="col-md-4">
                            <div class="work-box">
                                <a href="">
                                    <div class="work-img">
                                        <img src="{{$study->file}}" alt="{{$study->slug}}" class="img-fluid">
                                    </div>
                                </a>
                                <div class="work-content">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <h2 class="w-title">{{$study->title}}</h2>
                                            <div class="w-more">
{{--                                                <span class="w-ctegory">Web Design</span> /--}}
                                                <span class="ion-ios-calendar-outline"></span>
                                                <span class="w-date">{{date('d/m/Y', strtotime($study->updated_at))}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="w-like">
                                                <a href="{{route('calisma.show',$study->slug)}}"> <span
                                                        class="ion-ios-eye"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Portfolio Section -->


        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog-mf sect-pt4 route">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box text-center">
                            <h3 class="title-a">
                                Blog
                            </h3>
                            <p class="subtitle-a">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            </p>
                            <div class="line-mf"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-img">
                                <a href="blog-single.html"><img src="/frontend/img/post-1.jpg" alt="" class="img-fluid"></a>
                            </div>
                            <div class="card-body">
                                <div class="card-category-box">
                                    <div class="card-category">
                                        <h6 class="category">Travel</h6>
                                    </div>
                                </div>
                                <h3 class="card-title"><a href="blog-single.html">See more ideas about Travel</a></h3>
                                <p class="card-description">
                                    Proin eget tortor risus. Pellentesque in ipsum id orci porta dapibus. Praesent
                                    sapien
                                    massa, convallis
                                    a pellentesque nec,
                                    egestas non nisi.
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="post-author">
                                    <a href="#">
                                        <img src="/frontend/img/testimonial-2.jpg" alt="" class="avatar rounded-circle">
                                        <span class="author">Morgan Freeman</span>
                                    </a>
                                </div>
                                <div class="post-date">
                                    <span class="ion-ios-clock-outline"></span> 10 min
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-img">
                                <a href="blog-single.html"><img src="/frontend/img/post-2.jpg" alt="" class="img-fluid"></a>
                            </div>
                            <div class="card-body">
                                <div class="card-category-box">
                                    <div class="card-category">
                                        <h6 class="category">Web Design</h6>
                                    </div>
                                </div>
                                <h3 class="card-title"><a href="blog-single.html">See more ideas about Travel</a></h3>
                                <p class="card-description">
                                    Proin eget tortor risus. Pellentesque in ipsum id orci porta dapibus. Praesent
                                    sapien
                                    massa, convallis
                                    a pellentesque nec,
                                    egestas non nisi.
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="post-author">
                                    <a href="#">
                                        <img src="/frontend/img/testimonial-2.jpg" alt="" class="avatar rounded-circle">
                                        <span class="author">Morgan Freeman</span>
                                    </a>
                                </div>
                                <div class="post-date">
                                    <span class="ion-ios-clock-outline"></span> 10 min
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-img">
                                <a href="blog-single.html"><img src="/frontend/img/post-3.jpg" alt="" class="img-fluid"></a>
                            </div>
                            <div class="card-body">
                                <div class="card-category-box">
                                    <div class="card-category">
                                        <h6 class="category">Web Design</h6>
                                    </div>
                                </div>
                                <h3 class="card-title"><a href="blog-single.html">See more ideas about Travel</a></h3>
                                <p class="card-description">
                                    Proin eget tortor risus. Pellentesque in ipsum id orci porta dapibus. Praesent
                                    sapien
                                    massa, convallis
                                    a pellentesque nec,
                                    egestas non nisi.
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="post-author">
                                    <a href="#">
                                        <img src="/frontend/img/testimonial-2.jpg" alt="" class="avatar rounded-circle">
                                        <span class="author">Morgan Freeman</span>
                                    </a>
                                </div>
                                <div class="post-date">
                                    <span class="ion-ios-clock-outline"></span> 10 min
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Blog Section -->

        <!-- ======= Contact Section ======= -->
        <section class="paralax-mf footer-paralax bg-image sect-mt4 route"
                 style="background-image: url(assets/img/overlay-bg.jpg)">
            <div class="overlay-mf"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="contact-mf">
                            <div id="iletisim" class="box-shadow-full">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="title-box-2">
                                            <h5 class="title-left">
                                                Send Message Us
                                            </h5>
                                        </div>
                                        <div>
                                            <form action="forms/contact.php" method="post" role="form"
                                                  class="php-email-form">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group">
                                                            <input type="text" name="name" class="form-control"
                                                                   id="name"
                                                                   placeholder="Your Name" data-rule="minlen:4"
                                                                   data-msg="Please enter at least 4 chars"/>
                                                            <div class="validate"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" name="email"
                                                                   id="email"
                                                                   placeholder="Your Email" data-rule="email"
                                                                   data-msg="Please enter a valid email"/>
                                                            <div class="validate"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="subject"
                                                                   id="subject" placeholder="Subject"
                                                                   data-rule="minlen:4"
                                                                   data-msg="Please enter at least 8 chars of subject"/>
                                                            <div class="validate"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                        <textarea class="form-control" name="message" rows="5"
                                                                  data-rule="required"
                                                                  data-msg="Please write something for us"
                                                                  placeholder="Message"></textarea>
                                                            <div class="validate"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-center mb-3">
                                                        <div class="loading">Loading</div>
                                                        <div class="error-message"></div>
                                                        <div class="sent-message">Your message has been sent. Thank you!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <button type="submit"
                                                                class="button button-a button-big button-rouded">Send
                                                            Message
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="title-box-2 pt-4 pt-md-0">
                                            <h5 class="title-left">
                                                Get in Touch
                                            </h5>
                                        </div>
                                        <div class="more-info">
                                            <p class="lead">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis dolorum
                                                dolorem soluta quidem
                                                expedita aperiam aliquid at.
                                                Totam magni ipsum suscipit amet? Autem nemo esse laboriosam ratione
                                                nobis
                                                mollitia inventore?
                                            </p>
                                            <ul class="list-ico">
                                                <li><span class="ion-ios-location"></span> 329 WASHINGTON ST BOSTON, MA
                                                    02108
                                                </li>
                                                <li><span class="ion-ios-telephone"></span> (617) 557-0089</li>
                                                <li><span class="ion-email"></span> contact@example.com</li>
                                            </ul>
                                        </div>
                                        <div class="socials">
                                            <ul>
                                                <li><a href=""><span class="ico-circle"><i
                                                                class="ion-social-facebook"></i></span></a>
                                                </li>
                                                <li><a href=""><span class="ico-circle"><i
                                                                class="ion-social-instagram"></i></span></a>
                                                </li>
                                                <li><a href=""><span class="ico-circle"><i
                                                                class="ion-social-twitter"></i></span></a></li>
                                                <li><a href=""><span class="ico-circle"><i
                                                                class="ion-social-pinterest"></i></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->


@endsection


@section('css')@endsection
@section('js')@endsection