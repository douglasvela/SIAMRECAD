<div class="card">
    <div class="card-header">
        <div class="card-actions">
            <a style="font-size: 16px;" onclick="cerrar_mantenimiento2();"><i class="mdi mdi-window-close"></i></a>
        </div>
        <h4 class="card-title m-b-0">Listado de polizas</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">

<?php

$sql = $_POST["sql"];
$polis = $_POST["polis"];



	//SELECT p0.* FROM vyp_poliza AS p0 WHERE no_poliza = '1' AND mes_poliza = 'ENERO' AND anio = '2017' UNION SELECT p1.* FROM vyp_poliza AS p1 WHERE no_poliza = '2' AND mes_poliza = 'ENERO' AND anio = '2017' UNION SELECT p2.* FROM vyp_poliza AS p2 WHERE no_poliza = '3' AND mes_poliza = 'FEBRERO' AND anio = '2017'

//echo $host= $_SERVER["REQUEST_URI"];

?>
<h5>Bancos encontrados</h5>
<select id="id_banco2" name="id_banco2" class="custom-select" style="width: 100%; background-color: #fff;" required="" onchange="tabla_registros_planillas('<?php echo base64_encode($sql); ?>','<?php echo base64_encode($polis); ?>');">
    <option value="">[Elija el banco]</option>
    <?php 
        $bancos = $this->db->query("SELECT b.* FROM vyp_bancos AS b");
		    if($bancos->num_rows() > 0){
		        foreach ($bancos->result() as $fila) {              
               echo '<option class="m-l-50" value="'.$fila->id_banco.'">'.$fila->nombre.'</option>';
            }
        }
    ?>
</select>

<br>

<div id="cnt_registros_planillas"></div>