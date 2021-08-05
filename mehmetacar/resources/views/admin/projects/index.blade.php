@extends('admin.layout')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><b>{{$study->title}}</b> Çalışmasına Ait calisma</h1>
            </div>
        </div>

        <div style="background: red">
            <ol style="color: white">
                <li>Düzenleme linkinde study_id rastgele yazınca hata çıkıyor</li>
                <li>Düzenleme Kısmında projenin çalışma alanı değiştirilmedi,olmuyor.</li>
            </ol>
        </div>

        <div class="tile">
            <div class="form-group pull-right">
                <a href="{{route('projeler.create',$study->id)}}" class="btn btn-outline-primary">
                    <i class="fa fa-plus"></i>
                    Yeni Ekle
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" width="100%"
                       cellspacing="0">
                    <thead>
                    <tr>
                        <th width="1%">
                            <center>ID</center>
                        </th>
                        <th width="">
                            <center>Oluşturulma Tarihi</center>
                        </th>
                        <th width="10%">
                            <center>Son Güncelleme</center>
                        </th>
                        <th width="12%">
                            <center>Kapak Fotoğrafı</center>
                        </th>
                        <th width="20%">
                            <center>Başlık</center>
                        </th>
                        <th width="20%">
                            <center>Slug</center>
                        </th>
                        <th width="15%">
                            <center>Proje Resimleri</center>
                        </th>
                        <th width="10%">
                            <center>Durum</center>
                        </th>
                        <th width="10%">
                            <center></center>
                        </th>

                    </tr>
                    </thead>
                    <tbody id="sortable">
                    @foreach($study->projects as $project)
                        <tr id="item-{{$project->id}}">
                            <td class="sortable">#{{$project->id}}</td>
                            <td>
                                <center>{{date('d/m/Y H:m:s', strtotime($project->created_at))}}</center>
                            </td>
                            <td>
                                <center>{{date('d/m/Y H:m:s', strtotime($project->updated_at))}}</center>
                            </td>
                            <td>
                                <center><img width="50%" src="{{$project->file}}" alt=""></center>
                            </td>
                            <td>{{$project->title}}</td>
                            <td>{{$project->slug}}</td>
                            <td>
                                <center>
                                    <a href="{{route('resimler.index',$project->id)}}" class="btn btn-outline-primary">
                                        Projele Resimleri
                                    </a>
                                </center>
                            <td>
                                <center>
                                    <div class="toggle lg">
                                        <label>
                                            <input type="checkbox"
                                                   {{$project->status==1 ? 'checked' : ""}} class="status"
                                                   data-id="{{$project->id}}">
                                            <span class="button-indecator"></span>
                                        </label>
                                    </div>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <a href="{{route('projeler.edit',[$study->id,$project->id])}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0)">
                                        <i id="{{$project->id}}" class="fa fa-trash"></i>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                        url: "projeler/" + destroy_id,
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

            $('#sortable').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{route('project.sortable')}}",
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
            $('#sortable').disableSelection();

        });

        $(function () {
            $('.status').change(function () {
                var id = $(this).data('id');
                var status = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "POST",
                    url: '{{route("project.status")}}',
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
