<?php
/**
 * Controller por defecto si no se usa el routes
 *
 */
// FIXME: Por premura, LIMPIA EL CÓDICO LUEGO
class LlamadasController extends AppController

{

	public function index()
	{


	}

    public function comboparroquia($id) {
        echo Form::dbSelect('parroquia', 'parroquia', array('parroquia', 'listarParroquia', $id), '--Seleccione--');
        View::select(null, 'json');
        echo "<script type=\"text/javascript\">   // Recarga centro
    $('#parroquia').on('change', function(){
        var municipio = $('#municipio').val();
        var parroquia = $(this).val();
        $.get(
            '".PUBLIC_PATH."llamadas/combocentro/'+municipio+'/'+parroquia,
            null,
            function(data){
                $('#capa_centro').html(data);
            });
    });
</script>";
    }
    public function combocentro($municipio, $parroquia) {
        $munipicio = Load::model('centro_votacion')->listarCentro($municipio, $parroquia);
                // print_r($munipicio);
                print '<select name="centro">';
                foreach ($munipicio as $item) {
                    print "\t\t<option value=\"$item->centro_id\">$item->Centro</option>\n";
                }
                print '</select>';
        // echo Form::dbSelect('centro', 'nombre_centro', array('', '', ), '--Seleccione--');
        View::select(null, 'json');
    }

    public function listado($centro, $gmvv=null) {
        $salida = array('msg'=>'error');
        $rs = Load::model('datos_personales')->listadoLlamadasRandom($centro, $gmvv);
        if ( $rs ) {
            foreach ($rs as $item) {
                echo '<tr>
                    <td>'.$item->nombres.' '.$item->apellidos.'</td>
                    <td>'.$item->telefono.'</td>
                    <td>'.$item->celular.'</td>
                    <td class="text-center"><a href="#" class="llamadas_a" data-id="'.$item->id.'">Ya Voto</a>
                    </td><td class="text-center"><a href="#" class="llamadas_a">LLamar Después</a></td>
                    </tr>';
            }
                echo "<script type='text/javascript'>$('#llamadas_a').on('click', function(e){
        var text = $(this).html();
        $(this).parent().parent().fadeOut('slow');
        if (text == 'Ya Voto') {
            var id = $(this).attr('data-id');
            votar(id);
        }
    });

    function votar(idResp) {
        $.post('".PUBLIC_PATH."voto/reporte_json/',
        {
            id: idResp,
        },
        function(data) {
            if (data.message == 'OK') {
                console.log('Voto cargado con éxito');
            } else {
                console.log('No se pudo cargar el voto, intente de nuevo');
            }
        },
        'json');
    }
    </script>";
    }

        View::select(null, 'json');
    }



}
?>