<?php 
    $nr_empleado = $_GET["nr"];

    if(!empty($nr_empleado)){
?>
<div class="table-responsive">
    <table id="myTable" class="table table-hover product-overview">
        <thead class="bg-inverse text-white">
            <tr>
                <th>Banco</th>
                <th>Numero de cuenta</th>
                <th>Estado</th>
                <th width="100px">(*)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select id="id_banco2" name="id_banco2" class="select2" style="width: 100%" required="">
                        <option value="">[Elija el banco]</option>
                        <?php 
                            $banco = $this->db->query("SELECT * FROM vyp_bancos");
                            if($banco->num_rows() > 0){
                                foreach ($banco->result() as $fila) {              
                                   echo '<option class="m-l-50" value="'.$fila->id_banco.'">'.$fila->nombre.'</option>';
                                }
                            }
                        ?>
                    </select>
                </td>
                <td colspan="2">
                    <div class="controls">
                        <input type="text" id="n_cuenta" name="n_cuenta" class="form-control" required="">
                    </div>
                </td>
                <td>
                    <?php if(tiene_permiso($segmentos=2,$permiso=2)){ ?>
                    <button type="submit" class="btn waves-effect waves-light btn-rounded btn-sm btn-success2" data-toggle="tooltip" title="Agregar cuenta"><span class="fa fa-plus"></span></button>
                    <?php }?>
                </td>
            </tr>
        <?php 
            $cuenta = $this->db->query("SELECT c.*, b.nombre FROM vyp_empleado_cuenta_banco AS c JOIN vyp_bancos AS b ON b.id_banco = c.id_banco AND c.nr = '".$nr_empleado."'");
            if($cuenta->num_rows() > 0){
                $puede_editar = tiene_permiso($segmentos=2,$permiso=4);
                foreach ($cuenta->result() as $fila) {
                  echo "<tr>";
                    echo "<td>".$fila->nombre."</td>";
                    echo "<td>".$fila->numero_cuenta."</td>";
                    if($fila->estado == 0){
                        echo '<td><span class="label label-danger">Inactiva</span></td>';
                    }else if($fila->estado == 1){
                        echo '<td><span class="label label-success">Activa</span></td>';
                    }
                    echo "<td>";
                    $array = array($fila->id_empleado_banco, $fila->nr, $fila->id_banco, $fila->numero_cuenta, $fila->estado);
                    if($puede_editar){
                        array_push($array, "edit");
                        echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                    
                        unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                        array_push($array, "delete");
                        if($fila->estado == 0){
                            echo generar_boton($array,"cambiar_editar","btn-success","fa fa-chevron-up","Activar");
                        }else{
                            echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-chevron-down","Desactivar");
                        }
                    }
                    echo "</td>";
                  echo "</tr>";
                }
            }else{
            	echo "<tr>";
                	echo "<td colspan='4'>No hay cuentas bancarias registradas</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>
<?php 
}else{
?>
    <h5 class="text-muted m-b-0">Seleccione un empleado para configurar sus cuentas bancarias</h5>
<?php
}
?>