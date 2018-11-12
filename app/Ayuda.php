<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ayuda extends Model
{
  public static function mensaje($tipo){
		$titulo = null;
		$desc = null;
		if($tipo == 'componentes'){
			$titulo = "Componentes";
			$desc = "Elemento que indica la comoposición activa de un producto. Así como los elementos con los que ha sido elaborado.";
		}else if($tipo == "presentaciones"){
			$titulo = "Presentaciones";
			$desc = "Almacena las diferentes formas en las que puede venir un medicamento.";
		}
		else{
			$titulo = "General";
			$desc = "La mayoria de los elementos del sistema Blissey hacen uso de esta lógica, puedes usar estos ejemplos para guiarte, si no te ayudan en tu problema, consulta la ayuda específica.";
		}
		$r = [];
		$r[0] = $titulo;
		$r[1] = $desc;
		return $r;
	}
}
