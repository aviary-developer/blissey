$(document).on('ready', function () {
	var notificacion_item = null;
  $("#guardarSignoModal").on("click", function (e) {
    $.ajax({
      type: 'post',
      url: $('#guardarruta').val() + '/signos',
      data: {
        temperatura: $("#temperatura").val(),
        pulso: $("#pulso").val(),
        sistole: $("#sistole").val(),
        diastole: $("#diastole").val(),
        peso: $("#peso").val(),
        altura: $("#altura").val(),
        medida: $("#medida").val(),
        glucosa: $("#glucosa").val(),
        frecuencia_respiratoria: $("#frecuencia_respiratoria").val(),
        frecuencia_cardiaca: $("#frecuencia_cardiaca").val(),
        f_ingreso: $("#id").val(),
      },
      success: function (r) {
        if (r == 3) {
          localStorage.setItem('msg', 'yes');
          location.reload();
        } else {
          swal({
            type: 'error',
            toast: true,
            title: '¡Algo salio mal!',
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
          });
        }
      }
    });
  });

  $("#tipo_ingreso").on('change', function () {
    tipo = $("#tipo_ingreso").val();
    console.log(tipo);
    if (tipo == 0 || tipo == 2) {
      document.getElementById('habitacion_form_ingreso').style = "display: block";
      document.getElementById('observaciones_form_ingreso').style = "display: none";
    } else if (tipo == 1 || tipo == 4) {
      document.getElementById('habitacion_form_ingreso').style = "display: none";
      document.getElementById('observaciones_form_ingreso').style = "display: block";
    } else {
      document.getElementById('habitacion_form_ingreso').style = "display: none";
      document.getElementById('observaciones_form_ingreso').style = "display: none";
    }
  });

  $("#evaluar_signo").on("click", function (e) {
    e.preventDefault();
    signos_fecha();
    carga_signos($("#sid").val());
    id = $("#id").val();

    $.ajax({
      type: 'get',
      url: $('#guardarruta').val() + '/signo_lista',
      data: {
        id: id,
      },
      success: function (r) {
        temperatura_ = [];
        fecha_format = [];
        peso_ = [];
        sistole_ = [];
        diastole_ = [];
        pulso_ = [];
        f_cardiaca_ = [];
        f_respiratoria_ = [];
        medida = "Kilogramos";
        $(r).each(function (key, value) {
          temperatura_.push(value.temperatura);
          peso_.push(value.peso);
          sistole_.push(value.sistole);
          diastole_.push(value.diastole);
          pulso_.push(value.pulso);
          f_cardiaca_.push(value.frecuencia_cardiaca);
          f_respiratoria_.push(value.frecuencia_respiratoria);

          fecha = new Date(value.created_at);
          fecha_format.push((fecha.getDate() + " " + mes(fecha.getMonth()) + " " + fecha.getHours() + ":" + fecha.getMinutes()));
          if (!value.medida) {
            medida = "Libra";
          }
        });
        //console.log(temperatura_);
        //Primer grafico
        var canva = $("#temperatura_chart_s");
        var chart = new Chart(canva, {
          type: 'line',
          data: {
            labels: fecha_format,
            datasets: [{
              data: temperatura_,
              label: 'Temperatura',
              lineTension: 0.1,
              backgroundColor: 'rgba(236,112,99,0.5)',
              borderColor: 'rgba(236,112,99)'
            }]
          },
          options: {
            title: {
              display: true,
              position: 'top',
              text: 'Temperatura'
            },
            scales: {
              yAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Celsius'
                },
                ticks: {
                  beginAtZero: true
                }
              }],
              xAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Fecha'
                }
              }]
            }
          }
        });
        //Segunda grafica
        var canva2 = $("#peso_chart_s");
        var chart = new Chart(canva2, {
          type: 'line',
          data: {
            labels: fecha_format,
            datasets: [{
              data: peso_,
              label: 'Peso',
              lineTension: 0.1,
              backgroundColor: 'rgba(165,105,189,0.5)',
              borderColor: 'rgba(165,105,189)'
            }]
          },
          options: {
            title: {
              display: true,
              position: 'top',
              text: 'Peso'
            },
            scales: {
              yAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: medida
                },
                ticks: {
                  beginAtZero: true
                }
              }],
              xAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Fecha'
                }
              }],
              maintainAspectRatio: false
            }
          }
        });
        //Grafica 3
        var canva3 = $("#presion_chart_s");
        var chart = new Chart(canva3, {
          type: 'line',
          data: {
            labels: fecha_format,
            datasets: [
              {
                data: diastole_,
                label: 'Díastole',
                lineTension: 0.1,
                backgroundColor: 'rgba(93,173,226,0.5)',
                borderColor: 'rgba(93,173,226)',
                spanGaps: true
              },
              {
                data: sistole_,
                label: 'Sistole',
                lineTension: 0.1,
                backgroundColor: 'rgba(236,112,99,0.5)',
                borderColor: 'rgba(236,112,99)',
                spanGaps: true
              }
            ]
          },
          options: {
            title: {
              display: true,
              position: 'top',
              text: 'Presión Arterial'
            },
            scales: {
              yAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Mercurio'
                },
                ticks: {
                  beginAtZero: true
                }
              }],
              xAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Fecha'
                }
              }]
            }
          }
        });
        //Grafica 4
        var canva4 = $("#frecuencia_chart_s");
        var chart = new Chart(canva4, {
          type: 'line',
          data: {
            labels: fecha_format,
            datasets: [
              {
                data: pulso_,
                label: 'Pulso',
                lineTension: 0.1,
                backgroundColor: 'rgba(88,214,141,0.3)',
                borderColor: 'rgba(88,214,141)',
                spanGaps: true
              },
              {
                data: f_cardiaca_,
                label: 'Frecuencia Cardiaca',
                lineTension: 0.1,
                backgroundColor: 'rgba(236,112,99,0.4)',
                borderColor: 'rgba(236,112,99)',
                spanGaps: true
              }
            ]
          },
          options: {
            title: {
              display: true,
              position: 'top',
              text: 'Frecuencia Cardiaca y Pulso'
            },
            scales: {
              yAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Latidos por minuto'
                },
                ticks: {
                  beginAtZero: true
                }
              }],
              xAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Fecha'
                }
              }]
            }
          }
        });
        //Grafica 4
        var canva4 = $("#frecuencia2_chart_s");
        var chart = new Chart(canva4, {
          type: 'line',
          data: {
            labels: fecha_format,
            datasets: [
              {
                data: f_respiratoria_,
                label: 'Frecuencia Respiratoria',
                lineTension: 0.1,
                backgroundColor: 'rgba(245,176,65,0.5)',
                borderColor: 'rgba(245,176,65)',
                spanGaps: true
              }
            ]
          },
          options: {
            title: {
              display: true,
              position: 'top',
              text: 'Frecuencia Respiratoria'
            },
            scales: {
              yAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Respiración por minuto'
                },
                ticks: {
                  beginAtZero: true
                }
              }],
              xAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Fecha'
                }
              }]
            }
          }
        });
      }
    });
	});
	
	$("#contenido_noticias").on("click", '#carga_paquete_modal', function (e) { 
		precio_paquete();
		notificacion_item = $(this).parents('.alert');
	});

	$("#contenido_noticias").on("click", '#carga_honorario_modal', function (e) {
		notificacion_item = $(this).parents('.alert');
	});

	$("#tipo_paquete").on('change', function () { 
		precio_paquete();
	});

	$("#paquete_save").click(function (e) { 
		e.preventDefault();
		var fecha = moment(notificacion_item.find("#fecha_paquete_noticias").val(), "DD/MM/YYYY");
		var contador = $("#count_notificaciones").text().trim();
		var precio = parseFloat($("#precio_paquete").val());
		$.ajax({
			type: 'post',
			url: $('#guardarruta').val() + '/servicio/guardar_paquete',
			data: {
				id_servicio: $("#id_paquete").val(),
				id_transaccion: $("#id_t").val(),
				precio: precio,
				fecha: fecha.format('YYYY-MM-DD')
			},
			success: function (r) {
				if (r) {
					$("#paquete_m").modal("hide");
					notificacion_item.remove();
					$("#count_notificaciones").text(--contador);
					console.log(contador);
					if (contador == 0) {
						$("#count_notificaciones").removeClass('badge-danger').addClass('badge-success');
						var html = '<div class="row">' +
							'<div class="alert alert-secondary m-1 p-1 w-100">' +
							'<div class="row">' +
							'<div class="col-1">' +
							'<i class="fas fa-check text-success"></i>' +
							'</div>' +
							'<div class="col-10">' +
							'<span>¡No hay notificaciones pendientes!</span>' +
							'</div>' +
							'</div>' +
							'</div>' +
							'</div>';
						$("#contenido_noticias").append(html);
					}
					var gasto = parseFloat($("#total_gastos").val());
					gasto += precio;
					if ($("#estado_iva").val()) {
						gasto += (precio * 0.13);
					}
					var deuda = parseFloat($("#total_deuda").val());
					deuda += precio;
					if ($("#estado_iva").val()) {
						deuda += (precio * 0.13);
					}
					$("#total_gastos").val(gasto);
					$("#total_deuda").val(deuda);
					$("#total_gastos_label").empty().text("$" + new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(gasto));
					$("#total_deuda_label").empty().text("$ " + new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(deuda));
					swal({
						type: 'success',
						toast: true,
						title: '¡Acción exitosa!',
						position: 'top-end',
						showConfirmButton: false,
						timer: 4000
					});
				} else {
					swal({
						type: 'error',
						toast: true,
						title: '¡Algo salio mal!',
						position: 'top-end',
						showConfirmButton: false,
						timer: 4000
					});
				}
			}
		});
	});

	$("#honorario_save").click(function (e) {
		e.preventDefault();
		var fecha = moment(notificacion_item.find("#fecha_honorario_noticias").val(), "DD/MM/YYYY");
		var contador = $("#count_notificaciones").text().trim();
		var precio = parseFloat($("#precio_honorario").val());
		$.ajax({
			type: 'post',
			url: $('#guardarruta').val() + '/servicio/guardar_honorario',
			data: {
				id_servicio: $("#id_honorario").val(),
				id_transaccion: $("#id_t").val(),
				precio: precio,
				fecha: fecha.format('YYYY-MM-DD')
			},
			success: function (r) {
				if (r) {
					$("#honorario_m").modal("hide");
					notificacion_item.remove();
					$("#count_notificaciones").text(--contador);
					var frec_text = $("#med_frec").text().trim();
					frec_text = frec_text.replace('x', ' ');
					var frec = parseInt(frec_text.trim()) + 1;
					$("#med_frec").text(frec);
					if (contador == 0) {
						$("#count_notificaciones").removeClass('badge-danger').addClass('badge-success');
						var html = '<div class="row">' +
							'<div class="alert alert-secondary m-1 p-1 w-100">' +
							'<div class="row">' +
							'<div class="col-1">' +
							'<i class="fas fa-check text-success"></i>' +
							'</div>' +
							'<div class="col-10">' +
							'<span>¡No hay notificaciones pendientes!</span>' +
							'</div>' +
							'</div>' +
							'</div>' +
							'</div>';
						$("#contenido_noticias").append(html);
					}
					var gasto = parseFloat($("#total_gastos").val());
					gasto += precio;
					if($("#estado_iva").val()){
						gasto += (precio * 0.13);
					}
					var deuda = parseFloat($("#total_deuda").val());
					deuda += precio;
					if($("#estado_iva").val()){
						deuda += (precio * 0.13);
					}
					$("#total_gastos").val(gasto);
					$("#total_deuda").val(deuda);
					$("#total_gastos_label").empty().text("$" + new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(gasto));
					$("#total_deuda_label").empty().text("$ " + new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(deuda));
					swal({
						type: 'success',
						toast: true,
						title: '¡Acción exitosa!',
						position: 'top-end',
						showConfirmButton: false,
						timer: 4000
					});
				} else {
					swal({
						type: 'error',
						toast: true,
						title: '¡Algo salio mal!',
						position: 'top-end',
						showConfirmButton: false,
						timer: 4000
					});
				}
			}
		});
	});

	function precio_paquete() {
		var tipo = $("#tipo_paquete").val();
		var precio = $("#precio_paquete");
		var id = $("#id_paquete");

		$.ajax({
			type: 'get',
			url: $('#guardarruta').val() + '/servicio/precio_paquete',
			data: { id: tipo },
			success: function (r) {
				precio.val(r.precio);
				id.val(r.id);
			}
		});
	}

  /**Invocación del grafico financiero */
  // chart_fin();

  /**Función para dibujar el grafico financiero */
  // async function chart_fin() {
  //   var tipo_u = $("#tipo_usuario").val();
  //   var id = $("#id").val();
  //   var consulta = $("#precio_consulta").val();
  //   console.log("Hola Mary");
  //   if (tipo_u == "Recepción" && consulta == null) {
  //     await $.ajax({
  //       type: 'get',
  //       url: $('#guardarruta').val() + '/chart_financiero',
  //       data: {
  //         id: id,
  //       },
  //       success: function (r) {
  //         var monto = [];
  //         var abono = [];
  //         var fecha_format = [];
  //         $(r.monto).each(function (key, value) {
  //           monto.push(new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(value));
  //           abono.push(new Intl.NumberFormat('en-US', { style: "decimal", minimumFractionDigits: 2 }).format(r.abonos[key]));
  //           fecha = new Date(r.fecha[key]);
  //           fecha_format.push((fecha.getDate() + " " + mes(fecha.getMonth())));
  //         });

  //         var canva = $("#chart_financiero");
  //         console.log("Antes de graficar");
  //         var chart = new Chart(canva, {
  //           type: 'line',
  //           data: {
  //             labels: fecha_format,
  //             datasets: [
  //               {
  //                 data: monto,
  //                 label: 'Gastos',
  //                 lineTension: 0.1,
  //                 borderColor: 'rgba(236,112,99)',
  //               },
  //               {
  //                 data: abono,
  //                 label: 'Abono',
  //                 lineTension: 0.1,
  //                 borderColor: 'rgba(88,214,141)',
  //               }
  //             ]
  //           },
  //           options: {
  //             scales: {
  //               yAxes: [{
  //                 display: true,
  //                 ticks: {
  //                   beginAtZero: false,
  //                 },
  //                 scaleLabel: {
  //                   display: true,
  //                   labelString: 'Dolares'
  //                 },
  //                 ticks: {
  //                   beginAtZero: true
  //                 }
  //               }],
  //               xAxes: [{
  //                 display: true,
  //                 scaleLabel: {
  //                   display: true,
  //                   labelString: 'Fecha'
  //                 }
  //               }]
  //             }
  //           }
  //         });
  //         console.log("despues");
  //       }
  //     });
  //   }
  // }

  function mes(x) {
    if (x == 0) {
      return "Enero";
    } else if (x == 1) {
      return "Febrero";
    } else if (x == 2) {
      return "Marzo";
    } else if (x == "3") {
      return "Abril";
    } else if (x == 4) {
      return "Mayo";
    } else if (x == 5) {
      return "Junio";
    } else if (x == 6) {
      return "Julio";
    } else if (x == 7) {
      return "Agosto";
    } else if (x == 8) {
      return "Septiembre";
    } else if (x == 9) {
      return "Octubre";
    } else if (x == 10) {
      return "Noviembre";
    } else {
      return "Diciembre";
    }
  }
});

$("#ver_servicios").on('shown.bs.modal', function () {
	$(document).off('focusin.modal');
});
$("#ver_productos").on('shown.bs.modal', function () {
	$(document).off('focusin.modal');
});
$("#ver_medico").on('shown.bs.modal', function () {
	$(document).off('focusin.modal');
});