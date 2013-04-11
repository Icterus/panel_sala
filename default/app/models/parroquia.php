<?php


class Parroquia extends ActiveRecord {
    protected $logger = true;


    public function listarParroquia($municipio){
        $columns = "columns: id, parroquia";
        $conditions = "conditions: municipio_id = $municipio";
        return $this->find($columns, $conditions);
	}

}

?>