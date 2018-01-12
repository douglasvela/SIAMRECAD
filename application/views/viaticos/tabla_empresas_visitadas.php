<?php
    $id_mision = $_GET["id_mision"];

    $nommes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"); 
	$nomdia = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sabado");                         

    $mision = $this->db->query("SELECT * FROM vyp_mision_oficial WHERE id_mision_oficial = '".$id_mision."'");
    if($mision->num_rows() > 0){
        foreach ($mision->result() as $fila2) {}
    }

    $m_dia = date("j", strtotime($fila2->fecha_solicitud));
    $m_sem = date("w", strtotime($fila2->fecha_solicitud));                            
    $m_mes = date("n", strtotime($fila2->fecha_solicitud));
    $m_anio = date("Y", strtotime($fila2->fecha_solicitud));
?>

<div class="row">
    <div class="col-lg-6">
        <p><b>FECHA SOLICITUD: </b><?php echo $nomdia[$m_sem].", ".$m_dia." de ".$nommes[$m_mes]." del ".$m_anio; ?></p>
    </div>
    <div class="col-lg-6">
        <p><b>SOLICITANTE: </b><?php echo $fila2->nombre_completo; ?></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <p><b>ACTIVIDAD REALIZADA: </b><?php echo $fila2->actividad_realizada; ?></p>
    </div>
</div>

<table id="demo-foo-row-toggler" class="table toggle-circle table-hover product-overview">
    <thead class="bg-inverse text-white">
        <tr>
            <th data-hide="all" style="display: none; pointer-events: none;">Orden</th>
            <th data-toggle="true" style="pointer-events: none;">Empresa visitada </th>
            <th style="pointer-events: none;">Hora salida</th>
            <th style="pointer-events: none;">Hora llegada</th>
            <th style="pointer-events: none;">Viaticos</th>
            <th style="pointer-events: none;">Pasajes</th>
            <th data-hide="all">Dirección visitada</th>
            <th data-hide="all">Distancia</th>
            <th>(*)</th>
        </tr>
    </thead>
    <tbody>
<?php                         
$viaticos = 0; $pasajes = 0;

function hora($time){
    return date("H:i A",strtotime(date("Y-m-d")." ".$time));
}

$empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."' ORDER BY orden");
if($empresas->num_rows() > 0){
    foreach ($empresas->result() as $fila) {
        $viaticos += $fila->viaticos;
?>
        <tr>
            <td style="display: none;"><?php echo $fila->orden; ?></td>
            <td><?php echo $fila->origen."&emsp;--->&emsp;".$fila->nombre_empresa; ?></td>
            <td><?php echo hora($fila->hora_salida); ?></td>
            <td><?php echo hora($fila->hora_llegada); ?></td>
            <td><?php echo "$ ".number_format($fila->viaticos, 2, '.', ''); ?></td>
            <td><?php echo "$ ".number_format($fila->pasajes, 2, '.', ''); ?></td>
            <td><?php echo $fila->direccion_empresa; ?></td>
            <td><?php echo number_format($fila->kilometraje, 2, '.', '')." Km"; ?></td>
<?php
        echo "<td>";
        $array = array($fila->id_empresas_visitadas,$fila->observacion);
        echo generar_boton($array,"agregar_observacion_empresa","btn-success2","mdi mdi-pen","Agregar observación");
        echo "</td>";
        echo "</tr>";
    }
}
?>
    </tbody>
    <tfooy>
        <tr style="background: #f2f4f859;">
            <th colspan="3">SUB-TOTAL</th>
            <th><?php echo "$ ".number_format($viaticos, 2, '.', ''); ?></th>
            <th><?php echo "$ ".number_format($pasajes, 2, '.', ''); ?></th>
            <th></th>
        <tr>
        <tr style="background: #f2f4f8;">
            <th colspan="4">TOTAL A PAGAR</th>
            <th><?php echo "$ ".number_format($viaticos+$pasajes, 2, '.', ''); ?></th>
            <th></th>
        <tr>
    </tfooy>
</table>