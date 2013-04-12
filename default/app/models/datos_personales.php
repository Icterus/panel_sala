<?php


class DatosPersonales extends ActiveRecord{

protected $logger = TRUE;

	function buscar($cedula){

		$cedula = Filter::get($cedula,'int');
		 $columns = "columns:  datos_personales.cedula, datos_personales.nombres,
		 			 datos_personales.apellidos , datos_personales.telefono,informacion.estatus,
		 			 datos_personales.celular,centro_votacion.nombre_centro as centro_votacion";

		 $join = "join: LEFT JOIN centro_votacion ON  centro_votacion.id = datos_personales.centro_votacion_id
		 				LEFT JOIN informacion ON datos_personales.id = informacion.datos_personales_id";
		$resultado = $this->find_first('cedula = '.$cedula,$columns, $join);

		if($resultado){
			return $resultado;

			}else{
				return false;
			}
		}
}


?>