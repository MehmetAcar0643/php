@extends('admin.layout')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><b>{{$project->title}}</b>Düzenle</h1>
            </div>
        </div>

        <div class="tile">
            <form action="{{route('projeler.update',[$project->study_id,$project->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-md-6 form-group">
                        <label class="mr-sm-2">BAŞLIK</label>
                        <input type="text" class="form-control" value="{{$project->title}}" name="title" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="mr-sm-2">SLUG</label>
                        <input type="text" class="form-control" value="{{$project->slug}}" name="slug">
                    </div>
                    <div class="col-lg-3 col-md-12 form-group">
                        <label class="mr-sm-2">Başlangıç Tarihi</label>
                        <input type="date" class="form-control" value="{{$project->baslangic}}" name="baslangic" required>
                    </div>
                    <div class="col-lg-3 col-md-12 form-group">
                        <label class="mr-sm-2">Bitiş Tarihi</label>
                        <input type="date" class="form-control" value="{{$project->bitis}}" name="bitis" required>
                    </div>
                        <div class="col-lg-6 col-md-12 form-group">
                            <div class="row form-group">
                                <label class="mr-sm-2" for="kapakcheck"> Kapak Fotoğrafı:</label>
                                <input type="checkbox" class="col-md-1 mt-1" name="kapakcheck" id="kapakcheck"
                                       value="1" {{$project->file != null ? 'checked' : ""}}>
                            </div>
                            <center>
                                <img id="kapakshow" width="40%" src="{{$project->file != null ? $project->file : ""}}">
                            </center>
                        </div>
                    <input type="hidden" name="kapakdata" class="hidden-image-data"
                           value="{{$project->file != null ? $project->file : ""}}">
                    <div class="col-md-12 form-group">
                        <label class="mr-sm-2">AÇIKLAMA</label>
                        <textarea id="editor1" class="form-control mb-2 mr-sm-2" cols="30" rows="10"
                                  name="description" required>{{$project->description}}</textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <button style="float:right;" class="btn btn-outline-primary">Güncelle</button>
                    </div>
                </div>
            </form>
        </div>

    </main>

@endsection

@section("scriptler")@endsection

@section('css')@endsection
@section('js')@endsection
