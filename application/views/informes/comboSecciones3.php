
<?php
echo '<select id="seccion3" name="seccion3" class="form-control" onchange="buscarSeccion4(this.value)" style="width: 100%"" required>';
echo '<option value="0">[Elija Seccion]</option>';

$datos = $this->db->query("SELECT * FROM org_seccion where depende='$id_seccion'");

if($datos->num_rows() > 0){
    foreach ($datos->result() as $filadatos) {


echo '<option class="m-l-50"   value="'.$filadatos->id_seccion.'">'.$filadatos->nombre_seccion.'</option>';

    }
}

?>
  </select>
