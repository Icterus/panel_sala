<?php

Load::model('token');
class KeyController extends AppController
{

    public function index() {
        $tokens = new Token();
        $this->lista = $tokens->listar();
    }

    public function nuevo() {
        if ( Input::hasPost('token') ) {
            $create = new Token(Input::post('token'));
            if ($create->nuevo()) Flash::valid('Token Creado exitosamente');
            Router::toAction('index/');
        }
    }

    public function estado($id) {
        $tokens = new Token();
        if( $tokens->cambiar($id) ) Flash::valid('Keys Modificado');
        Router::toAction('index/');
    }

    public function regenerar($id) {
        $tokens = new Token();
        if( $tokens->regenerar($id) ) Flash::valid('Keys Modificado');
        Router::toAction('index/');
    }
}
?>