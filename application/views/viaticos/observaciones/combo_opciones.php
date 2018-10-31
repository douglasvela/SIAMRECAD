<h5>Opciones: <span class="text-danger">*</span></h5>
<select id="opciones" name="opciones" class="form-control custom-select"  style="width: 100%" onchange="combo_opciones(this.value);">
    <option class="m-l-50" value="">[Sin asignar]</option>
    <?php $paso = $_GET["paso"]; $id_mision = $_GET["id_mision"];
    if($paso == 2){
    	$empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");

        if($empresas->num_rows() > 0){
            foreach ($empresas->result() as $fila) {
              	echo '<option class="m-l-50" value="'.$fila->id_empresas_visitadas.'">'.$fila->nombre_empresa.'</option>';
            }
        }
    }elseif($paso == 3){
    	$empresa_viatico = $this->db->query("SELECT v.* FROM vyp_empresa_viatico AS v WHERE v.id_mision = '".$id_mision."' ORDER BY v.fecha, v.hora_salida");
	    if($empresa_viatico->num_rows() > 0){
	        foreach ($empresa_viatico->result() as $filam) {

	        	echo '<option class="m-l-50" value="'.$fila->id_empresa_viatico.'">'.$filam->nombre_origen." - ".$filam->nombre_destino.'</option>';
	        }
	    }
    }
    ?>
</select>