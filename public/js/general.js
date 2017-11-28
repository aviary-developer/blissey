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
});