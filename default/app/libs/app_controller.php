<?php
/**
 * Controlador principal que heredan los controladores
 *
 * Todas las controladores heredan de esta clase en un nivel superior
 * por lo tanto los metodos aqui definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 **/

/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

Load::lib('auth');
Load::lib('acl');
class AppController extends Controller {

	final protected function initialize()
	{
        if (!Auth::is_valid()) {
            View::template('login');
            if ( !(Router::get('controller') == 'index' && Router::get('action') == 'index') && !(Router::get('controller') == 'reporte' && Router::get('action') == 'reporteapi') ) {
                Router::redirect('/');
            }
        }
	}

	final protected function finalize()
	{
	}
}
