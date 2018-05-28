<h5> </h5>
        <?php 
        	$id_departamento1 = $_GET["id_departamento"];
        	$tipo = $_GET["tipo"];

        	if($tipo == "oficina"){
        		$sql = "WHERE id_municipio IN(SELECT id_municipio FROM vyp_oficinas WHERE id_departamento = '".$id_departamento1."')";
                echo '<select id="municipio1" name="municipio1" class="select2" style="width: 100%px" required>';
        	}else if($tipo == "departamento"){
                echo '<select id="municipio1" name="municipio1" class="select2" style="width: 100%" required">';
        		echo "<option value=''>[Elija el municipio]</option>";
        		$sql = "WHERE id_departamento_pais = '".$id_departamento1."'";
        	}else{
                echo '<select id="municipio1" name="municipio1" class="select2" style="width: 100%" required>';

                echo "<option value=''>[Elija el municipio]</option>";
                $sql = "WHERE id_departamento_pais = '".$id_departamento1."'";
            }

            $municipio1 = $this->db->query("SELECT * FROM org_municipio ".$sql);
            if($municipio1->num_rows() > 0){
                foreach ($municipio1->result() as $fila2) {              
                   echo '<option class="m-l-50" value="'.$fila2->id_municipio.'">'.$fila2->municipio.'</option>';
                }
            }
        ?>
</select>
<span class="help-block"></span>