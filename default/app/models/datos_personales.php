<?php


class DatosPersonales extends ActiveRecord{



	function buscar($cedula){
		$cedula = Filter::get($cedula,'int');
		return $this->find_first('cedula = '.$cedula);

	}

}


?>