$(document).on('ready', function () {
    $("#resultadoSolicitud").keyup(async function () {
        var valor = $("#resultadoSolicitud").val();
        console.log(valor);
        $(".nombreS").each(function () {
            nombres = $(this).text().toLowerCase();
            if (nombres.indexOf(valor.toLowerCase()) > -1) {
                $(this).parent("tr").show();
            } else {
                $(this).parent("tr").css("display", "none");
            }
        });
    });
});