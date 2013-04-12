<?php

class ReportePdvsa extends ActiveRecord {

    public function insertar($cedula) {
        $cedula = Filter::get($cedula, 'int');
        if ( $this->exists('cedula = '.$cedula) ) {
            return False;
        }  else {
            $this->cedula = $cedula;
            $this->ip = Utils::getIp();
            if ( $this->create() ) {
                return True;
            } else {
                return False;
            }
        }
    }
}

?>