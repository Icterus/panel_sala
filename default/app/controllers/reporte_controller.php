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

	public function centros($municipio,$parroquia){
        $this->municipio = $municipio;
		$this->parroquia = $parroquia;
	}

	public function parroquias($municipio){
		$this->municipio = $municipio;
	}

	public function reporteapi() {
		$salida = array('estado' => 'error');
		if ( Input::hasPost('key') ) {
			Load::model('reportes_externos');
			$reporte = new ReportesExternos();
			$cedula = Input::post('cedula');
			if ( $reporte->insertar($cedula) ) {
				$salida['estado'] = 'OK';
			}
		}
		View::template(null);
		View::response('json');
		print json_encode($salida);
	}
}
?>