<?php
    
$nr_usuario = $_GET["nr_usuario"];

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
    	echo '<div class="col-lg-12"><div class="card"><div class="card-body b-t">';
    	echo "Parece que tus datos estan incompletos, solicita a recursos humanos que registren a que oficina pertenes y quien es tu superior inmediato, asi como tu firma digital si no estuviese registrada";
    	echo '</div></div></div>';
    	echo '<input type="hidden" id="nr_jefe_inmediato" name="nr_jefe_inmediato" value="" required>';
		echo '<input type="hidden" id="nr_jefe_regional" name="nr_jefe_regional" value="" required>';
    }
}

?>