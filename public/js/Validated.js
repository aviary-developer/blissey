class Validated {
  constructor(name) {
    this.name = name;

    this.rq = true; //Bandera requerido
    this.mn = true; //Bandera mínimo
    this.mx = true; //Bandera máximo
    this.un = true; //Bandera único

    this.val_min = null;
    this.val_max = null;
    this.val_table = null;
    this.val_column = null;
  }

  required() {
    var object = $("#" + this.name);
    if (object.val().length == 0) {
      this.rq = false;
    }
  }

  min(length) {
    this.val_min = length;
    var object = $("#" + this.name);
    if (object.val().length < length) {
      this.mn = false;
    }
  }

  max(length) {
    this.val_max = length;
    var object = $("#" + this.name);
    if (object.val().length > length) {
      this.mx = false;
    }
  }

  async unique(table, column) {
    this.val_table = table;
    this.val_column = column;
    var object = $("#" + this.name);

    var method = $("#method").val();

    var data = { tabla: table, campo: column, valor: object.val() };

    var helper = true;

    if (method == "create") {
      await $.ajax({
        type: 'get',
        url: $('#guardarruta').val() + '/validate',
        data: data,
        success: function (e) {
          if (e != 0) {
            helper = false;
          } else {
            helper = true;
          }
        }
      });
    }

    this.un = helper;
  }

  value(flag) {
    var object = $("#" + this.name);
    object.parent().find('.invalid-feedback').remove();

    if (this.rq && this.mn && this.mx && this.un) {
      object.removeClass('is-invalid');
      return (flag) ? true : false;
    } else {
      var label = "";
      var html = "";
      label = object.parents('.form-group').find('label').text();
      if (label.substr(-1, 1) == '*') {
        label = label.substr(0, label.length - 1);
      }
      object.parent().append('<div class="invalid-feedback"></div>');

      if (!this.mx) {
        html = 'El campo <b class="text-uppercase">' + label + '</b> debe ser menor a ' + this.val_max + ' caracteres.';
      }
      if (!this.un) {
        html = 'El campo <b class="text-uppercase">' + label + '</b> debe ser único. Ya existe un registro con ese valor';
      }
      if (!this.mn) {
        html = 'El campo <b class="text-uppercase">' + label + '</b> debe ser mayor a ' + this.val_min + ' caracteres.';
      }
      if (!this.rq) {
        html = 'El campo <b class="text-uppercase">' + label + '</b> es obligatorio.';
      }

      object.parent().find('.invalid-feedback').html(html);
      object.addClass('is-invalid');

      var valor_maximo = this.val_max;
      var valor_minimo = this.val_min;
      var columna = this.val_column;
      var tabla = this.val_table;

      object.on('keyup', async function () {
        var string_length = $(this).val().length;
        var object = $(this);

        valor_maximo = (valor_maximo != null) ? valor_maximo : 999999;
        valor_minimo = (valor_minimo != null) ? valor_minimo : 0;

        if (string_length == 0) {
          html = 'El campo <b class="text-uppercase">' + label + '</b> es obligatorio.';

          object.parent().find('.invalid-feedback').html(html);
          object.addClass('is-invalid');
        } else if (string_length < valor_minimo) {
          html = 'El campo <b class="text-uppercase">' + label + '</b> debe ser mayor a ' + valor_minimo + ' caracteres.';

          object.parent().find('.invalid-feedback').html(html);
          object.addClass('is-invalid');
        } else if (string_length > valor_maximo) {
          html = 'El campo <b class="text-uppercase">' + label + '</b> debe ser menor a ' + valor_maximo + ' caracteres.';

          object.parent().find('.invalid-feedback').html(html);
          object.addClass('is-invalid');
        } else {
          if (columna != null && tabla != null) {
            var helper;
            var data = { tabla: tabla, campo: columna, valor: object.val() };

            await $.ajax({
              type: 'get',
              url: '/validate',
              data: data,
              success: function (e) {
                if (e != 0) {
                  helper = false;
                } else {
                  helper = true;
                }
              }
            });

            if (!helper) {
              html = 'El campo <b class="text-uppercase">' + label + '</b> debe ser único. Ya existe un registro con ese valor';

              object.parent().find('.invalid-feedback').html(html);
              object.addClass('is-invalid');
            } else {
              object.removeClass('is-invalid');
            }
          } else {
            object.removeClass('is-invalid');
          }
        }
      });

      return false;
    }
  }
}