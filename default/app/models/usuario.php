<?php


class Usuario extends ActiveRecord {
    protected $logger = true;
    const ACTIVO = 1;
    const INACTIVO = 0;

    public function listarUsuarios(){
        $columns = "columns: id, usuario, nivel, estado";
        return $this->find($columns);
    }

}

?>