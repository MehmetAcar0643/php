@extends('admin.layout')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><b>{{$project->title}}</b> Çalışmasına Ait calisma</h1>
                {{--                <a href="{{route('projeler.index',$project->study_id)}}">das</a>--}}
            </div>
        </div>

        <div style="background: red">
            <ol style="color: white">
                <li>Resim Eklemede uzantı kontrolü request ile olmuyor.</li>
            </ol>
        </div>

        <div class="tile">
            <div class="form-group ">
                <form action="{{route('resimler.store',$project->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h1 class="h3 mb-0 text-gray-800">
                        <label for="" class="form-group">Resim Ekle
                            <input type="file" class="form-control" name="imagefile[]" id="file" multiple>
{{--                            <input type="hidden" value="<?= $id ?>" name="id">--}}
                        </label>
                        <button class="btn btn-primary">Ekle</button>
                    </h1>
                </form>
            </div>
            <div class="row nubeT">
                @foreach($project->projectImages as $image)
                    <div class="col-xs-4 col-6 col-sm-4  col-lg-2 mb-2" id="item-{{$image->id}}">
                        <div class="card">
                            <div class="card-title">
                                <i style="float: right;margin-left: 10px;font-size: 24px;"
                                   class="fa fa-arrows sortable"></i>
                                <a style="float: right;font-size: 24px" href="javascript:void(0)">
                                    <i id="{{$image->id}}" class="fa fa-trash"></i>
                                </a>

                            </div>
                            <img class="card-img-top" src="{{$image->file}}">
                            <div class="card-body">
                                <div style="text-align: center" class="toggle lg">
                                    <label>
                                        <input type="checkbox"
                                               {{$image->status==1 ? 'checked' : ""}} class="status"
                                               data-id="{{$image->id}}">
                                        <span class="button-indecator"></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection

@section("scriptler")
    <script>

        $(".fa-trash").click(function () {
            destroy_id = $(this).attr("id");
            alertify.confirm('Silme İşlemini Onaylıyor Musunuz?', "Bu İşlem Geri Alınamaz!!",
                function () {

                    $.ajax({
                        type: "DELETE",
                        url: "resimler/" + destroy_id,
                        success: function (msg) {
                            if (msg) {
                                $('#item-' + destroy_id).remove();
                                alertify.success('Silme İşlemi Başarılı');
                            } else {
                                alertify.error('Silme İşlemi Başarısız');
                            }
                        }
                    });

                },
                function () {
                    alertify.error("Silme İşlemi İptal Edildi");
                })
        });

        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.nubeT').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{route('images.sortable')}}",
                        success: function (msg) {
                            console.log(msg);
                            if (msg) {
                                alertify.success('İşlem Başarılı');
                            } else {
                                alertify.error('İşlem Başarısız');
                            }
                        }
                    });

                }
            });
            $('.nubeT').disableSelection();

        });

        $(function () {
            $('.status').change(function () {
                var id = $(this).data('id');
                var status = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "POST",
                    url: '{{route("images.status")}}',
                    data: {'status': status, 'id': id},
                    success: function (msg) {
                        // console.log(msg);
                        if (msg) {
                            alertify.success('Durum Güncellendi');
                        } else {
                            alertify.error('Durum Güncellemesi Başarısız');
                        }
                    }
                });
            })
        })

    </script>

@endsection

@section('css')@endsection
@section('js')@endsection
