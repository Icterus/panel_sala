<?php


class Municipio extends ActiveRecord {
    protected $logger = true;


    public function listarMunicipio(){
        $columns = "columns: id, municipio";
        return $this->find($columns);
    }


}

?>