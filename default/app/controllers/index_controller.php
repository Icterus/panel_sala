<?php
/**
 * Controller por defecto si no se usa el routes
 *
 */
class IndexController extends AppController
{

    private $auth = '';
	public function index()
	{
        if (Input::post('usuario')) {
                Load::model('usuario');
                $login = Input::post('usuario');
                $usuario = $login['usuario'];
                $clave = md5($login['clave']);
                $this->auth = new Auth('model', 'class: usuario', "usuario: $usuario", "clave: $clave", "estado: 1");
                if ( !$this->auth->authenticate() ) {
                    Flash::error("Usuario o Contrase&ntilde;a es Invalida");
                } else {
                    Session::set( 'id', $this->auth->get('id') );
                    Session::set( 'nivel', $this->auth->get('nivel') );
                    Session::set( 'perfil', $this->auth->get('perfil') );
                    Router::redirect('principal/');
                }
            }  elseif (Auth::is_valid() ) {
                Router::redirect('principal/');
            }
	}

    public function principal() {
        Flash::info('Hola');
    }

    public function salir() {
        if(!Auth::is_valid()) {
            Flash::info("Identifícate nuevamente.");
        } else {
            Auth::destroy_identity();
            Session::delete('id');
            Session::delete('nivel');
            Session::delete('perfil');
            Flash::valid("Sesión Cerrada");
        }
        Router::redirect('/');
    }
}
