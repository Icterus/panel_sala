<?php


class CentroVotacion extends ActiveRecord {
    protected $logger = true;



    public function listarCentro($municipio){
        $columns = "columns: id, cod_centro,centro_nuevo,nombre_centro,tipo_psuv";
        $conditions = "conditions : municipio_id = $municipio";
        return $this->find($columns,$conditions);
    }

}

?>