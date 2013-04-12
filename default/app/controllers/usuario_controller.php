<?php
/**
 * Controller para manejar usuarios
 *
 */
Load::model('usuario');
class UsuarioController extends AppController
{

    public function index($pag='pag',$num=1)
    {
        $usuarios = new Usuario();
        $this->objeto = $usuarios->listarUsuarios($num);
        $this->lista = $this->objeto->items;
    }

    public function nuevo() {
        if ( Input::hasPost('usuario') ) {
            if ( Input::post('usuario.clave') == Input::post('usuario.reclave') ){
                $usuario = new Usuario(Input::post('usuario'));
                if( $usuario->nuevoUsuario() ) {
                    Flash::valid('Usuario Creado');
                    Router::toAction('index/');
                }
            } else {
                Flash::error('Claves no coinciden');
            }
        }
    }

    public function estado($id) {
        $usuario = new Usuario();
        if( $usuario->cambiarEstado($id) ) Flash::valid('Usuario Modificado');
        Router::toAction('index/');
    }

    public function eliminar($id) {
        $usuario = new Usuario();
        if( $usuario->eliminarUsuario($id) ) Flash::valid('Usuario Eliminado');
        Router::toAction('index/');
    }

}
