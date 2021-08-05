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
                <li></li>
            </ol>
        </div>

        <div class="tile">
            <div class="form-group pull-right">
                <a href="{{route('bloglar.create')}}" class="btn btn-outline-primary">
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
                            <center>Başlık</center>
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
                    @foreach($blogs as $blog)
                        <tr id="item-{{$blog->id}}">
                            <td class="sortable">#{{$blog->id}}</td>
                            <td>
                                <center><img width="50%" src="{{$blog->file}}" alt=""></center>
                            </td>
                            <td>{{$blog->title}}</td>
                            <td>
                                <center>
                                    <div class="toggle lg">
                                        <label>
                                            <input type="checkbox"
                                                   {{$blog->status==1 ? 'checked' : ""}} class="status"
                                                   data-id="{{$blog->id}}">
                                            <span class="button-indecator"></span>
                                        </label>
                                    </div>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <a href="{{route('bloglar.edit',$blog->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0)">
                                        <i id="{{$blog->id}}" class="fa fa-trash"></i>
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
                        url: "bloglar/" + destroy_id,
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
                        url: "{{route('bloglar.sortable')}}",
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
                    url: '{{route("bloglar.status")}}',
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
