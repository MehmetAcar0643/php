@extends('admin.layout')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>Hakkımda</h1>
            </div>
        </div>

        <div style="background: red">
            <ol style="color: white">
                <li>RESİM GÜNCELLENİNCE PANELİN SOL ÜSTTEKİ RESMİNİN DEĞİŞMESİNİ HALLET</li>
                <li>Özgeçmiş pdf ekle</li>
            </ol>
        </div>


        <form action="{{route('about.update',[$data->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row tile">
                <div class="col-md-6 col-lg-4 form-group kapak_photo">
                    <div class="row">
                        <label class="control-label col-md-3" for="kapakcheck"> Kapak Fotoğrafı:</label>
                        <input type="checkbox" class="col-md-1 mt-1" name="kapakcheck" id="kapakcheck"
                               value="1" {{$data->file != null ? 'checked' : ""}}>
                    </div>
                    <img id="kapakshow" width="100%" src="{{$data->file != null ? $data->file : ""}}">
                    <input type="hidden" name="kapakdata" class="hidden-image-data"
                           value="{{$data->file != null ? $data->file : ""}}">
                </div>

                <div class="col-md-6 col-lg-8 form-group">
                    <label class="mr-sm-2">Hakkımda</label>
                    <textarea id="editor1" class="form-control mb-2 mr-sm-2" cols="30" rows="10"
                              name="description" required>{{$data->description}}</textarea>
                </div>
                <div class="col-md-12 col-lg-12">
                    <button style="float:right;" class="btn btn-outline-primary">Güncelle</button>
                </div>
            </div>
        </form>
    </main>

@endsection

@section("scriptler")


@endsection

@section('css')@endsection
@section('js')@endsection
