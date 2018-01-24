<select id="seccion1" name="seccion1" class="form-control" onchange="buscarSeccion2(this.value)" style="width: 100%" required>'
<option value="0">[Elija Seccion]</option>'
<?php
$datos = $this->db->query("SELECT * FROM org_seccion where depende='$id_seccion'");

if($datos->num_rows() > 0){
    foreach ($datos->result() as $filadatos) {
echo '<option class="m-l-50"  value="'.$filadatos->id_seccion.'">'.$filadatos->nombre_seccion.'</option>';

    }
}

?>
  </select>
