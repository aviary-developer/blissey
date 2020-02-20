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
			$desc = "Diferentes formas en las que puede presentarse un medicamento.";
		}else if($tipo == "estantes"){
			$titulo = "Estantes";
			$desc = "Repisas donde se ubican medicamentos y otros insumos.";
		}else if($tipo == "unidades"){
			$titulo = "Unidades de medida";
			$desc = "Cantidades estandarizadas de una determinada magnitud.";
		}else if($tipo == "categoriaproductos"){
			$titulo = "Categoría de productos";
			$desc = "Tipos de medicamento que pueden encontrarse en botiquín o en farmacia.";
		}else if($tipo == "proveedores"){
			$titulo = "Proveedores";
			$desc = "Abastecen de insumos y medicamentos al área hospitalaria y farmacia.";
		}else if($tipo == "cajas"){
			$titulo = "Cajas";
			$desc = "Sobre estas se efecturán todas las trasacciones que involucren salida o entrada de efectivo.";
		}else if($tipo == "especialidades"){
			$titulo = "Especialidades médicas";
			$desc = "Conocimientos médicos especializados referidos a un área específica.";
		}else if($tipo == "divisiones"){
			$titulo = "Divisiones";
			$desc = "Hace referencia a la forma en que se encuentra empacados los productos.";
		}else if($tipo == "usuarios"){
			$titulo = "Usuarios";
			$desc = "Personas que hace uso del sistema.";
		}else if($tipo == "visitadores"){
			$titulo = "Visitadores";
			$desc = "Son los representantes asignados por los proveedores para realizar transacciones sobre insumos y medicamentos.";
		}else if($tipo == "clientes"){
			$titulo = "Clientes";
			$desc = "Personas registradas dentro del sistema, que realizan compras en farmacia.";
		}else if($tipo == "pacientes"){
			$titulo = "Pacientes";
			$desc = "Personas registradas dentro del sistema, que reciben servicios médicos.";
		}else if($tipo == "tac"){
			$titulo = "Tomografía Axial Computarizada";
			$desc = "Tipos de Tomografías que realiza la institución.";
		}else if($tipo == "ultra"){
			$titulo = "Ultrasonografía";
			$desc = "Tipos de Ultrasonografía que realiza la institución.";
		}else if($tipo == "rayos"){
			$titulo = "Rayos X";
			$desc = "Tipos de Radiografías que realiza la institución.";
		}else if($tipo == "secciones"){
			$titulo = "Secciones";
			$desc = "Tipos de secciones.";
		}else if($tipo == "muestras"){
			$titulo = "Muestras clínicas";
			$desc = "Tipos de muestras que se reciben para realizar exámenes clínicos.";
		}else if($tipo == "banco"){
			$titulo = "Banco de sangre";
			$desc = "Registro de unidades sanguíneas con las que cuenta.";
		}else if($tipo == "parametros"){
			$titulo = "Parámetros";
			$desc = "Valores a evaluar dentro de los exámenes clínicos.";
		}else if($tipo == "servicios"){
			$titulo = "Servicios";
			$desc = "Funciones brindadas a los pacientes dentro del hospital";
		}else if($tipo == "categoriass"){
			$titulo = "Categoría de Servicios";
			$desc = "Las distintas categorías donde puede ser registrado un servicio";
		}else if($tipo == "habitaciones"){
			$titulo = "Habitaciones";
			$desc = "Conjunto formado por el espacio, el mobiliario y el material que utiliza el paciente durante su estancia en el hospital.";
		}else{
			$titulo = "General";
			$desc = "La mayoría de los elementos del sistema Blissey hacen uso de esta lógica, puedes usar estos ejemplos para guiarte, si no te ayudan en tu problema, consulta la ayuda específica.";
		}
		$r = [];
		$r[0] = $titulo;
		$r[1] = $desc;
		return $r;
	}
}
