<?php 
        	$id_departamento = $_GET["id_departamento"];
        	$tipo = $_GET["tipo"];

        	if($tipo == "oficina"){
        		$sql = "WHERE id_municipio IN(SELECT id_municipio FROM vyp_oficinas WHERE id_departamento = '".$id_departamento."')";
                echo '<select id="municipio" name="municipio" class="select2" style="width: 100px" required>';
        	}else if($tipo == "departamento"){
                 echo "<label class='font-weight-bold'>Municipio: <span class='text-danger'>*</span></label><br>";
                echo '<select id="municipio" name="municipio" class="select2" style="width: 285px" required ">';
        		echo "<option value=''>[Elija el municipio]</option>";
        		$sql = "WHERE id_departamento_pais = '".$id_departamento."'";
        	}else{

                echo '<select id="municipio" name="municipio" class="select2" style="width: 100px" required ">';


                echo "<option value=''>[Elija el municipio]</option>";
                $sql = "WHERE id_departamento_pais = '".$id_departamento."'";
            }

            $municipio = $this->db->query("SELECT * FROM org_municipio ".$sql);
            if($municipio->num_rows() > 0){
                foreach ($municipio->result() as $fila2) {              
                   echo '<option class="m-l-50" value="'.$fila2->id_municipio.'">'.$fila2->municipio.'</option>';
                }
            }
        ?>
</select>