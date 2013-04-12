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

				}
			}


}


?>