<?php
                echo "<label class='font-weight-bold'>Departamento: <span class='text-danger'>*</span></label><br>";
                echo '<select id="departamento" name="departamento" class="select2" onchange="combo_municipio(this.value,null)" style="width: 285px" required>';
                echo "<option value=''>[Elija el departamento]</option>";
                $departamento = $this->db->query("SELECT * FROM org_departamento");
                if($departamento->num_rows() > 0){
                    foreach ($departamento->result() as $fila2) {              
                       echo '<option class="m-l-50" value="'.$fila2->id_departamento.'">'.$fila2->departamento.'</option>';
                    }
                }
            

            
        ?>
</select>