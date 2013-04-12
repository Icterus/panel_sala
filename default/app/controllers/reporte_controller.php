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
			if ( Input::post('key') == md5('pdvsa_reporte') ) {
				Load::model('reporte_pdvsa');
				$rep = new ReportePdvsa();
				$cedula = Input::post('cedula');
				if ( $rep->insertar($cedula) ) {
					$salida['estado'] = 'OK';
				}
			}
		}
		View::template(null);
		View::response('json');
		print json_encode($salida);
	}
}
?>