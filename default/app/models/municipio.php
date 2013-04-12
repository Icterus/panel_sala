<?php


class Municipio extends ActiveRecord {
    protected $logger = true;


    public function listarMunicipio(){
        $columns = "columns: id, municipio , meta";
        return $this->find($columns);
    }


}

?>