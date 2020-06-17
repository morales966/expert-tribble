$("body").on( "click", ".imagen-credit", function() {
    var imagen = $(this).attr("dataimg");
    $("#img-product").attr('src',imagen);
    $("#modalFoto").modal('show');
});