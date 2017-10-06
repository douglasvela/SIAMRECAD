<script type="text/javascript">
    function cambiar_editar(id_oficina,nombre_oficina,direccion_oficina,coordenada_oficina){
         $("#id_oficina").val(id_oficina);
         $("#nombre_oficina").val(nombre_oficina);
         $("#direccion_oficina").val(direccion_oficina);


        $("#ttl_form").removeClass("bg-success");
        $("#ttl_form").addClass("bg-info");

        $("#btnadd").hide(0);
        $("#btnedit").show(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar Oficina");
    }

    function cambiar_nuevo(){
        
        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva Oficina");
    }


    function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function editar_horario(obj){
        $("#band").val("edit");
        $("#submit").click();
    }

    function eliminar_horario(obj){
        $("#band").val("delete");
        $("#submit").click();
    }

    <?php if($notificacion != "nada"){ ?>
        var notificacion = setTimeout(function(){ $("#notificacion").click(); }, 50);
    <?php } ?>

</script>

<!-- ============================================================== -->
<!-- Inicio de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="container-fluid">
        <button id="notificacion" style="display: none;" class="tst1 btn btn-success2">Info Message</button>
        <!-- ============================================================== -->
        <!-- TITULO de la página de sección -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="align-self-center" align="center">
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de Oficinas del MTPS</h3>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Fin TITULO de la página de sección -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Inicio del CUERPO DE LA SECCIÓN -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- ============================================================== -->
            <!-- Inicio del FORMULARIO de gestión -->
            <!-- ============================================================== -->
            <div class="col-lg-12" id="cnt_form" style="display: none; padding-left: 100px; padding-right: 100px;">
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Listado de Oficinas</h4>
                    </div>
                    <div class="card-body b-t">
                        
                        <?php echo form_open('oficinas/gestionar_oficinas', array('style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" id="id_oficina" name="id_oficina" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Nombre de la Oficina:</label>
                                        <input type="text" class="form-control" id=""> </div>
                                
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Dirección de la Oficina :</label>
                                        <input type="text" class="form-control" id=""> </div>
                                    </div>
                            </div>

                            <button id="submit" type="submit" style="display: none;"></button>
                            <div align="right" id="btnadd">
                                <button type="submit" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                            </div>
                            <div align="right" id="btnedit" style="display: none;">
                                <button type="button" onclick="editar_horario(this)" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
                                <button type="button" onclick="eliminar_horario(this)" class="btn waves-effect waves-light btn-danger"><i class="mdi mdi-window-close"></i> Eliminar</button>
                            </div>

                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Fin del FORMULARIO de gestión -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Inicio de la TABLA -->
            <!-- ============================================================== -->
            <div class="col-lg-12" id="cnt-tabla">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions">
                           
                        </div>
                        <h4 class="card-title m-b-0">Listado de Oficinas</h4>
                    </div>
                    <div class="card-body b-t">
                        <div class="pull-right">
                            <button type="button" onclick="cambiar_nuevo();" class="btn btn-rounded btn-success2"><span class="mdi mdi-plus"></span> Nuevo registro</button>
                        </div>
                        <div class="table-responsive" style="margin-top: 0px;">
                            <table id="myTable" class="table table-bordered">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre de la Oficina</th>
                                        <th>Dirección de la Oficina</th>
                                        <th>Coordenadas</th>
                                        <th>(*)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($oficinas)){
                                        foreach ($oficinas->result() as $fila) {
                                           echo "<tr>";
                                           echo "<td>".$fila->id_oficina."</td>";
                                           echo "<td>".$fila->nombre_oficina."</td>";
                                           echo "<td>".$fila->direccion_oficina."</td>";
                                           echo "<td>".$fila->coordenada_oficina."</td>";
                                           $array = array($fila->id_oficina, $fila->nombre_oficina, $fila->direccion_oficina, $fila->coordenada_oficina);
                                           echo boton_tabla($array,"cambiar_editar");
                                           echo "</tr>";
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Fin de la TABLA -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- Fin CUERPO DE LA SECCIÓN -->
        <!-- ============================================================== -->
    </div> 
</div>
<!-- ============================================================== -->
<!-- Fin de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->

<script>
$(function(){
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    
    $(function() {
        $('#notificacion').click(function(){
            swal("Éxito!", "<?php echo $notificacion; ?>.", "success")
        });
    });
});
</script>