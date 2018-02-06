$(document).on("ready", function () {
  $("#accordion").on("click", "#activar", function (e) {
    e.preventDefault();
    var id = $(this).parents('tr').find("input:eq(0)").val();
    var examen = $(this).parents('tr').find("input:eq(1)").val();
    var celda = $(this).parents('tr').find("td:eq(2)");
    var tooltip = $(".tooltip-inner").parent('div');
    var html =
      '<a id="evaluar" href="evaluarExamen/'+id+'/'+ examen +'" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Evaluar" >' +
        '<i class="fa fa-paste"></i>' +
      '</a >';
    $.ajax({
      type: "GET",
      url: "/blissey/public/aceptarSolicitudExamen/" + id,
      dataType: 'json',
      success: function (respuesta) {
        if (respuesta == 1) {
          celda.empty();
          celda.append(html);
          $("#evaluar").tooltip();
          tooltip.remove();
        }
      }
    });
  });

  $("#accordion").on("click", "#eliminar", function (e) { 
    var id = $(this).parents('tr').find("input:eq(0)").val();
    var fila = $(this).parents('tr');
    var tooltip = $(".tooltip-inner").parent('div');
    var panel = $(this).parents('td').parents('tr').parents('table').parent('div').parent('div').parent('div');
    console.log(panel);
    return swal({
      title: 'Eliminar registro',
      text: '¿Está seguro? ¡El registro no podrá ser recuperado!',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, ¡Eliminar!',
      cancelButtonText: 'No, ¡Cancelar!',
      confirmButtonClass: 'btn btn-danger',
      cancelButtonClass: 'btn btn-default',
      buttonsStyling: false
    }).then(function () {
      $.ajax({
        type: "GET",
        url: "/blissey/public/destroySolicitudExamen/" + id,
        dataType: 'json',
        success: function (respuesta) {
          fila.remove();
          tooltip.remove();
          if (respuesta == 0) {
            panel.remove();
          }
          swal({
            title: '¡Eliminado!',
            text: 'Acción realizada satisfactorimente',
            type: 'success',
            showCancelButton: false,
            showConfirmButton: false
          })
        }
      });
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal(
          'Cancelado',
          'El registro se mantiene',
          'info'
        )
      }
    });
  });
});