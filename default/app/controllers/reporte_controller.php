<?php
/**
 * Controller por defecto si no se usa el routes
 *
 */
class ReporteController extends AppController
{
	public function index()
	{

	}

	public function centros($parroquia){

		$this->parroquia = $parroquia;

	}

	public function parroquias($municipio){

		$this->municipio = $municipio;
	}
}
?>