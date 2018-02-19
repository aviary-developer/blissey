$(document).on('ready', function () {
  var ubicacion = window.location.pathname;

  if (ubicacion.indexOf("/blissey/public/ingresos/create") > -1){
    cargar_municipio();
  }

  function cargar_municipio() {
    var v_departamento = $("#departamento_select").val();
    var municipio_select = $("#municipio_select");
    var editado = $("#municipio_edit").val();

    $.ajax({
      type: "GET",
      url: "/blissey/public/municipios/" + v_departamento,
      success: function (respuesta) {
        municipio_select.empty();
        $(respuesta).each(function (key, value) {
          if (editado == value) {
            municipio_select.append("<option value='" + value + "' selected>" + value + "</option>");
          } else {
            municipio_select.append("<option value='" + value + "'>" + value + "</option>");
          }
        });
      }
    });
  }

  $("#busqueda").keyup(function(){
    var valor = $("#busqueda").val();
    var v_tipo = $("#seleccion").val();
    if(valor.length > 2){
      var tabla = $("#tablaPaciente");
      $.ajax({
        url: "/blissey/public/buscarPersonas",
        type: "GET",
        data: {
          nombre: valor,
          tipo: v_tipo
        },
        success: function (res){
          tabla.empty();
          head =
            "<thead>" +
            "<th>Nombre</th>" +
            "<th style='width : 80px'>Acción</th>" +
            "</thead>";
          tabla.append(head);
          $(res).each(function (key, value) {
            html =
              "<tr>" +
              "<td>" +
              value.apellido + ', ' + value.nombre +
              "</td>" +
              "<td>" +
              "<input type='hidden' name='nombre_paciente[]' value ='" + value.apellido + ', ' + value.nombre + "'>" +
              "<input type='hidden' name='id_paciente[]' value ='" + value.id + "'>" +
              "<button type='button' class='btn btn-xs btn-primary' id='agregar_paciente' data-dismiss='modal'>" +
              "<i class='fa fa-check'></i>" +
              "</button>" +
              "</td>" +
              "</tr>";
            tabla.append(html);
          });
        }
      });
    }
  });

  $('#tablaPaciente').on('click','#agregar_paciente',function(e){
    e.preventDefault();
    var nombre = $(this).parents('tr').find('input:eq(0)').val();
    var id = $(this).parents('tr').find('input:eq(1)').val();
    var opcion = $("#seleccion").val();
    var tabla = $("#tablaPaciente");
    if(opcion == "paciente" || opcion == "solicitud")
    {
      var input_nombre = $("#n_paciente");
      var input_id = $("#f_paciente");
    }else{
      var input_nombre = $("#n_responsable");
      var input_id = $("#f_responsable");
    }
    input_nombre.val(nombre);
    input_id.val(id);

    $("#busqueda").val("");
    tabla.empty();
    head =
    "<thead>"+
    "<th>Nombre</th>"+
    "<th style='width : 80px'>Acción</th>"+
    "</thead>";
    tabla.append(head);

    $("#modal").modal('hide');
  });

  $("#guardarPaciente").on('click', function (e) {
    e.preventDefault();

    var v_nombre = $("#nombre_paciente").val();
    var v_apellido = $("#apellido_paciente").val();
    var v_sexo = $("#sexo").val();
    var v_fecha = $("#fecha_paciente").val();
    var v_dui = $("#dui_paciente").val();
    var v_telefono = $("#telefono_paciente").val();
    var v_pais = $("#pais_paciente").val();
    var v_departamento = $("#departamento_select").val();
    var v_municipio = $("#municipio_select").val();
    var v_direccion = $("#direccion_paciente").val();
    var token = $("#tokenPaciente").val();

    if (v_nombre == "" || v_apellido == "") {
      swal('¡Error!', 'El nombre y apellido son obligatorios, intentelo de nuevo', 'error');
    } else {
      var opcion = $("#seleccion").val();
      if (opcion == "paciente") {
        var input_nombre = $("#n_paciente");
        var input_id = $("#f_paciente");
      } else {
        var input_nombre = $("#n_responsable");
        var input_id = $("#f_responsable");
      }
  
      $.ajax({
        type: "POST",
        url: "/blissey/public/guardar_paciente",
        headers: { 'X-CSRF-TOKEN': token },
        data: {
          nombre: v_nombre,
          apellido: v_apellido,
          sexo: v_sexo,
          fechaNacimiento: v_fecha,
          dui: v_dui,
          telefono: v_telefono,
          pais: v_pais,
          departamento: v_departamento,
          municipio: v_municipio,
          direccion: v_direccion
        },
        success: function (respuesta) {
          if (respuesta != false) {
            input_id.val(respuesta.id);
            input_nombre.val(respuesta.apellido + ", " + respuesta.nombre);
            return swal('¡Hecho!', 'Persona guardada', 'success');
          } else {
            return swal('¡Algo salio mal!', 'No se almaceno la información', 'error');
          }
        },
        error: function () {
          swal('¡Aviso!', 'El registro no fue agregado, intentelo de nuevo', 'warning');
        }
  
      });

      $("#nombre_paciente").val("");
      $("#apellido_paciente").val("");
      $("#dui_paciente").val("");
      $("#telefono_paciente").val("");
      $("#pais_paciente").val("");
      $("#departamento_select").val("San Vicente");
      cargar_municipio();
      $("#direccion_paciente").val("");
      $("#modal_persona").modal("hide");
    }


  });

  $("#c_responsable").on('click', function () {
    if (this.checked == true) {
      document.getElementById("responsable_div").style = "display: block";
    } else {
      document.getElementById("responsable_div").style = "display: none";
    }
  });

  $("#guardarSolicitudModal").on("click", function (e) {
    e.preventDefault();
    var token = $("#tokenSolicitudModal").val();
    var examen = $("input[name='examen[]']").serializeArray();
    var paciente = $("#f_paciente").val();
    var id = $("#id").val();
    var concat = [];
    $(examen).each(function (key, value) {
      concat.push(value.value);
    });
    if (concat.length > 0) {
      $.ajax({
        url: "/blissey/public/solicitudex",
        headers: { 'X-CSRF-TOKEN': token },
        type: "POST",
        data: {
          f_paciente: paciente,
          examen: concat,
          f_ingreso: id
        },
        success: function (respuesta) {
          console.log(respuesta);
          if (respuesta) {
            swal("¡Hecho!", "Solicitud enviada satisfactoriamente", "success");
            location.reload();
          }
        }
      });
    } else {
      swal("¡Error!","Se debe seleccionar al menos un examen","error");
    }
  });
});
