<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_viatico extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('solicitud_model');
		$this->load->library('FPDF/fpdf');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('viaticos/solicitud_viaticos');
		$this->load->view('templates/footer');
	}

	public function tabla_solicitudes(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/tabla_solicitudes');
	}

	public function combo_actividad_realizada(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/combo_actividad_realizada');
	}

	public function informacion_empleado(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/informacion_empleado');
	}

	public function dropify(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/dropify');
	}

	public function cnt_justificacion(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/cnt_justificacion');
	}

	public function tabla_rutas_almacenadas(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/tabla_rutas_almacenadas');
	}

	function insertar_viaticos_ruta(){
		$sql = $this->input->post('sql');
		echo $this->solicitud_model->insertar_viaticos_ruta($sql);
	}

	public function gestionar_mision(){

		if($this->input->post('band') == "save"){
			$data = array(
			'nr' => $this->input->post('nr'),
			'nr_jefe_inmediato' => $this->input->post('nr_jefe_inmediato'),
			'nr_jefe_regional' => $this->input->post('nr_jefe_regional'),
			'nombre_completo' => $this->input->post('nombre_completo'),
			'fecha_mision_inicio' => date("Y-m-d",strtotime($this->input->post('fecha_mision_inicio'))),
			'fecha_mision_fin' => date("Y-m-d",strtotime($this->input->post('fecha_mision_fin'))),
			'id_actividad_realizada' => $this->input->post('id_actividad'),
			'detalle_actividad' => saltos_sql($this->input->post('detalle_actividad'))
			);
			
			$resultado = $this->solicitud_model->insertar_mision($data);

			if($resultado != "fracaso"){

				if(isset($_FILES["file2"])){

				    $file = $_FILES["file2"];
				    $nombre = $file["name"];
				    $tipo = $file["type"];
				    $ruta_provisional = $file["tmp_name"];
				    $size = $file["size"];
				    $carpeta = "assets/viaticos/justificaciones/";
				    $info = new SplFileInfo($nombre);
				    $nombre = str_pad($resultado, 7,"0", STR_PAD_LEFT).".".pathinfo($info->getFilename(), PATHINFO_EXTENSION);
				    $src = $carpeta.$nombre;

				    $data2 = array(
						'id_mision' => $resultado,
						'ruta_justificacion' => $src
					);

					if($file["name"] != ""){
					    if(move_uploaded_file($ruta_provisional, $src)){
							echo $this->solicitud_model->editar_justificacion($data2);
						}
					}else{
						echo "exito";
					}

				}else{

					echo "exito";
				}
			}else{
				echo "fracaso";
			}
		}else if($this->input->post('band') == "edit"){
			$data = array(
			'id_mision' => $this->input->post('id_mision'), 
			'nr' => $this->input->post('nr'),
			'nr_jefe_inmediato' => $this->input->post('nr_jefe_inmediato'),
			'nr_jefe_regional' => $this->input->post('nr_jefe_regional'),
			'nombre_completo' => $this->input->post('nombre_completo'),
			'fecha_mision_inicio' => date("Y-m-d",strtotime($this->input->post('fecha_mision_inicio'))),
			'fecha_mision_fin' => date("Y-m-d",strtotime($this->input->post('fecha_mision_fin'))),			
			'id_actividad_realizada' => saltos_sql($this->input->post('id_actividad')),
			'detalle_actividad' => saltos_sql($this->input->post('detalle_actividad'))
			);
			$resultado = $this->solicitud_model->editar_mision($data);

			if($resultado == "exito"){
				if(isset($_FILES["file2"])){

				    $file = $_FILES["file2"];
				    $nombre = $file["name"];
				    $tipo = $file["type"];
				    $ruta_provisional = $file["tmp_name"];
				    $size = $file["size"];
				    $carpeta = "assets/viaticos/justificaciones/";
				    $info = new SplFileInfo($nombre);
				    $nombre = str_pad($data["id_mision"], 7,"0", STR_PAD_LEFT).".".pathinfo($info->getFilename(), PATHINFO_EXTENSION);
				    $src = $carpeta.$nombre;

				    $data2 = array(
						'id_mision' => $this->input->post('id_mision'),
						'ruta_justificacion' => $src
					);

				    if($file["name"] != ""){
					    if(move_uploaded_file($ruta_provisional, $src)){
							echo $this->solicitud_model->editar_justificacion($data2);	
						}
					}else{
						echo "exito";
					}

				}else{
					$data2 = array(
						'id_mision' => $this->input->post('id_mision'),
						'ruta_justificacion' => ''
					);

					echo $this->solicitud_model->editar_justificacion($data2);	
				}
			}else{
				echo "fracaso";
			}

		}else if($this->input->post('band') == "delete"){
			$data = array(
			'id_mision' => $this->input->post('id_mision')
			);

			$sql = "DELETE FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$this->input->post('id_mision')."'";
			
			if($this->solicitud_model->eliminar_empresas_visitadas($sql) == "exito" && $this->solicitud_model->eliminar_empresas_viaticos($this->input->post('id_mision')) == true){
				echo $this->solicitud_model->eliminar_mision($data);
			}else{
				echo "fracaso";
			}
		}
	}

	public function tabla_empresas_visitadas(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/tabla_empresas_visitadas');
	}

	public function tabla_viaticos_encontrados(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/tabla_viaticos_encontrados');
	}

	public function combo_oficinas_departamentos(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/combo_oficinas_departamentos');
	}

	public function combo_municipios(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/combo_municipio');
	}

	public function input_distancia(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/input_distancia');
	}

	public function obtener_id_municipio(){
		echo $this->solicitud_model->obtener_id_municipio($_POST['id_municipio']);
	}

	public function obtener_id_departamento(){
		echo $this->solicitud_model->obtener_id_departamento($_POST['id_municipio']);
	}

	public function gestionar_destinos(){
			
		$data = array(
			"id_mision" => $this->input->post('id_mision'),
            "departamento" => $this->input->post('departamento'),
            "municipio" => $this->input->post('municipio'),
            "nombre_empresa" => $this->input->post('nombre_empresa'),
            "direccion_empresa" => $this->input->post('direccion_empresa'),
            "distancia" => $this->input->post('distancia'),
            "tipo" =>  $this->input->post('tipo'),
            "band" => $this->input->post('band'),
            "descripcion_destino" => $this->input->post('descripcion_destino'),
            "id_oficina_origen" => $this->input->post('id_oficina_origen'),
            "latitud_destino" => $this->input->post('latitud_destino'),
            "longitud_destino" => $this->input->post('longitud_destino'),
            "id_destino" => $this->input->post('id_destino'),
        );

        if($this->input->post('id_ruta_visitada') == ""){
        	if($this->input->post('existe') == "true"){
	        	echo $this->solicitud_model->insertar_destino($data);
	        }else{
	        	echo $this->solicitud_model->insertar_ruta($data);
	        }
        }else{
        	$data["id_destino"] = $this->input->post('id_ruta_visitada');
        	echo $this->solicitud_model->insertar_destino($data);
        }
	}

	public function tabla_empresas_viaticos(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/tabla_empresa_viaticos');
	}

	public function form_empresas_viaticos(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/form_empresa_viaticos');
	}


	public function gestionar_viaticos(){

		if($this->input->post('band_viatico') == "save" || ($this->input->post('band_viatico') == "edit")){

			if($this->input->post('band_viatico') == "save"){
				$id_empresa_viatico = $this->solicitud_model->obtener_ultimo_id("vyp_empresa_viatico","id_empresa_viatico");
			}else{
				$id_empresa_viatico = $this->input->post('id_empresa_viatico');
			}
			
	        if(floatval($this->input->post('alojamiento')) > 0){
	        	if(isset($_FILES["file"])){

				    $file = $_FILES["file"];
				    $nombre = $file["name"];
				    $tipo = $file["type"];
				    $ruta_provisional = $file["tmp_name"];
				    $size = $file["size"];
				    //$dimensiones = getimagesize($ruta_provisional);
				    //$width = $dimensiones[0];
				    //$height = $dimensiones[1];
				    $carpeta = "assets/viaticos/facturas/";

				    $info = new SplFileInfo($nombre);

				    $nombre = str_pad($id_empresa_viatico, 7,"0", STR_PAD_LEFT).".".pathinfo($info->getFilename(), PATHINFO_EXTENSION);
				    $data = array(
						"id_empresa_viatico" => $id_empresa_viatico,
						"id_mision" => $this->input->post('id_mision'),
						"fecha" => $this->input->post('fecha_mision'),
						"id_origen" => $this->input->post('id_origen'),
						"id_destino" => $this->input->post('id_destino'),
						"nombre_origen" => $this->input->post('nombre_origen'),
						"nombre_destino" => $this->input->post('nombre_destino'),
						"kilometraje" => $this->input->post('kilometraje'),
						"hora_salida" => $this->input->post('hora_salida'),
						"hora_llegada" => $this->input->post('hora_llegada'),
						"pasaje" => $this->input->post('pasaje'),
						"viatico" => $this->input->post('viatico'),
						"horarios" => $this->input->post('horarios'),
						"alojamiento" => $this->input->post('total_alojamiento'),
						"factura" => $nombre
			        );

				    $src = $carpeta.$nombre;
				    if(move_uploaded_file($ruta_provisional, $src)){
						if($this->input->post('band_viatico') == "save"){
							echo $this->solicitud_model->insertar_viaticos($data);
						}else{
							echo $this->solicitud_model->editar_viaticos($data);
						}
					}else{
						if($this->input->post('band_viatico') == "save"){
							echo "imagen";
						}else{
							$data = array(
								"id_empresa_viatico" => $id_empresa_viatico,
								"id_mision" => $this->input->post('id_mision'),
								"fecha" => $this->input->post('fecha_mision'),
								"id_origen" => $this->input->post('id_origen'),
								"id_destino" => $this->input->post('id_destino'),
								"nombre_origen" => $this->input->post('nombre_origen'),
								"nombre_destino" => $this->input->post('nombre_destino'),
								"kilometraje" => $this->input->post('kilometraje'),
								"hora_salida" => $this->input->post('hora_salida'),
								"hora_llegada" => $this->input->post('hora_llegada'),
								"pasaje" => $this->input->post('pasaje'),
								"viatico" => $this->input->post('viatico'),
								"horarios" => $this->input->post('horarios'),
								"alojamiento" => $this->input->post('total_alojamiento')
					        );
							echo $this->solicitud_model->editar_viaticos2($data);
						}
					}	    
				}else{
					echo "vacio";
				}
	        }else{
	        	$data = array(
					"id_empresa_viatico" => $id_empresa_viatico,
					"id_mision" => $this->input->post('id_mision'),
					"fecha" => $this->input->post('fecha_mision'),
					"id_origen" => $this->input->post('id_origen'),
					"id_destino" => $this->input->post('id_destino'),
					"nombre_origen" => $this->input->post('nombre_origen'),
					"nombre_destino" => $this->input->post('nombre_destino'),
					"kilometraje" => $this->input->post('kilometraje'),
					"hora_salida" => $this->input->post('hora_salida'),
					"hora_llegada" => $this->input->post('hora_llegada'),
					"pasaje" => $this->input->post('pasaje'),
					"viatico" => $this->input->post('viatico'),
					"horarios" => $this->input->post('horarios'),
					"alojamiento" => $this->input->post('total_alojamiento'),
					"factura" => ""
		        );
	        	if($this->input->post('band_viatico') == "save"){
					echo $this->solicitud_model->insertar_viaticos($data);
				}else{
					echo $this->solicitud_model->editar_viaticos($data);
				}
	        }
		}else{
			$data = array(
				"id_empresa_viatico" => $this->input->post('id_empresa_viatico')
	        );
	    	echo $this->solicitud_model->eliminar_viaticos($data);
		}

	}

	public function obtener_ultima_mision(){
		echo $this->solicitud_model->obtener_ultima_mision("vyp_mision_oficial","id_mision_oficial",$_POST['nr']);
	}

	public function obtener_ultima_ruta(){
		echo $this->solicitud_model->obtener_ultima_ruta("vyp_empresa_viatico","id_empresa_viatico",$_POST['id_mision']);	
	}

	function convertToHour($hour){
        $hora1 = explode(":", $hour);
        $hora = intval($hora1[0])+(floatval($hora1[1]/60));

        return $hora;
    }

	public function fecha_repetida(){
		$fecha1 = date("Y-m-d",strtotime($_POST['fecha1']));
		$fecha2 = date("Y-m-d",strtotime($_POST['fecha2']));
		$hora1 = $this->convertToHour(trim($_POST['hora1']));
		$hora2 = $this->convertToHour(trim($_POST['hora2']));

		$sql = "SELECT * FROM vyp_mision_oficial WHERE nr_empleado = '".$_POST['nr']."' AND id_mision_oficial <> '".$_POST['id_mision']."' AND ((fecha_mision_inicio >= '".$fecha1."' AND fecha_mision_inicio <= '".$fecha2."') OR (fecha_mision_inicio <= '".$fecha1."' AND fecha_mision_fin >= '".$fecha1."')) AND estado <> 0";

		if($this->solicitud_model->fecha_repetida($sql)){	// verifica si la fecha indicada choca con otra misión
			$hora_salida = ""; $hora_llegada = ""; $band = false;

			$fechas = $this->db->query($sql);
			if($fechas->num_rows() > 0){

				foreach ($fechas->result() as $filaf) {

			    	$horarios = $this->db->query("SELECT v.* FROM vyp_empresa_viatico AS v WHERE v.id_mision = '".$filaf->id_mision_oficial."' ORDER BY v.fecha, v.hora_salida");

			    	$contador = 0;
			    	if($horarios->num_rows() > 0){
			    		foreach ($horarios->result() as $filah) {
			    			if($contador == 0){
			    				$hora_salida = $this->convertToHour(substr($filah->hora_salida,0,5));
			    				$fecha_inicio = $filaf->fecha_mision_inicio;
			    			}
			    			$contador++;
			    		}
			    		$hora_llegada = $this->convertToHour(substr($filah->hora_llegada,0,5));
			    		$fecha_fin = $filaf->fecha_mision_fin;

			    		if( !(($fecha2 <= $fecha_inicio) OR ($fecha1 >= $fecha_fin)) ){
			    			$band = true;
			    		}else{
			    			if($fecha1 == $fecha2 && $fecha_inicio == $fecha_fin){
			    				if( !(($hora2 < $hora_salida) OR ($hora1 > $hora_llegada)) ){
			    					$band = true;
			    				}
			    			}else{
			    				if($fecha2 == $fecha_inicio){

				    				if( !($hora2 < $hora_salida) ){
				    					$band = true;
				    				}
				    			}

				    			if($fecha1 == $fecha_fin){				    				
				    				if( !($hora1 > $hora_llegada) ){
				    					$band = true;
				    				}
				    			}
			    			}

			    		}

			    	}
			    }
			}

			if($band){
				echo "fecha_repetida";
			}else{
				echo "exito";
			}

		}else{
			echo "exito";
		}

	}

	function generear_solicitud(){
		echo $this->solicitud_model->cambiar_estado_revision($_POST['id_mision']);
	}

	public function eliminar_destino(){
		$sql = "DELETE FROM vyp_empresas_visitadas WHERE id_empresas_visitadas = '".$this->input->post('id_empresa_visitada')."'";
		echo $this->solicitud_model->eliminar_empresas_visitadas($sql);
	}

	public function imprimir_solicitud(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/imprimir_solicitud');
	}

	public function observaciones(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/observaciones');
	}


