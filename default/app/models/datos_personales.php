<?php


class DatosPersonales extends ActiveRecord{



	function buscar(){

		return $this->find_first();

	}

}


?>