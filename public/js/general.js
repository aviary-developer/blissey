$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(function () {
  $('.button-checkbox').each(function () {
    var $widget = $(this),
      $button = $widget.find('button'),
      $checkbox = $widget.find('input:checkbox'),
      color = $button.data('color');

    $button.on('click', function () {
      $checkbox.prop('checked', !$checkbox.is(':checked'));
      $checkbox.triggerHandler('change');
      updateDisplay();
    });

    $checkbox.on('change', function () {
      updateDisplay();
    });

    function updateDisplay() {
      var isChecked = $checkbox.is(':checked');

      $button.data('state', (isChecked) ? "on" : "off");

      if (isChecked) {
        $button
          .removeClass('btn-defualt')
          .addClass('btn-' + color);
      } else {
        $button
          .removeClass('btn-' + color)
          .addClass('btn-defualt');
      }
    }

    function init() {
      updateDisplay();
    }
    init();
  });

  $(".checkbox-img").each(function () {
    var option = $(this);
    var $checkbox = option.find('input:checkbox');
    var image = option.find('img');

    $(image).on("click", function () {

      $checkbox.prop('checked', !$checkbox.is(':checked'));
      $checkbox.triggerHandler('change');
      updateDisplay();
    });

    $($checkbox).on("change", function () {
      updateDisplay();
    });

    function initial() {
      updateDisplay();
    }

    function updateDisplay() {
      var isChecked = $checkbox.is(':checked');

      if (isChecked) {
        option.append('<i class="fa fa-check-circle green checkbox-check" style="background: white; border-radius: 20px;"></i>');
      } else {
        option.find('i').remove();
      }
    }
    initial();
  });
});

$('#radioBtn a').on('click', function () {
  var sel = $(this).data('title');
  var tog = $(this).data('toggle');
  $('#' + tog).prop('value', sel);

  $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
  $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
});

function recarga() {
  location.reload();
}
$("#entregar").click(function () {
  setTimeout(recarga, 3000);
});

$(".index-table").DataTable();



$(".modal").on('shown.bs.modal', function () {
  $(this).find("input:visible:first").focus();
});

$(document).on('ready', function () {
  setTimeout(function () {
    $("#mout").fadeOut(1500);
  }, 3000);
});

$(document).on('ready', function () {
  if (localStorage.getItem('msg') == 'yes') {
    swal({
      type: 'success',
      toast: true,
      title: '¡Acción exitosa!',
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000
    });

    localStorage.removeItem('msg');
  }
});

$("#blissey-out").click(function (e) {
  e.preventDefault();

  swal({
    title: 'Salir del sistema',
    text: '¿Está seguro que desea salir del sistema?',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si, ¡Salir!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      $('#logout-form').submit();
    }
  });
});

function validate(value, id, type = null, amount = 0, campo = null) {
  var object = $('#' + id);
  var label = object.parents('.form-group').find('label').text();
  label = label.substr(0, label.length - 1);
  var html;
  if (type == 'uni') {
    if (object.val().length > 0) {
      html = 'El campo <b class="text-uppercase">' + label + '</b> debe ser único.';

      var result = $.get($('#guardarruta').val() + '/validate', { tabla: amount, campo: campo, valor: object.val() });

      if (result != 0) {
        object.addClass('is-invalid');
        object.parent().find('.invalid-feedback').html(html);
        return false;
      }
    }
  } else if (type == 'min') {
    html = 'El campo <b class="text-uppercase">' + label + '</b> debe ser mayor a ' + amount + ' caracteres.';
    if (object.val().length < amount) {
      object.addClass('is-invalid');
      object.parent().find('.invalid-feedback').html(html);
      return false;
    }
  } else if (type == 'max') {
    html = 'El campo <b class="text-uppercase">' + label + '</b> debe ser menor a ' + amount + ' caracteres.';
    if (object.val().length > amount) {
      object.addClass('is-invalid');
      object.parent().find('.invalid-feedback').html(html);
      return false;
    }
  } else {
    html = 'El campo <b class="text-uppercase">' + label + '</b> es obligatorio.';
    if (object.val().length == 0) {
      object.addClass('is-invalid');
      object.parent().find('.invalid-feedback').html(html);
      return false;
    }
  }
  if (value) {
    object.removeClass('is-invalid');
    return true;
  } else {
    return false;
  }
}
function notaError(sms) {
  swal({
    type: 'error',
    toast: true,
    title: '¡Error!',
    text: sms,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
  });
}
function notaNotice(sms) {
  swal({
    type: 'success',
    toast: true,
    title: '¡Hecho!',
    text: sms,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
  });
}
function notaInfo(sms) {
  swal({
    type: 'info',
    toast: true,
    title: '¡Hecho!',
    text: sms,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
  });
}
function ruta() { //No tocar es para ver la ruta
  var dominio = window.location.host;
  var protocolo = window.location.protocol;
  if (dominio == "localhost" || dominio == "127.0.0.1") {
    $('#guardarruta').val(protocolo + "//" + "localhost/blissey/public");
  } else {
    $('#guardarruta').val(protocolo + "//" + dominio + "/blissey/public");
  }
  console.log($('#guardarruta').val());
}
$(document).on('ready', function () {
  ruta();
});

function calculate_age(birth_year, birth_month, birth_day) {
  today_date = new Date();
  today_year = today_date.getFullYear();
  today_month = today_date.getMonth();
  today_day = today_date.getDate();
  age = today_year - birth_year;

  if (today_month < (birth_month - 1)) {
    age--;
  }
  if (((birth_month - 1) == today_month) && (today_day < birth_day)) {
    age--;
  }
  return age;
}