<style type="text/css">
    td{
        margin: 0px; padding: 0px;
    }
</style>
<div class="col-lg-12">
<div class="table-responsive" style="width: 100%;">
	<table id="target" class="table table-hover product-overview" style="margin-bottom: 0px; width: 100%;">
	  	<thead class="bg-inverse text-white">
	        <tr>
	      		<th width="25%">Nombre de la empresa</th>
	      		<th width="30%">Municipio</th>
                <th width="40%">Dirección</th>
                <th width="5%">(*)</th>
	    	</tr>
	  	</thead>
	  	<tbody>

	  		<?php 
	  			$id_mision = $_GET["id_mision"];
                $nr_usuario = $_GET["nr"];

                $empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");

                if($empresas->num_rows() > 0){
                    foreach ($empresas->result() as $fila) {
                        $query = $this->db->query("SELECT * FROM vyp_observacion_solicitud WHERE id_mision = '".$id_mision."' AND corregido = 0 AND paso = '2' AND id_observado = '".$fila->id_empresas_visitadas."'");
                        if($query->num_rows() > 0){
                            echo "<tr class='table-warning' title='".$query->row(0)->observacion."' data-toggle='tooltip'>";
                        }else{
                            echo "<tr>";
                        }
                        echo "<td align='right'>";
                        	$array = array($fila->id_empresas_visitadas, $fila->id_departamento, $fila->id_municipio, $fila->nombre_empresa, $fila->direccion_empresa, $fila->tipo_destino);
                            if($fila->tipo_destino != "destino_oficina"){
                                echo generar_boton(array($fila->id_empresas_visitadas, $fila->id_departamento, $fila->id_municipio, $fila->nombre_empresa, $fila->direccion_empresa, $fila->tipo_destino, $fila->id_mision_oficial, $fila->id_destino),"editar_empresa_visitada","btn-info","fa fa-wrench","Editar");
                            }
                            array_push($array, "delete");
                            echo generar_boton(array($fila->id_empresas_visitadas),"cambiar_eliminar_destino","btn-danger","fa fa-close","Eliminar");
                        echo "</td>";

                      	echo "</tr>";
                    }

                }else{
            ?>
            <tr>
                <td style="padding: 0px 5px;">
                    <input type="text" class="form-control" placeholder="Nombre de la empresa" required style="border: 0px;">
                </td>
                <td style="padding: 0px 5px;">
                    <select class="select2" style="width: 100%;" required>
                        <option value=''>[Elija el municipio]</option>
                        <?php 
                            $municipio = $this->db->query("SELECT * FROM org_municipio m JOIN org_departamento d ON m.id_departamento_pais = d.id_departamento ORDER BY municipio");
                            if($municipio->num_rows() > 0){
                                foreach ($municipio->result() as $fila2) {              
                                   echo '<option class="m-l-50" value="'.$fila2->id_municipio.'">'.$fila2->municipio." / ".$fila2->departamento.'</option>';
                                }
                            }
                        ?>
                    </select>
                </td style="padding: 0px 5px;">
                <td style="padding: 0px 5px;">
                    <textarea class="form-control" placeholder="Ingrese la dirección de la empresa" rows="1" required style="border: 0px; margin-top: 5px;"></textarea>
                </td>
                <td style="padding: 0px 5px;">
                    <button type="button" class="btn btn-success2" onclick="registrar_empresa();"><span class="fa fa-plus"></span></button>
                </td>
            </tr>
            
            <?php } ?>

	  	</tbody>
	</table>
	<hr style="margin-top: 0px;">
</div>