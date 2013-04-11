<?php

class BuscarController extends AppController

{



	public function index()
	{

		$this->mensaje = "Consultar Cedula";
 		View::select('../voto/index');

	}


}


?>