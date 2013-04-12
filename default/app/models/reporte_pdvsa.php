<?php

class ReportePdvsa extends ActiveRecord {

    public function insertar($cedula) {
        $cedula = str_replace('.', '', $cedula);
        $cedula = str_replace('-', '', $cedula);
        $cedula = str_replace(' ', '', $cedula);
        $cedula = str_replace('V-', '', $cedula);
        $cedula = Filter::get($cedula, 'int');
        if ( strlen($cedula) < 4 && $this->exists('cedula = '.$cedula) ) {
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