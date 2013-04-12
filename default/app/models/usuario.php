<?php


class Usuario extends ActiveRecord {
    protected $logger = true;
    const ACTIVO = 1;
    const INACTIVO = 0;

    protected function initialize(){
        $this->validates_uniqueness_of("usuario",  "message: Ya existe un usuario con ese nombre");
        $this->validates_length_of("usuario", 16, 6, "too_short: El nombre de usuario no debe tener al menos 6 caracteres", "too_long: El nombre de usuario no debe tener más de 16 caracteres");
    }

    public function listarUsuarios(){
        $columns = "columns: id, usuario, nivel, estado";
        return $this->find($columns);
    }

    public function nuevoUsuario() {
        if ( Auth::get('perfil') == 1 ) {
            $this->clave = md5($this->clave);
            $this->estado = self::ACTIVO;
            $this->nivel = (Auth::get('nivel') != 0)?Auth::get('nivel'):$this->nivel;
            $this->perfil = (Auth::get('nivel') != 0)?2:$this->perfil;
            if ( $this->create() ) {
                return True;
            }
        } else {
            Flash::error('No posee los permisos para crear usuarios');
            return False;
        }
    }

    public function eliminarUsuario($id) {
        $rs = $this->find_first(Filter::get($id,'int'));
        if ( Auth::get('id') == $id ) {
            Flash::error('Disculpe no se puede borrar así mismo');
            return False;
        } elseif ( Auth::get('perfil') == 1 && $rs->nivel == Auth::get('nivel') ) {
            if ( $rs->delete() ) {
                return True;
            } else {
                Flash::error('Error al intentar eliminar usuario');
                return False;
            }
        } else {
            Flash::error('No posee los permisos para eliminar usuarios');
            return False;
        }
    }

    public function cambiarEstado($id) {
        $rs = $this->find_first(Filter::get($id,'int'));
        if ( Auth::get('id') == $id ) {
            Flash::error('Disculpe no se puede modificar así mismo');
            return False;
        } elseif ( Auth::get('perfil') == 1 && $rs->nivel == Auth::get('nivel') ) {
            $rs->estado = ($rs->estado)?self::INACTIVO:self::ACTIVO;
            if ( $rs->update() ) {
                return True;
            } else {
                Flash::error('Error al intentar modificar usuario');
                return False;
            }
        } else {
            Flash::error('No posee los permisos para modificar usuarios');
            return False;
        }
    }

}

?>