/*	

	

	

	public function imprimir_solicitud_copia(){
		$this->load->view('viaticos/solicitud_viaticos_ajax/imprimir_solicitud_copia');
	}

	

	

	

	

	

	public function ordenar_empresas_visitadas(){
		echo $this->solicitud_model->ordenar_empresas_visitadas($_POST['query']);
	}

	public function guardar_registros_viaticos(){
		if($this->solicitud_model->eliminar_registros_viaticos($_POST['id_mision'])){
			echo $this->solicitud_model->guardar_registros_viaticos($_POST['query']);
		}
	}

	public function completar_tabla_viatico(){
		//if($this->solicitud_model->eliminar_registros_viaticos($_POST['id_mision'])){
			echo $this->solicitud_model->completar_tabla_viatico($_POST['query']);
		//}
	}

	public function estado_revision(){
		echo $this->solicitud_model->estado_revision($_POST['id_mision']);
	}

	function cargar_viaticos(){
		$id_mision = $_POST['id_mision'];
        $horario_viaticos = $this->db->query("SELECT h.*, v.id_empresa FROM vyp_horario_viatico AS h JOIN vyp_viatico_empresa_horario AS v ON v.id_horario = h.id_horario_viatico AND v.id_mision = '$id_mision' UNION SELECT h.*, '' FROM vyp_horario_viatico AS h WHERE h.id_horario_viatico NOT IN (SELECT v.id_horario FROM vyp_viatico_empresa_horario AS v WHERE v.id_mision = '$id_mision')");

        $n = $horario_viaticos->num_rows();

        $retorno = "";

        if($horario_viaticos->num_rows() > 0){
            foreach ($horario_viaticos->result() as $fila) {
                $n--;
                if($n == 0){
                    $retorno .= "['".$fila->id_horario_viatico."', '".substr($fila->hora_inicio,0,5)."', '".substr($fila->hora_fin,0,5)."', '".$fila->descripcion."', '".$fila->monto."', '".$fila->id_empresa."',]";
                }else{
                    $retorno .= "['".$fila->id_horario_viatico."', '".substr($fila->hora_inicio,0,5)."', '".substr($fila->hora_fin,0,5)."', '".$fila->descripcion."', '".$fila->monto."', '".$fila->id_empresa."',]";
                }
            }
        }
        echo $retorno;
	}

	public function verficar_oficina_destino(){

		$info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$this->input->post('nr')."'");
        if($info_empleado->num_rows() > 0){ 
            foreach ($info_empleado->result() as $filas) {}
        }

        $oficina_origen = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$filas->id_oficina_departamental."'");
        if($oficina_origen->num_rows() > 0){ 
            foreach ($oficina_origen->result() as $filaofi) {}
        }

		$data = array(
			'id_mision' => $this->input->post('id_mision'),
			'departamento' => $filaofi->id_departamento,
			'municipio' => $filaofi->id_municipio,
			'nombre_empresa' => $filaofi->nombre_oficina,
			'direccion_empresa' => $filaofi->nombre_oficina,
			'distancia' => $this->input->post('distancia'),
			'tipo' => 'destino_oficina',
			'id_destino' => $filaofi->id_oficina
			);

		if($this->solicitud_model->verficar_cumpla_kilometros($data)){
			echo $this->solicitud_model->verficar_oficina_destino($data);
		}else{
			echo "viaticos";
		}
		
	}

	


	

	public function nueva_actividad(){
		$data = array(
			"nueva_actividad" => $this->input->post('nueva_actividad'),
        );

        echo $this->solicitud_model->insertar_actividad($data);
	}*/
}
?>