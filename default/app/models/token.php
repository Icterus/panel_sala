<?php

class Token extends ActiveRecord {
    protected $logger = true;
    const ACTIVO = 1;
    const INACTIVO = 0;

    public function nuevo () {
        if ( Auth::get('nivel') == 0) {
            $this->token_secret  = 'AFeafW'.sha1(uniqid().time());
            if ( $this->create() ) {
                return True;
            }
        } else {
            Flash::error('Acceso incorrecto a la aplicación');
            return False;
        }
    }

    public function listar() {
        $sql = "SELECT token.id, dueno, estado, token_secret, COUNT(reportes_externos.id) as cantidad
        FROM token
        LEFT JOIN reportes_externos ON reportes_externos.token_id = token.id
        GROUP BY token.id";
        return $this->find_all_by_sql($sql);
    }

    public function consultar($token) {
        $token =  str_replace("'", '', $token);
        $token = mysql_real_escape_string($token);
        $conditions = "token_secret = '$token' AND estado = 1";
        return $this->find_first($conditions);
    }

    public function cambiar($id) {
        $rs = $this->find_first(Filter::get($id,'int'));
        if ( Auth::get('nivel') == 0 ) {
            $rs->estado = ($rs->estado == 1)?self::INACTIVO:self::ACTIVO;
            if ( $rs->update() )
                return True;
        } else {
            Flash::error('No posee los permisos para modificar usuarios');
            return False;
        }
    }

    public function regenerar($id) {
        if ( Auth::get('nivel') == 0) {
            $rs = $this->find_first($id);
            $rs->token_secret  = 'AFeafW'.sha1(uniqid().time());
            if ( $rs->update() ) {
                return True;
            }
        } else {
            Flash::error('Acceso incorrecto a la aplicación');
            return False;
        }
    }
}

?>