@extends('frontend.layout')
@section('title',"Mehmet Acar | Kişisel Blog Sitesi")
@section('content')

    <div class="intro intro-single route bg-image" style="background-image: url(/frontend//img/overlay-bg.jpg)">
        <div class="overlay-mf"></div>
        <div class="intro-content display-table">
            <div class="table-cell">
                <div class="container">
                    <h2 class="intro-title mb-4">{{$study->title}}</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="{{route("home.index")}}">Anasayfa</a>
                        </li>
                        <li class="breadcrumb-item active">"{{$study->title}}" Çalışmaları</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <main id="main">
        <section id="work" class="portfolio-mf sect-pt4 route">
            <div class="container">
                <div class="row">


                    @foreach($study->projects as $project)

                        @if($project->status==1)
                            <div class="col-xs-4 col-6 col-sm-4  col-lg-3">
                                <div class="work-box">
                                    <a href="">
                                        <div class="work-img">
                                            <img src="{{$project->file}}" alt="img" class="img-fluid">
                                        </div>
                                    </a>
                                    <div class="work-content">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <h2 class="w-title">{{$project->title}}</h2>
                                                <div class="w-more">
                                                    {{--                                                <span class="w-ctegory">Web Design</span> /--}}
                                                    <span class="ion-ios-calendar-outline"></span>
                                                    <span
                                                        class="w-date">{{date('d/m/Y', strtotime($project->updated_at))}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="w-like">
                                                    <a href="{{route('proje.show',$project->slug)}}">
                                                        <span class="ion-ios-eye"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </section>
    </main>


@endsection


@section('css')@endsection
@section('js')@endsection
