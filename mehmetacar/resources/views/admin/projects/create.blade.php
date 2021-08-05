@extends('admin.layout')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><b>{{$study->title}}</b> Çalışmasına Proje Ekle</h1>
            </div>
        </div>


        <form action="{{route('projeler.store',$study->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row tile">
                <div class="col-md-6 form-group">
                    <label class="mr-sm-2">BAŞLIK</label>
                    <input type="text" class="form-control" name="title" value="{{old('title')}}" required>
                </div>
                <div class="col-md-6 form-group">
                    <label class="mr-sm-2">SLUG</label>
                    <input type="text" class="form-control" name="slug" value="{{old('slug')}}">
                </div>
                <div class="col-lg-3 col-md-12 form-group">
                    <label class="mr-sm-2">Başlangıç Tarihi</label>
                    <input type="date" class="form-control" name="baslangic" value="{{old('baslangic')}}" required>
                </div>
                <div class="col-lg-3 col-md-12 form-group">
                    <label class="mr-sm-2">Bitiş Tarihi</label>
                    <input type="date" class="form-control" name="bitis" value="{{old('bitis')}}" required>
                </div>
                <div class="col-md-6 form-group">
                    <div class="row">
                        <label class="control-label col-md-3" for="kapakcheck"> Kapak Fotoğrafı:</label>
                        <input type="checkbox" class="col-md-1 mt-1" name="kapakcheck" id="kapakcheck"
                               {{old('kapakcheck')!=""?'checked':""}}
                               value="1">
                    </div>
                    <div id="slayt" class="col-md-6">
                        <img id="kapakshow" width="150px" src="{{old('kapakdata')}}">
                    </div>
                </div>
                <input type="hidden" name="kapakdata" class="hidden-image-data" value="{{old('kapakdata')}}">
                <div class="col-md-12 form-group">
                    <label class="mr-sm-2">AÇIKLAMA</label>
                    <textarea id="editor1" class="form-control mb-2 mr-sm-2" cols="30" rows="10"
                              name="description" required>{{old('description')}}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <button style="float:right;" class="btn btn-outline-primary">Ekle</button>
                </div>
            </div>
        </form>

    </main>

@endsection


@section("scriptler")

@endsection
@section('css')@endsection
@section('js')@endsection
