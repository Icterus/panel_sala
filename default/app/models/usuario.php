<?php


class Usuario extends ActiveRecord {
    protected $logger = true;
    const ACTIVO = 1;
    const INACTIVO = 0;

    public function listarUsuarios(){
        $columns = "columns: id, usuario, nivel, estado";
        return $this->find($columns);
    }

    public function eliminarUsuario($id) {
        if ( Auth::get('nivel') == 'pepitooo' ) {
            if ( $this->delete($id) ) {
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

}

?>