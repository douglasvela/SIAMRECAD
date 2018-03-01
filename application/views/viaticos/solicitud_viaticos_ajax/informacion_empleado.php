<?php
    
$nr_usuario = $_GET["nr_usuario"];

$fecha1 = date("Y-m-d",strtotime($_GET["fecha1"]));
$fecha2 = date("Y-m-d",strtotime($_GET["fecha2"]));
$id_mision = $_GET["id_mision"];

if(!empty($nr_usuario)){

    $info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_usuario."'");
    if($info_empleado->num_rows() > 0){ 
        foreach ($info_empleado->result() as $filas) {}

        $oficina_origen = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$filas->id_oficina_departamental."'");
	    if($oficina_origen->num_rows() > 0){ 
	        foreach ($oficina_origen->result() as $filaofi) {}
	    }

	    $director_jefe_regional = $this->db->query("SELECT nr FROM sir_empleado WHERE id_empleado = '".$filaofi->jefe_oficina."'");

	    if($director_jefe_regional->num_rows() > 0){ 
	        foreach ($director_jefe_regional->result() as $filadir) {}
	    }

	    $nr_jefe_inmediato = $filas->nr_jefe_inmediato;
	    $nr_jefe_regional = $filadir->nr;
	    $latitud_oficina = $filaofi->latitud_oficina;
	    $longitud_oficina = $filaofi->longitud_oficina;
	    $nombre_oficina = $filaofi->nombre_oficina;
	    $id_oficina_origen = $filaofi->id_oficina;

	    echo '<input type="hidden" id="nr_jefe_inmediato" name="nr_jefe_inmediato" value="'.$nr_jefe_inmediato.'" required>';
		echo '<input type="hidden" id="nr_jefe_regional" name="nr_jefe_regional" value="'.$nr_jefe_regional.'" required>';
		echo '<input type="hidden" id="latitud_oficina" name="latitud_oficina" value="'.$latitud_oficina.'">';
		echo '<input type="hidden" id="longitud_oficina" name="longitud_oficina" value="'.$longitud_oficina.'">';
		echo '<input type="hidden" id="nombre_oficina" name="nombre_oficina" value="'.$nombre_oficina.'">';
		echo '<input type="hidden" id="id_oficina_origen" name="id_oficina_origen" value="'.$id_oficina_origen.'">';

    }else{
    	echo '<div class="alert alert-danger">';
    	echo '<h3 class="text-danger"><i class="fa fa-times-circle"></i> Faltan datos</h3>';
    	echo "Parece que tus datos estan incompletos, solicita a recursos humanos que registren a que oficina pertenes y quien es tu superior inmediato, asi como tu firma digital si no estuviese registrada";
    	echo '</div>';
    	echo '<input type="text" style="display: none;" id="nr_jefe_inmediato" name="nr_jefe_inmediato" value="" required>';
		echo '<input type="text" style="display: none;" id="nr_jefe_regional" name="nr_jefe_regional" value="" required>';
    }
}

$sql = "SELECT m.*, a.nombre_vyp_actividades AS nombre_actividad FROM vyp_mision_oficial AS m JOIN vyp_actividades AS a ON m.id_actividad_realizada = a.id_vyp_actividades AND m.nr_empleado = '".$nr_usuario."' AND m.id_mision_oficial <> '".$id_mision."' AND ((m.fecha_mision_inicio >= '".$fecha1."' AND m.fecha_mision_inicio <= '".$fecha2."') OR (m.fecha_mision_inicio <= '".$fecha1."' AND m.fecha_mision_fin >= '".$fecha1."'))";

echo "<div id='fechas_repetidas' style='width: 100%;'>";

$fechas = $this->db->query($sql);
if($fechas->num_rows() > 0){
	echo '<div class="alert alert-warning" style="width: 100%;">';
	echo '<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Fecha(s) repetida(s)</h3>';
	foreach ($fechas->result() as $filaf) {
		echo $filaf->nombre_actividad."<br>";
    	$horarios = $this->db->query("SELECT v.* FROM vyp_empresa_viatico AS v WHERE v.id_mision = '".$filaf->id_mision_oficial."' ORDER BY v.fecha, v.hora_salida");
    	$contador = 0;
    	if($horarios->num_rows() > 0){
    		foreach ($horarios->result() as $filah) {
    			if($contador == 0){
    				echo "&emsp;&emsp;<i class='fa fa-circle'></i> Inició: &emsp;&emsp;".convertir($filah->fecha." ".$filah->hora_salida)."<br>";
    			}
    			$contador++;
    		}
    		echo "&emsp;&emsp;<i class='fa fa-circle'></i> Finalizó: &emsp;".convertir($filah->fecha." ".$filah->hora_llegada)."<br><br>";
    	}else{
    		echo "&emsp;&emsp;<i class='fa fa-circle'></i> Inició: &emsp;&emsp;".convertir2($filaf->fecha_mision_inicio)."<br>";
    		echo "&emsp;&emsp;<i class='fa fa-circle'></i> Finalizó: &emsp;".convertir2($filaf->fecha_mision_fin)."<br><br>";
    	}
    }
	echo '</div>';
}

echo "</div>";

function convertir2($fecha){
	return date("d/m/Y",strtotime($fecha))." - Horario no definido";
}

function convertir($fecha){
	return date("d/m/Y H:i",strtotime($fecha));
}

?>