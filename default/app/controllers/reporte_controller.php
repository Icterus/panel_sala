<?php
/**
 * Controller por defecto si no se usa el routes
 *
 */
class ReporteController extends AppController
{
	public function index()
	{
		if( Session::get('nivel') != 99 AND Session::get('nivel') != 0 ){
			Router::toAction('parroquias/'.Session::get('nivel'));
		}
	}

	public function reportar($municipio=null, $parroquia=null){
		$this->lista=False;
		if( Session::get('nivel') != 99 AND Session::get('nivel') != 0 ){
			Router::toAction('reporte/reportar/'.Session::get('nivel'));
		}

		if(is_null($municipio) && is_null($parroquia)) {
			Utils::grid(array('municipio','listarMunicipio'),TRUE, array('Ver' => 'reporte/reportar/'));
		} elseif(!is_null($municipio) && is_null($parroquia)) {
			Utils::grid(array('parroquia','listarParroquia',$municipio),TRUE, array('Ver'=>"reporte/reportar/$municipio/"));
		} else{
			$this->lista=Load::model('centro_votacion')->listarCentro($municipio, $parroquia);
			$reporte=Load::model('reportes_centro_votacion')->consultar_reportes($municipio, $parroquia);
			$this->reportes=array();
			$centro="";
			foreach ($reporte as $item) {
				if($centro != $item->id_centro_votacion){
					$centro=$item->id_centro_votacion;
					print $item->id_reporte;
					$this->reportes[$item->id_centro_votacion]=$item->id_reporte;
				}
			}
			$this->text=Load::model('reportes')->lista();
			$this->js_repos=array();
			foreach ($this->text as $item) {
				$this->js_repos[]="'".$item->nombre_reporte."'";
			}
		}
	}

	public function reportarvoto($reporte, $centro, $maduro, $capriles){
		$salida = array('msg'=>'error');
		$rs = Load::model('reportes_centro_votacion')->reportar($reporte, $centro, $maduro, $capriles);
		if ($rs) $salida['msg']='OK';
		echo json_encode($salida);
		View::select(null, 'json');
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