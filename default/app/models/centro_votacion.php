<?php


class CentroVotacion extends ActiveRecord {
    protected $logger = true;

    public function listarCentro($municipio){
        $columns = "columns: id, cod_centro,centro_nuevo,nombre_centro,tipo_psuv";
        $conditions = "conditions : WHERE municipio_id = $municpio";
        return $this->find($columns,$conditions);
    }

}

?>