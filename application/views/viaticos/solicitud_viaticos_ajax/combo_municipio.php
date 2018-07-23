<?php 
	$id_departamento = $_GET["id_departamento"];
	$tipo = $_GET["tipo"];

	if($tipo == "oficina"){
		$sql = "WHERE id_municipio IN(SELECT id_municipio FROM vyp_oficinas WHERE id_departamento = '".$id_departamento."')";
	}else if($tipo == "departamento"){
		$sql = "WHERE id_municipio = '".$id_departamento."'";
	}else{
        $sql = "WHERE id_municipio = '".$id_departamento."'";
    }

    $municipio = $this->db->query("SELECT * FROM org_municipio ".$sql);
    if($municipio->num_rows() > 0){
        foreach ($municipio->result() as $fila2) {              
           //echo '<option class="m-l-50" value="'.$fila2->id_municipio.'">'.$fila2->municipio.'</option>';
        }
        if($tipo == "oficina"){
            echo "<input type='hidden' id='id_municipio_copia' value='".$fila2->id_municipio."'>";
        }else{
            echo "<input type='hidden' id='id_municipio_copia' value='".$fila2->id_departamento_pais."'>";  
        }
    }else{
        echo "<input type='hidden' id='id_municipio_copia' value=''>";
    }
?>