<?php
/**
 * Controller para manejar usuarios
 *
 */
Load::model('usuario');
class UsuarioController extends AppController
{

    public function index()
    {
        Flash::info('Cuidado!!!');
        $usuarios = new Usuario();
        $this->lista = $usuarios->listarUsuarios();
    }

    public function nuevo() {

    }

}
