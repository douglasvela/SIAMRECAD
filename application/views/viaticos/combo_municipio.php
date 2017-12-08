<h5>Municipio: <span class="text-danger">*</span></h5>
<select id="municipio" name="municipio" class="select2" onchange="cambiar_municio_oficina();" style="width: 100%">
        <?php 
        	$id_departamento = $_GET["id_departamento"];
        	$tipo = $_GET["tipo"];

        	if($tipo == "oficina"){
        		$sql = "id_municipio IN(SELECT id_municipio FROM vyp_oficinas WHERE id_departamento = '".$id_departamento."')";
        	}else{
        		echo "<option value='0'>[Elija el municipio]</option>";
        		$sql = "id_departamento_pais = ".$id_departamento;
        	}

            $municipio = $this->db->query("SELECT * FROM org_municipio WHERE ".$sql);
            if($municipio->num_rows() > 0){
                foreach ($municipio->result() as $fila2) {              
                   echo '<option class="m-l-50" value="'.$fila2->id_municipio.'">'.$fila2->municipio.'</option>';
                }
            }
        ?>
</select>
<span class="text_validate"></span>