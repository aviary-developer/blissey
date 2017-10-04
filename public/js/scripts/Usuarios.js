$(document).on('ready',function(){
  var contador = 0;//Este contador es solo para aplicar la mascara
  var wrapper = $('#telefono');

  $('#agregar_telefono').click(function(){
    var html_texto = "<div class = 'input-group'>"+
    "<input type='text' name='telefono[]' class='form-control has-feedback-left' placeholder = 'Ej. 0000-0000' id = 'input"+contador+"'/>"+
    "<span class = 'input-group-btn'>"+
    "<button type = 'button' name='button' class='btn btn-danger' id='eliminar_telefono'>-</button>"+
    "</span>"+
    "</div>";
    $(wrapper).append(html_texto);
    var input = document.getElementById('input'+contador);
    var mask = new Inputmask("9999-9999");
    mask.mask(input);
    input.focus();
    contador++;
  });

  $(wrapper).on('click','#eliminar_telefono',function(e){
    e.preventDefault();
    $(this).parent('span').parent('div').remove();
  });
});
