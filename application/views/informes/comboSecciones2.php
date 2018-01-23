
<?php
echo '<select id="seccion2" name="seccion2" class="form-control" onchange="buscarSeccion3(this.value)" style="width: 100%"" required>';
echo '<option value="">[Elija Seccion]</option>';

$datos = $this->db->query("SELECT * FROM org_seccion where depende='$id_seccion'");

if($datos->num_rows() > 0){
    foreach ($datos->result() as $filadatos) {


echo '<option class="m-l-50"   value="'.$filadatos->id_seccion.'">'.$filadatos->id_seccion.$filadatos->nombre_seccion.'</option>';

    }
}

?>
  </select>
