<?php

$id_mision = $_GET["id_mision"];



$sql = "SELECT sv.*, pe.tipo_pago, pe.num_cheque, pe.monto, pe.fecha_pago, a.nombre_vyp_actividades, pe.id_pago_emergencia FROM vyp_mision_oficial AS sv JOIN vyp_pago_emergencia AS pe ON pe.nr = sv.nr_empleado AND pe.fecha_mision_inicio = sv.fecha_mision_inicio AND pe.fecha_mision_fin = sv.fecha_mision_fin AND sv.id_mision_oficial = '".$id_mision."' JOIN vyp_actividades AS a ON a.id_vyp_actividades = sv.id_actividad_realizada";

echo "<div id='fechas_repetidas' style='width: 100%;'>";

$fechas = $this->db->query($sql);
if($fechas->num_rows() > 0){
    echo '<div class="alert alert-danger" style="width: 100%;">';
    foreach ($fechas->result() as $filaf) {

    	if($filaf->tipo_pago == "efectivo"){
    		echo '<h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Es posible que se haya pagado en efectivo. ¿Es correcto?</h3>';
    	}else{
    		echo '<h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Es posible que se haya pagado con cheque. ¿Es correcto?</h3>';
    	}

    	echo '<h5 class="text-danger"><b>Datos del pago:</b></h5>';
    	echo "<blockquote>";
    	if($filaf->fecha_mision_inicio != $filaf->fecha_mision_inicio){
	        echo "<b>Fecha misión: </b>".convertir2($filaf->fecha_mision_inicio)." - ".convertir2($filaf->fecha_mision_fin)."<br>";
	    }else{
	    	echo "<b>Fecha misión: </b>".convertir2($filaf->fecha_mision_inicio)."<br>";
	    }
	    echo "<b>Actividad realizada: </b>".$filaf->nombre_vyp_actividades."<br>";
	    echo "<b>Fecha del pago: </b>".convertir2($filaf->fecha_pago)."<br>";
	    if($filaf->tipo_pago == "cheque"){
		    echo "<b>Monto: </b>$ ".$filaf->monto."      <b style='margin-left: 150px'>Número de cheque:</b> ".$filaf->num_cheque;
		}else{
			echo "<b>Monto: </b>$ ".$filaf->monto;
		}
		echo "</blockquote>";
    }
    echo '<div align="right"><button type="button" onclick="actualizar_tooltip();" class="btn waves-effect waves-light btn-danger"  data-dismiss="alert"> No </button> ';
    echo '<button type="button" onclick="consultar_pago_solicitud('."'".$filaf->id_mision_oficial."','".$filaf->id_pago_emergencia."','".$filaf->fecha_pago."','".$filaf->tipo_pago."','".$filaf->num_cheque."'".');" class="btn waves-effect waves-light btn-info" data-toggle="tooltip" title="Clic para actualizar el pago de la solicitud"> Sí </button></div>';
    echo '</div>';
}

echo "</div>";

function convertir2($fecha){
    return date("d/m/Y",strtotime($fecha));
}
?>