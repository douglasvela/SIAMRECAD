<?php 
    $id_municipio = $_GET["id_municipio"];
    $tipo = $_GET["tipo"];

    $sql = "WHERE id_municipio = '".$id_municipio."'";

    $municipio = $this->db->query("SELECT * FROM org_municipio ".$sql);
    if($municipio->num_rows() > 0){
        foreach ($municipio->result() as $fila2) {              
           //echo '<option class="m-l-50" value="'.$fila2->id_municipio.'">'.$fila2->municipio.'</option>';
        }
        echo "<input type='hidden' id='id_departamento_copia' value='".$fila2->id_departamento_pais."'>"; 
    }else{
        echo "<input type='hidden' id='id_departamento_copia' value=''>";
    }
?>