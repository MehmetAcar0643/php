$(document).ready(function () {

    $(".cevapla-menu").hide();
    $(".mail-don").hide();
    $(".sonuc-cubuk").hide(4000);
    $(".proje-video-pc").hide();
    $(".proje-video-net").hide();
    $(".menu-baslik").hide();


    $(".sil-calisma").click(function (e) {

        var $data_url = $(this).data("url");

        swal({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamayacaksınız!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'Hayır'
        }).then(function (result) {
            if (result.value) {
                swal(
                    window.location.href = $data_url
                )
            }
        })
    })

    $(".sil-proje").click(function (e) {

        var $data_url = $(this).data("url");

        swal({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamayacaksınız!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'Hayır'
        }).then(function (result) {
            if (result.value) {
                swal(
                    window.location.href = $data_url
                )
            }
        })
    })

    $(".sil-resim").click(function (e) {

        var $data_url = $(this).data("url");

        swal({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamayacaksınız!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'Hayır'
        }).then(function (result) {
            if (result.value) {
                swal(
                    window.location.href = $data_url
                )
            }
        })
    })
    $(".sil-video").click(function (e) {

        var $data_url = $(this).data("url");

        swal({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamayacaksınız!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'Hayır'
        }).then(function (result) {
            if (result.value) {
                swal(
                    window.location.href = $data_url
                )
            }
        })
    })

    $(".sil-mail").click(function (e) {

        var $data_url = $(this).data("url");

        swal({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamayacaksınız!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'Hayır'
        }).then(function (result) {
            if (result.value) {
                swal(
                    window.location.href = $data_url
                )
            }
        })
    })

    $(".cevapla").click(function () {
        $(".kapat-mail").hide();
        $(".sil-mail").hide();
        $(".cevapla").hide();
        $(".cevapla-menu").fadeIn(500);
        $(".mail-don").fadeIn(500);
    })
    $(".mail-don").click(function () {
        $(".cevapla-menu").hide();
        $(".sil-mail").fadeIn(500);
        $(".cevapla").fadeIn(500);
        $(".mail-don").hide();
        $(".kapat-mail").fadeIn(500);
    })

});


$('.table-calismalar').sortable({
    update: function () {
        $.ajax({
            url: "sirala_calismalar.php",
            data: $(this).sortable('serialize'),
            type: "POST"
        });
    }
});


$('.table-projeler').sortable({
    update: function () {
        $.ajax({
            url: "sirala_projeler.php",
            data: $(this).sortable('serialize'),
            type: "POST"
        });
    }
});


$('.table-proje-resimler').sortable({
    update: function () {
        $.ajax({
            url: "sirala_resimler.php",
            data: $(this).sortable('serialize'),
            type: "POST"
        });
    }
});

$('.table-proje-videolar').sortable({
    update: function () {
        $.ajax({
            url: "sirala_videolar.php",
            data: $(this).sortable('serialize'),
            type: "POST"
        });
    }
});





