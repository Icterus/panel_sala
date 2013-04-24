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
            AND `centro_votacion`.`parroquia_id`=$parroquia  AND `reportes`.`id`!=`reportes_centro_votacion`.`id_reporte`)
            ORDER BY `id_centro_votacion` ASC, id_reporte DESC";
            return $this->find_all_by_sql($sql);
    }


    public function votos_centro($municipio , $parroquia){

        $sql = "SELECT
                        null as id,
                        `centro_votacion`.`centro_nuevo` as codigo,
                        `centro_votacion`.`nombre_centro` as nombre,
                            count(`informacion`.`voto`) as votos
                        FROM `psuv_panel`.`centro_votacion`
                        LEFT JOIN `psuv_panel`.`parroquia`
                        ON `parroquia`.`municipio_id` = `centro_votacion`.`municipio_id` 
                               AND `parroquia`.`id_rep` = `centro_votacion`.`parroquia_id`
                        LEFT JOIN  `psuv_panel`.`informacion`
                        ON `informacion`.`centro_votacion_id` = `centro_votacion`.`id`
                        WHERE `centro_votacion`.`municipio_id` = $municipio  AND `parroquia`.`id` = $parroquia
                            GROUP BY `centro_votacion`.`cod_centro`";
                                return $this->find_all_by_sql($sql);


    }



        public function votos_municipio($municipio){

        $sql = "SELECT 
                        municipio.id,
                        municipio.municipio as municipio,
                        municipio.meta as meta,
                        count(informacion.voto) as votos
                    FROM
                        psuv_panel.informacion
                            LEFT JOIN
                        centro_votacion ON informacion.centro_votacion_id = centro_votacion.id
                            LEFT JOIN
                        municipio ON centro_votacion.municipio_id = municipio.id
                    GROUP BY municipio.id";
                                return $this->find_all_by_sql($sql);


    }


        public function votos_parroquia($municipio){

        $sql = "SELECT
                        null as id,
                        `centro_votacion`.`centro_nuevo` as codigo,
                        `centro_votacion`.`nombre_centro` as nombre,
                            count(`informacion`.`voto`) as votos
                        FROM `psuv_panel`.`centro_votacion`
                        LEFT JOIN `psuv_panel`.`parroquia`
                        ON `parroquia`.`municipio_id` = `centro_votacion`.`municipio_id` 
                               AND `parroquia`.`id_rep` = `centro_votacion`.`parroquia_id`
                        LEFT JOIN  `psuv_panel`.`informacion`
                        ON `informacion`.`centro_votacion_id` = `centro_votacion`.`id`
                        WHERE `centro_votacion`.`municipio_id` = $municipio 
                            GROUP BY `centro_votacion`.`municipio_id`";
                                return $this->find_all_by_sql($sql);


    }
}

?>