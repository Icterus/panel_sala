<?php

class ReportesCentroVotacion extends ActiveRecord {
    protected $logger = true;

    public function reportar($reporte, $centro, $maduro, $capriles){
        $this->id_reporte = $reporte;
        $this->id_centro_votacion = $centro;
        $this->maduro = $maduro;
        $this->capriles = $capriles;
        if ( $this->create() )
            return true;
        else
            return false;
    }

    public function consultar_reportes($municipio, $parroquia){
            $sql = "SELECT
            `reportes_centro_votacion`.`id`,
            `reportes_centro_votacion`.`id_reporte`,
            `reportes_centro_votacion`.`id_centro_votacion`,
            `centro_votacion`.`municipio_id`,
            `centro_votacion`.`parroquia_id`
            FROM `psuv_panel`.`reportes_centro_votacion`
            LEFT JOIN centro_votacion ON centro_votacion.id=reportes_centro_votacion.id_centro_votacion
            where `reportes_centro_votacion`.`id_reporte` NOT IN (SELECT
            `reportes`.`id`
            FROM `psuv_panel`.`reportes` WHERE `centro_votacion`.`municipio_id`=$municipio
            AND `centro_votacion`.`parroquia_id`=$parroquia  AND `reportes`.`id`!=`reportes_centro_votacion`.`id_reporte`)";
            return $this->find_all_by_sql($sql);
    }
}

?>