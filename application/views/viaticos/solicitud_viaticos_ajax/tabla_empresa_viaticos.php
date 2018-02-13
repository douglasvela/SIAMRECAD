<?php
    $id_mision = $_GET["id_mision"];
    $tipo = $_GET["tipo"];
    $nr_usuario = $_GET["nr"];

    /*$fecha_mision_es = date("d/m/Y",strtotime($_GET["fecha_mision"]));
    $fecha_mision_en = date("Y-m-d",strtotime($_GET["fecha_mision"]));

    $mision_oficial = $this->db->query("SELECT * FROM vyp_mision_oficial WHERE fecha_mision = '".$fecha_mision_en."' AND nr_empleado = '".$nr_usuario."' AND id_mision_oficial <> '".$id_mision."' AND estado <> 'incompleta'");
    if($mision_oficial->num_rows() > 0){ 
        echo '<div class="alert alert-warning"> <i class="fa fa-warning"></i> Ya existe solicitud de viáticos para la fecha: '.$fecha_mision_es." y no podrás cobrar viáticos en los horarios siguientes:";
        foreach ($mision_oficial->result() as $filam) {
            echo '<hr style="margin: 5px;"">&emsp;&emsp;'.$filam->actividad_realizada.' ('.$filam->estado.')';
            $hora_mision = $this->db->query("SELECT MIN(hora_salida) AS hora_salida, MAX(hora_llegada) AS hora_llegada FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$filam->id_mision_oficial."'");
            if($hora_mision->num_rows() > 0){ 
                foreach ($hora_mision->result() as $filah) {
                    echo '<br>&emsp;&emsp;<i class="fa fa-circle"></i> Horario de la misión: '.hora($filah->hora_salida)." - ".hora($filah->hora_llegada);
                }
            }
        }
        echo '</div>';
    }*/

?>
        <div class="table-responsive" style="font-size: 14px;">
			<table id="tabla_viaticos" name="tabla_viaticos" class="table table-hover table-bordered" width="100%">
			  	<thead class="bg-inverse text-white" style="font-size: 13px;">
			        <tr>
			        	<th width="75px">Fecha misión</th>
			      		<th>Lugar de salida a lugar de llegada</th>
			      		<th>Hora de salida</th>
			      		<th>Hora de llegada</th>
			      		<th align="right">Viático ($)</th>
			      		<th align="right">Pasaje ($)</th>
                        <th align="right">Aloj. ($)</th>
                        <th width="90px">(*)</th>
			    	</tr>
			  	</thead>
			  	<tbody>
<?php

    function hora($time){
        return date("H:i A",strtotime(date("Y-m-d")." ".$time));
    }

    function hora2($time){
        return substr($time,0,5);
    }

    function fecha_es($date){
        return date("d/m/Y",strtotime($date));
    }

    $subviaticos = 0;
    $subpasajes = 0;
    $subalojamientos = 0;

    $empresa_viatico = $this->db->query("SELECT * FROM vyp_empresa_viatico WHERE id_mision = '".$id_mision."' ORDER BY fecha, hora_salida");
    if($empresa_viatico->num_rows() > 0){
        foreach ($empresa_viatico->result() as $filam) {
            $subviaticos += $filam->viatico;
            $subpasajes += $filam->pasaje;
            $subalojamientos += $filam->alojamiento;
?>
        <tr>
            <td><?php echo fecha_es($filam->fecha); ?>
                <input type="text" style="width: 25px;" value="<?php echo $filam->id_empresa_viatico; ?>">
            </td>
            <td><?php echo $filam->nombre_origen." - ".$filam->nombre_destino; ?></td>
            <td><?php echo hora($filam->hora_salida); ?></td>
            <td><?php echo hora($filam->hora_llegada); ?></td>
            <td align="right"><?php echo $filam->viatico; ?>
                <input type="hidden" value="<?php echo $filam->horarios_viaticos; ?>">
            </td>
            <td align="right"><?php echo $filam->pasaje; ?></td>
            <td align="right"><?php if(floatval($filam->alojamiento) > 0){ ?>
                 <a target="_Blank" href="<?php echo base_url(); ?>assets/viaticos/facturas/<?php echo $filam->factura."?".rand(); ?>" class="nueva_clase text-dark" data-toggle="tooltip" title="Clic para ver factura"><?php echo number_format($filam->alojamiento, 2); ?></a>
                <?php }else{
                    echo $filam->alojamiento;
                } ?>
            </td>

            <?php
                echo "<td>";
                $array = array($filam->id_empresa_viatico, $filam->id_origen, $filam->id_destino,hora2($filam->hora_salida), hora2($filam->hora_llegada), $filam->pasaje,$filam->viatico, $filam->alojamiento, $filam->horarios_viaticos, $filam->fecha, $filam->id_mision, $filam->factura, $filam->kilometraje);
                array_push($array, "edit");
                echo generar_boton($array,"cambiar_editar_viatico","btn-info","fa fa-wrench","Editar");
                unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                array_push($array, "delete");
                echo generar_boton($array,"cambiar_editar_viatico","btn-danger","fa fa-close","Eliminar");
                echo "</td>";
            ?>
        </tr>
<?php
        }
    }

?>
        <tr>
            <td colspan="4">Total</td>
            <td align="right"><?php echo number_format($subviaticos, 2); ?></td>
            <td align="right"><?php echo number_format($subpasajes, 2); ?></td>
            <td align="right"><?php echo number_format($subalojamientos, 2); ?></td>
            <td align="right"><b>$ <?php echo number_format($subviaticos+$subpasajes+$subalojamientos, 2); ?></b></td>
        </tr>
			  	</tbody>
			</table>
		</div>


		<div class="form-group m-b-5" style="display: block;">
            <textarea class="form-control" id="area" rows="4"></textarea>
            <span class="bar"></span>
            <label for="input7">Text area</label>
        </div>

		<div class="row">
			<div class="form-group col-lg-12 m-b-5" align="right">
		        <button type="button" onclick="verificar_fechas()" class="pull-right btn btn-info">
		        Actualizar solicitud
		        </button>
		    </div>
		</div>