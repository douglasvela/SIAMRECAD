<select id="id_municipio" name="id_municipio" class="form-control" onchange="buscarmapa()">
    <option value="">[Seleccione]</option>
        <?php
            //$this->db->where("id_departamento_pais",$id_departamento);
            $seccion = $this->db->get("org_municipio");
            if(!empty($seccion)){
            foreach ($seccion->result() as $fila) {
        ?>
            <option  value="<?php echo $fila->id_municipio ?>" <?php if($fila->id_municipio==$id_municipio){?> selected  <?php }?>> 
        <?php 
            echo $fila->municipio
        ?>
            </option>;
        <?php
            }
            }
        ?>
</select>
                                       
                                    