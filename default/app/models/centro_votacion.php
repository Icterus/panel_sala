<?php


class CentroVotacion extends ActiveRecord {
    protected $logger = true;

    public function listarCentro($municipio, $parroquia){
        $columns = "columns: centro_votacion.id AS centro_id, parroquia.id, centro_nuevo AS Codigo, nombre_centro AS Centro,tipo_psuv AS Tipo, centro_votacion.meta as meta";
        $joins = "join: INNER JOIN parroquia ON parroquia.id_rep = centro_votacion.parroquia_id";
        $conditions = "conditions: centro_votacion.municipio_id = $municipio AND parroquia.id = $parroquia";
        return $this->find($conditions, $columns, $joins);
    }


}

?>