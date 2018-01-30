<div class="form-group col-lg-12" style="margin: 0px;"> 
        <input id="actividad_detalle" name="actividad_detalle" class="form-control" style="width: 100%" required list="lista_actividad">
        <datalist id="lista_actividad">
            <option value=''>[Elija una opción o agregue una nueva]</option>
        <?php
        	$id_actividad = $_GET["id_actividad"];
            $actividad = $this->db->query("SELECT * FROM vyp_actividades WHERE depende_vyp_actividades = '".$id_actividad."'");
            if($actividad->num_rows() > 0){
                foreach ($actividad->result() as $filaa) {              
                   echo '<option class="m-l-50" value="'.$filaa->nombre_vyp_actividades.'">'.$filaa->id_vyp_actividades.'</option>';
                }
            }
        ?>
        </select>
        </datalist>
</div>