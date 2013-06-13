<?php


class DatosPersonales extends ActiveRecord{

protected $logger = TRUE;

	function buscar($cedula){

	$cedula = Filter::get($cedula,'int');
	 $columns = "columns: datos_personales.id, datos_personales.cedula, datos_personales.nombres, datos_personales.psuv
	 			 datos_personales.apellidos , datos_personales.telefono,informacion.estatus,informacion.voto,
	 			 datos_personales.celular, centro_votacion.id AS centro_id, centro_votacion.nombre_centro as centro_votacion
	 			 militancia.psuv as psuv";

	 $join = "join: LEFT JOIN centro_votacion ON  centro_votacion.id = datos_personales.centro_votacion_id
	 				LEFT JOIN informacion ON datos_personales.id = informacion.datos_personales_id
	 				LEFT JOIN militancia ON datos_personales.id = militancia.datos_personales_id ";
	$resultado = $this->find_first('cedula = '.$cedula, $columns, $join);

	if($resultado){
		return $resultado;

		}else{
			return false;
		}
	}

	public function buscarCentro($id) {
		$columns = "columns: centro_votacion_id AS centro";
		return $this->find_first($id, $columns);
	}

	public function listadoLlamadas($centro, $gmvv){
		$centro = Filter::get($centro, 'int');
		$conditions= "conditions: `centro_votacion_id` = $centro";
		if (!is_null($gmvv)) {
			$gmvv = Filter::get($gmvv, 'int');
			$conditions.= " AND `GMVV` = $gmvv";
		}
		$limit = "limit: 10";
		return $this->find($conditions, $limit);
	}
	public function listadoLlamadasRandom($centro, $gmvv){
		$centro = Filter::get($centro, 'int');
		$columns = "columns: datos_personales.id, datos_personales.nombres, datos_personales.apellidos,
			datos_personales.telefono, datos_personales.celular, informacion.voto";
		$conditions= "conditions: voto is null AND datos_personales.`centro_votacion_id` = $centro";
		if (!is_null($gmvv)) {
			$gmvv = Filter::get($gmvv, 'int');
			$conditions.= " AND `GMVV` = $gmvv";
		}
		$conditions.= " AND (`telefono` != '' OR `celular` != '')";
		$join = "join: LEFT JOIN informacion ON informacion.datos_personales_id = datos_personales.id";
		$order = "order: RAND()";
		$limit = "limit: 10";
		return $this->find($columns, $conditions, $join, $order, $limit);
	}

}


?>