<?php
/**
 * Controller por defecto si no se usa el routes
 *
 */
class LlamadasController extends AppController

{

	public $saludo2 = "hola";

	public function index()
	{

echo $this->saludo2;
	}

	public function saludo()
	{
echo $this->saludo2;

	}

}
