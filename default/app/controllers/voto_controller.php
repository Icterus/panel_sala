<?php
/**
 * Controller por defecto si no se usa el routes
 *
 */
class votoController extends AppController
{

		public $cedula = false;

	public function index()
	{
$this->mensaje ="Reportar Cedula / Voto";
	}


	public function buscar(){
		Load::model('datos_personales');
		if(Input::HasPost('cedula')){
			$variable = new DatosPersonales();
			 $this->busqueda = $variable->buscar(Input::post('cedula'));

				}

			}


		// public function buscarvoto(){
		// Load::model('datos_personales');
		// if(Input::HasPost('buscar')){
		// 	print_r(Input::post('buscar'));
		// 	$variable = new DatosPersonales(Input::post('buscar'));
		// 	print_r($variable->buscar());
		// 		}
		//    }




}
?>