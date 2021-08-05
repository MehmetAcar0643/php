@extends('admin.layout')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>{{$study['title']}}</h1>
            </div>
        </div>

        <div class="tile">
            <form action="{{route('calismalar.update',$study['id'])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="mr-sm-2">BAŞLIK</label>
                        <input type="text" class="form-control" value="{{$study['title']}}" name="title">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="mr-sm-2">SLUG</label>
                        <input type="text" class="form-control" value="{{$study['slug']}}" name="slug">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="mr-sm-2">BİLGİ YÜZDESİ</label>
                        <input type="range" class="form-control-range" value="{{$study['percent']}}"
                               oninput="showVal(this.value)" onchange="showVal(this.value)" name="percent">
                        <b>%</b><label id="valBox">{{$study['percent']}}</label>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="row form-group">
                            <label for="kapakcheck"> Kapak Fotoğrafı:</label>
                            <input type="checkbox" class="col-md-1 mt-1" name="kapakcheck" id="kapakcheck"
                                   value="1" {{$study['file'] != null ? 'checked' : ""}}>
                        </div>
                        <center><img id="kapakshow" width="40%" src="{{$study['file'] != null ? $study['file'] : ""}}">
                        </center>
                    </div>
                    <input type="hidden" name="kapakdata" class="hidden-image-data"
                           value="{{$study['file'] != null ? $study['file'] : ""}}">
                    <div class="col-md-12 form-group">
                        <label class="mr-sm-2">AÇIKLAMA</label>
                        <textarea id="editor1" class="form-control mb-2 mr-sm-2" cols="30" rows="10"
                                  name="description" required>{{$study['description']}}</textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <button style="float:right;" class="btn btn-outline-primary">Güncelle</button>
                    </div>
                </div>


            </form>
        </div>

    </main>

@endsection

@section("scriptler")

    <script>
        function showVal(newVal) {
            document.getElementById("valBox").innerHTML = newVal;
        }
    </script>
@endsection

@section('css')@endsection
@section('js')@endsection
