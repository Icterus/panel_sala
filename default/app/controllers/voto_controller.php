<?php
/**
 * Controller por defecto si no se usa el routes
 *
 */
class votoController extends AppController
{

	public function index()
	{
		$this->mensaje ="Reportar Cedula / Voto";
		$this->submit = "voto/buscar";
		$this->asincrono = True;
	}

	public function reporte_json() {
		$salida = array('message'=>'error');
		if ( Input::hasPost('id') ) {
			$info = Load::model('informacion')->registrarVoto(Input::post('id'));
			if ($info) $salida['message']='OK';
		}
		print json_encode($salida);
		View::select(null, 'json');
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