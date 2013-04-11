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
        $usuarios = new Usuario();
        $this->lista = $usuarios->listarUsuarios();
    }

    public function nuevo() {

    }

    public function estado($id) {

    }

    public function eliminar($id) {

    }

}
