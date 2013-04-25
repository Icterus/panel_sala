<?php

class BuscarController extends AppController

{



	public function index()
	{

		$this->mensaje = "Consultar Cedula";
		$this->submit = "buscar/buscar";
 		View::select('../voto/index');

	}

	public function buscar(){
		Load::model('datos_personales');
		if(Input::HasPost('cedula')){
			$variable = new DatosPersonales();
			 $this->busqueda = $variable->buscar(Input::post('cedula'));
			 if (Input::post('tipo') == 'json') {
			 	$rs = $this->busqueda;
			 	if ($rs) {
			 		if ( $this->busqueda->voto != "" )
			 			$salida = array('message' => 'error', 'text' => 'Este persona ya voto');
			 		else {
				 		$salida = $this->busqueda;
				 		$salida->message = 'OK';
			 		}
			 	} else
			 		$salida = array('message' => 'error', 'text' => 'Verifique la cédula');
			 	echo json_encode($salida);
			 	View::select(null, 'json');
			 }
		}

	}


}


?>