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
          .addClass('btn-' + color );
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

function recarga(){
  location.reload();
}
$("#entregar").click(function() {
  setTimeout(recarga, 7000);
});

$("#index-table").DataTable();



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
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      $('#logout-form').submit();
    }
  });
});