<?php

class ReportesExternos extends ActiveRecord {

    public function insertar($cedula) {
        $cedula = str_replace('.', '', $cedula);
        $cedula = str_replace('-', '', $cedula);
        $cedula = str_replace(' ', '', $cedula);
        $cedula = str_replace('V-', '', $cedula);
        $cedula = Filter::get($cedula, 'int');
        $rs = Load::model('token')->find( 'token_secret = \''.Input::post('key').'\'' );
        if ($rs) {
            return False;
        } elseif ( strlen($cedula) < 4 && $this->exists('cedula = '.$cedula) ) {
            return False;
        }  else {
            $this->keys_id = $rs->id;
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