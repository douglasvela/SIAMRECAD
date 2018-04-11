<?php
    $nr_usuario = $_GET["nr"];

    $info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_usuario."'");
    if($info_empleado->num_rows() > 0){ 
            foreach ($info_empleado->result() as $filas) {}
        }

?>
        <?php 
            $tipo = $_GET["tipo"];

            if($tipo == "oficina"){
                echo '<h5>Oficina: <span class="text-danger">*</span></h5>';
                echo '<select id="departamento1" name="departamento1" class="select2" onchange="combo_municipio1('."'".$tipo."'".');" style="width: 100%" required>';
                echo "<option value=''>[Elija la oficina]</option>";
                $oficina = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina <> '".$filas->id_oficina_departamental."'");
                if($oficina->num_rows() > 0){
                    foreach ($oficina->result() as $fila2) {              
                       echo '<option class="m-l-50" value="'.$fila2->id_departamento.'">'.$fila2->nombre_oficina.'</option>';
                    }
                }
            }else{
                //echo '<h5>Departamento: <span class="text-danger">*</span></h5>';
                echo '<select id="departamento1" name="departamento1" class="select2" onchange="combo_municipio1('."'".$tipo."'".');" style="width: 100%" required>';
                echo "<option value=''>[Elija el departamento]</option>";
                $departamento1 = $this->db->query("SELECT * FROM org_departamento");
                if($departamento1->num_rows() > 0){
                    foreach ($departamento1->result() as $fila2) {              
                       echo '<option class="m-l-50" value="'.$fila2->id_departamento.'">'.$fila2->departamento.'</option>';
                    }
                }
            }

            
        ?>
</select>
<span class="help-block"></span>