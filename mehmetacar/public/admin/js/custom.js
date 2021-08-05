// @section(scriptler) KISMININ ÜSTÜNDEKİ CUSTOMMMM!!!!!


$("#kapakcheck").change(function () {
    if (this.checked) {
        $('#myModal').modal();
    } else {
        $('.hidden-image-data').val("");
        $('.cropit-preview-image').attr("src", "");
        $('#kapakshow').attr("src");
        $('#kapakshow').attr("width", 1);
    }
});

$(function () {
    $('#kapakok').prop('disabled', true);
    $('.image-editor').cropit();
    $('#kapakform').submit(function () {
        var imageData = $('.image-editor').cropit('export');
        $('.hidden-image-data').val(imageData);
        $('#kapakshow').attr("src", imageData);
        $('#kapakshow').attr("width", 150);
        $('#kapakok').prop('disabled', false);
        return false;
    });
});

