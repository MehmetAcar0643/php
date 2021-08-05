@extends('admin.layout')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>Çalışmalar</h1>
            </div>
        </div>

        <div style="background: red">
            <ol style="color: white">
                <li>TEXTAREA MAX KARAKTER GÖSTER</li>
                <li>Projeler kısmına yaptığın request işlemlerini yap. make:request</li>
                <li>Hata alınca dolu inputların boşalmamasını yap. Projelerde yaptın.</li>
            </ol>
        </div>

        <div class="tile">
            <div class="form-group pull-right">
                <a href="{{route('calismalar.create')}}" class="btn btn-outline-primary">
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
                        <th width="12%">
                            <center>Kapak Fotoğrafı</center>
                        </th>
                        <th width="20%">
                            <center>Konu</center>
                        </th>
                        <th>
                            <center>Yüzde</center>
                        </th>
                        <th width="10%">
                            <center>"Çalışmalarım" da gösterilsin mi?</center>
                        </th>
                        <th width="10%">
                            <center>Proje Durum</center>
                        </th>
                        <th width="15%"></th>
                        <th width="10%">
                            <center></center>
                        </th>

                    </tr>
                    </thead>
                    <tbody id="sortable">
                    @foreach($data['study'] as $study)
                        <tr id="item-{{$study['id']}}">
                            <td class="sortable">#{{$study['id']}}</td>
                            <td>
                                <center><img width="50%" src="{{$study['file']}}" alt=""></center>
                            </td>
                            <td>{{$study['title']}}</td>
                            <td>
                                <center>
                                    <div style="border: 1px solid black" class="progress mb-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                             style="width: {{$study['percent']}}%;"
                                             aria-valuemin="0" aria-valuemax="100">%{{$study['percent']}}
                                        </div>
                                    </div>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <div class="toggle lg">
                                        <label>
                                            <input type="checkbox"
                                                   {{$study['status']==1 ? 'checked' : ""}} class="status"
                                                   data-id="{{$study['id']}}">
                                            <span class="button-indecator"></span>
                                        </label>
                                    </div>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <div class="toggle lg">
                                        <label>
                                            <input type="checkbox"
                                                   {{$study['projects_status']==1 ? 'checked' : ""}} class="projects_status"
                                                   data-id="{{$study['id']}}">
                                            <span
                                                class="button-indecator"></span>
                                        </label>
                                    </div>
                                </center>
                            </td>
                            <td>
                                <a href="{{route('projeler.index',$study['id'])}}" class="btn btn-outline-primary">
                                    Projeleri İncele
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                <center>
                                    <a href="{{route('calismalar.edit',$study['id'])}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0)">
                                        <i id="{{$study['id']}}" class="fa fa-trash"></i>
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
                        url: "calismalar/" + destroy_id,
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
                    {{--var asd="'{{route('studies.sortable')}}'";--}}
                    {{--alert(asd);--}}
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{route('studies.sortable')}}",
                        success: function (msg) {
                            // console.log(msg);
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
                    url: '{{route("studies.status")}}',
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
        $(function () {
            $('.projects_status').change(function () {
                var id = $(this).data('id');
                var projects_status = $(this).prop('checked') == true ? 1 : 0;


                $.ajax({
                    type: "POST",
                    url: '{{route("studies.projects_status")}}',
                    data: {'projects_status': projects_status, 'id': id},
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
