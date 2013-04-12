<?php

class ReportesExternos extends ActiveRecord {
    protected $logger = true;

    public function insertar($cedula) {
        $cedula = str_replace('.', '', $cedula);
        $cedula = str_replace('-', '', $cedula);
        $cedula = str_replace(' ', '', $cedula);
        $cedula = str_replace('V-', '', $cedula);
        $cedula = Filter::get($cedula, 'int');
        $rs = Load::model('token')->find_first( 'token_secret = \''.Input::post('key').'\'' );
        if (!$rs) {
            return False;
        } elseif ( strlen($cedula) < 4 || $this->exists("cedula = '$cedula'") ) {
            return False;
        }  else {
            $this->token_id = $rs->id;
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