@extends('frontend.layout')
@section('title',"Mehmet Acar | Kişisel Blog Sitesi")
@section('content')

    <div class="intro intro-single route bg-image" style="background-image: url(/frontend//img/overlay-bg.jpg)">
        <div class="overlay-mf"></div>
        <div class="intro-content display-table">
            <div class="table-cell">
                <div class="container">
                    <h2 class="intro-title mb-4">{{$project->title}}</h2>
                    {{--                    <ol class="breadcrumb d-flex justify-content-center">--}}
                    {{--                        <li class="breadcrumb-item">--}}
                    {{--                            <a href="{{route('home.index')}}">Anasayfa</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li class="breadcrumb-item">--}}
                    {{--                            <a href="#">{{$project->study_id}}</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li class="breadcrumb-item active">Data</li>--}}
                    {{--                    </ol>--}}
                </div>
            </div>
        </div>
    </div>

    <main id="main">
        <section class="blog-wrapper sect-pt4" id="blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="post-box">
                            <div class="post-thumb">
                                <img src="{{$project->file}}" class="img-fluid" alt="">
                            </div>
                            <div class="post-meta">
                                <h1 class="article-title">Lorem ipsum dolor sit amet consec tetur adipisicing</h1>
                                <ul>
                                    <li>
                                        <span class="ion-ios-calendar-outline"></span>
                                        {{date('d/m/Y', strtotime($project->updated_at))}}
                                    </li>
                                    {{--                                    <li>--}}
                                    {{--                                        <span class="ion-pricetag"></span>--}}
                                    {{--                                        <a href="#">Web Design</a>--}}
                                    {{--                                    </li>--}}
                                    <li>
                                        <span class="ion-chatbox"></span>
                                        <a href="#">14</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="article-content">
                                <p>
                                    {!! $project->description !!}
                                </p>

                            </div>
                            <div class="row">

                                @foreach($project->projectImages as $image)
                                    @if($image->status==1)
                                        <div class="col-xs-4 col-6 col-sm-4  col-lg-4">
                                            <div class="work-box">
                                                <a href="{{$image->file}}" data-gall="portfolioGallery"
                                                   class="venobox">
                                                    <div class="work-img">
                                                        <img src="{{$image->file}}" alt="" class="img-fluid">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>


                        <div class="box-comments">
                            <div class="title-box-2">
                                <h4 class="title-comments title-left">Comments (34)</h4>
                            </div>
                            <ul class="list-comments">
                                <li>
                                    <div class="comment-avatar">
                                        <img src="/frontend/img/testimonial-2.jpg" alt="">
                                    </div>
                                    <div class="comment-details">
                                        <h4 class="comment-author">Oliver Colmenares</h4>
                                        <span>18 Sep 2017</span>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores
                                            reprehenderit, provident cumque
                                            ipsam temporibus maiores
                                            quae natus libero optio, at qui beatae ducimus placeat debitis voluptates
                                            amet corporis.
                                        </p>
                                        <a href="3">Reply</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="comment-avatar">
                                        <img src="/frontend/img/testimonial-4.jpg" alt="">
                                    </div>
                                    <div class="comment-details">
                                        <h4 class="comment-author">Carmen Vegas</h4>
                                        <span>18 Sep 2017</span>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores
                                            reprehenderit, provident cumque
                                            ipsam temporibus maiores
                                            quae natus libero optio, at qui beatae ducimus placeat debitis voluptates
                                            amet corporis,
                                            veritatis deserunt.
                                        </p>
                                        <a href="3">Reply</a>
                                    </div>
                                </li>
                                <li class="comment-children">
                                    <div class="comment-avatar">
                                        <img src="/frontend/img/testimonial-2.jpg" alt="">
                                    </div>
                                    <div class="comment-details">
                                        <h4 class="comment-author">Oliver Colmenares</h4>
                                        <span>18 Sep 2017</span>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores
                                            reprehenderit, provident cumque
                                            ipsam temporibus maiores
                                            quae.
                                        </p>
                                        <a href="3">Reply</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="comment-avatar">
                                        <img src="/frontend/img/testimonial-2.jpg" alt="">
                                    </div>
                                    <div class="comment-details">
                                        <h4 class="comment-author">Oliver Colmenares</h4>
                                        <span>18 Sep 2017</span>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores
                                            reprehenderit, provident cumque
                                            ipsam temporibus maiores
                                            quae natus libero optio.
                                        </p>
                                        <a href="3">Reply</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-comments">
                            <div class="title-box-2">
                                <h3 class="title-left">
                                   Yorum Yap
                                </h3>
                            </div>
                            <form class="form-mf">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control input-mf" id="inputName"
                                                   placeholder="Ad-Soyad *" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="email" class="form-control input-mf" id="inputEmail1"
                                                   placeholder="E-mail *" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <textarea id="textMessage" class="form-control input-mf"
                                                      placeholder="Yorumunuz *" name="message" cols="45" rows="8"
                                                      required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="button button-a button-big button-rouded">
                                            Yorumunu Yayınla
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-sidebar sidebar-search">
                            <h5 class="sidebar-title">Search</h5>
                            <div class="sidebar-content">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search for..."
                                               aria-label="Search for...">
                                        <span class="input-group-btn">
                      <button class="btn btn-secondary btn-search" type="button">
                        <span class="ion-android-search"></span>
                      </button>
                    </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="widget-sidebar">
                            <h5 class="sidebar-title">Recent Post</h5>
                            <div class="sidebar-content">
                                <ul class="list-sidebar">
                                    <li>
                                        <a href="#">Atque placeat maiores.</a>
                                    </li>
                                    <li>
                                        <a href="#">Lorem ipsum dolor sit amet consectetur</a>
                                    </li>
                                    <li>
                                        <a href="#">Nam quo autem exercitationem.</a>
                                    </li>
                                    <li>
                                        <a href="#">Atque placeat maiores nam quo autem</a>
                                    </li>
                                    <li>
                                        <a href="#">Nam quo autem exercitationem.</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-sidebar">
                            <h5 class="sidebar-title">Archives</h5>
                            <div class="sidebar-content">
                                <ul class="list-sidebar">
                                    <li>
                                        <a href="#">September, 2017.</a>
                                    </li>
                                    <li>
                                        <a href="#">April, 2017.</a>
                                    </li>
                                    <li>
                                        <a href="#">Nam quo autem exercitationem.</a>
                                    </li>
                                    <li>
                                        <a href="#">Atque placeat maiores nam quo autem</a>
                                    </li>
                                    <li>
                                        <a href="#">Nam quo autem exercitationem.</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-sidebar widget-tags">
                            <h5 class="sidebar-title">Tags</h5>
                            <div class="sidebar-content">
                                <ul>
                                    <li>
                                        <a href="#">Web.</a>
                                    </li>
                                    <li>
                                        <a href="#">Design.</a>
                                    </li>
                                    <li>
                                        <a href="#">Travel.</a>
                                    </li>
                                    <li>
                                        <a href="#">Photoshop</a>
                                    </li>
                                    <li>
                                        <a href="#">Corel Draw</a>
                                    </li>
                                    <li>
                                        <a href="#">JavaScript</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


@section('css')@endsection
@section('js')@endsection
