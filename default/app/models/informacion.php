<?php


class Informacion extends ActiveRecord{
    public $logger = true;

    public function registrarVoto($id, $azul=False) {
        $id = Filter::get($id, 'int');
        $persona = Load::model('datos_personales')->buscarCentro($id);
        if ( $persona ) {
            $this->datos_personales_id = $id;
            $this->voto = ($azul)?'0':'1';
            $this->centro_votacion_id = $persona->centro;
            $this->usuario_id = Auth::get('id');
            if ( $this->create() ) return True;
        } else return False;
    }
}

?>