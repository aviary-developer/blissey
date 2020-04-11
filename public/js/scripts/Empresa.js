$(document).on("ready", function () {

    $("#logo_hospital").on("change", function (evt) {

        var files = evt.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    document.getElementById('list').innerHTML = ['<img style="height: 200px; width: 200px; object-fit: contain;" src = "', e.target.result, '"/>'].join("");
                };
            })(f);
            reader.readAsDataURL(f);
        }
    });

    $("#logo_laboratorio").on("change", function (evt) {

        var files = evt.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    document.getElementById('list2').innerHTML = ['<img style="height: 200px; width: 200px; object-fit: contain;" src = "', e.target.result, '"/>'].join("");
                };
            })(f);
            reader.readAsDataURL(f);
        }
    });

    $("#logo_clinica").on("change", function (evt) {

        var files = evt.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    document.getElementById('list3').innerHTML = ['<img style="height: 200px; width: 200px; object-fit: contain;" src = "', e.target.result, '"/>'].join("");
                };
            })(f);
            reader.readAsDataURL(f);
        }
    });

    $("#logo_farmacia").on("change", function (evt) {

        var files = evt.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    document.getElementById('list4').innerHTML = ['<img style="height: 200px; width: 200px; object-fit: contain;" src = "', e.target.result, '"/>'].join("");
                };
            })(f);
            reader.readAsDataURL(f);
        }
		});
		
	$("#logo_imagenes").on("change", function (evt) {

		var files = evt.target.files;

		for (var i = 0, f; f = files[i]; i++) {
			if (!f.type.match('image.*')) {
				continue;
			}

			var reader = new FileReader();

			reader.onload = (function (theFile) {
				return function (e) {
					document.getElementById('list5').innerHTML = ['<img style="height: 200px; width: 200px; object-fit: contain;" src = "', e.target.result, '"/>'].join("");
				};
			})(f);
			reader.readAsDataURL(f);
		}
    });
    
    $("#sello_laboratorio").on("change", function (evt) {

		var files = evt.target.files;

		for (var i = 0, f; f = files[i]; i++) {
			if (!f.type.match('image.*')) {
				continue;
			}

			var reader = new FileReader();

			reader.onload = (function (theFile) {
				return function (e) {
					document.getElementById('list6').innerHTML = ['<img style="height: 200px; width: 200px; object-fit: contain;" src = "', e.target.result, '"/>'].join("");
				};
			})(f);
			reader.readAsDataURL(f);
		}
	});

    $("#agregar_telefono_hospital").on("click", function (e) {
        e.preventDefault();
        agreagar_telefono(0);
    });

    $("#tabla_telefono_hospital").on("click", "#eliminar_telefono", function (e) {
        e.preventDefault();
        $(this).parent('td').parent('tr').remove();
    });

    $("#agregar_telefono_laboratorio").on("click", function (e) {
        e.preventDefault();
        agreagar_telefono(1);
    });

    $("#tabla_telefono_laboratorio").on("click", "#eliminar_telefono", function (e) {
        e.preventDefault();
        $(this).parent('td').parent('tr').remove();
    });

    $("#agregar_telefono_clinica").on("click", function (e) {
        e.preventDefault();
        agreagar_telefono(2);
    });

    $("#tabla_telefono_clinica").on("click", "#eliminar_telefono", function (e) {
        e.preventDefault();
        $(this).parent('td').parent('tr').remove();
    });

    $("#agregar_telefono_farmacia").on("click", function (e) {
        e.preventDefault();
        agreagar_telefono(3);
    });

    $("#tabla_telefono_farmacia").on("click", "#eliminar_telefono", function (e) {
        e.preventDefault();
        $(this).parent('td').parent('tr').remove();
    });

    $("#tabla_telefono_hospital").on("click", "#eliminar_telefono_antiguo", function (e) {
        e.preventDefault();
        var id = $(this).parents('tr').find('input').val();
        $("#telefono_eliminados").val(id);
        $(this).parent('td').parent('tr').remove();
    });

    $("#tabla_telefono_laboratorio").on("click", "#eliminar_telefono_antiguo", function (e) {
        e.preventDefault();
        var id = $(this).parents('tr').find('input').val();
        $("#telefono_eliminados").val(id);
        $(this).parent('td').parent('tr').remove();
    });

    $("#tabla_telefono_clinica").on("click", "#eliminar_telefono_antiguo", function (e) {
        e.preventDefault();
        var id = $(this).parents('tr').find('input').val();
        $("#telefono_eliminados").val(id);
        $(this).parent('td').parent('tr').remove();
    });

    $("#tabla_telefono_farmacia").on("click", "#eliminar_telefono_antiguo", function (e) {
        e.preventDefault();
        var id = $(this).parents('tr').find('input').val();
        $("#telefono_eliminados").val(id);
        $(this).parent('td').parent('tr').remove();
    });

    function agreagar_telefono(tipo) {
        if (tipo == 0) {
            var contenido = $("#telefono_hospital").val();
            var tipo_valor = "hospital";
        } else if (tipo == 1) {
            var contenido = $("#telefono_laboratorio").val();
            var tipo_valor = "laboratorio";
        } else if (tipo == 2) {
            var contenido = $("#telefono_clinica").val();
            var tipo_valor = "clinica";
        } else {
            var contenido = $("#telefono_farmacia").val();
            var tipo_valor = "farmacia";
        }
        var html_texto =
        "<tr>" +
            "<td>" +
                "<input type='hidden' name='telefono[]' value = '" + contenido + "'/>" +
                "<input type='hidden' name='tipo[]' value='"+ tipo_valor + "'/>"+
                contenido +
            "</td>" +
            "<td>" +
                "<button type = 'button' name='button' class='btn btn-danger btn-xs' id='eliminar_telefono'>" +
                    "<i class='fa fa-times'></i>" +
                "</button>" +
            "</td>" +
        "</tr>";
        if (tipo == 0) {
            $("#tabla_telefono_hospital").append(html_texto);
            $("#telefono_hospital").val("");
        } else if (tipo == 1) {
            $("#tabla_telefono_laboratorio").append(html_texto);
            $("#telefono_laboratorio").val("");
        } else if (tipo == 2) {
            $("#tabla_telefono_clinica").append(html_texto);
            $("#telefono_clinica").val("");
        } else {
            $("#tabla_telefono_farmacia").append(html_texto);
            $("#telefono_farmacia").val("");
        }
    }
});