<?php

class ReportePdvsa extends ActiveRecord {

    public function insertar($cedula) {
        $this->cedula = $cedula;
        $this->ip = Utils::getIp();
        if ( $this->create() ) {
            return True;
        } else {
            return False;
        }
    }
}

?>