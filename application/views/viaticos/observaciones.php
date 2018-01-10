<script type="text/javascript">
    function cambiar_editar(id,nombre,caracteristicas,bandera){
        $("#idb").val(id);
        $("#nombre").val(nombre);
        $("#caracteristicas").val(caracteristicas);

        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt-tabla").hide(0);
            $("#cnt_form").show(0);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar Banco");
        }else{
            eliminar_banco();
        }
    }

    function cambiar_nuevo(){
        $("#idb").val("");
        $("#nombre").val("");
        $("#caracteristicas").val("");
        $("#band").val("save");
        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nuevo banco");
    }

    function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function editar_banco(){
        $("#band").val("edit");
        $("#submit").click();
    }

    function eliminar_banco(){
        $("#band").val("delete");
        swal({   
            title: "¿Está seguro?",   
            text: "¡Desea eliminar el registro!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#fc4b6c",   
            confirmButtonText: "Sí, deseo eliminar!",   
            closeOnConfirm: false 
        }, function(){   
            $("#submit").click(); 
        });
    }

    function iniciar(){
        tablabancos();
    }

    function objetoAjax(){
        var xmlhttp = false;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } catch (E) { xmlhttp = false; }
        }
        if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp = new XMLHttpRequest(); }
        return xmlhttp;
    }

    function tablabancos(){          
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/configuraciones/bancos/tabla_bancos", function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });  
    }

</script>

<!-- ============================================================== -->
<!-- Inicio de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- TITULO de la página de sección -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="align-self-center" align="center">
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de observación de solicitudes</h3>
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
            <div class="col-lg-1"></div>
            <div class="col-lg-10" id="cnt_form" style="display: block;">
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Listado de solicitudes</h4>
                    </div>
                    <div class="card-body b-t">




                        <table id="demo-foo-row-toggler" class="table toggle-circle table-hover">
                            <thead>
                                <tr>
                                    <th data-toggle="true"> First Name </th>
                                    <th> Last Name </th>
                                    <th data-hide="phone"> Job Title </th>
                                    <th data-hide="all"> DOB </th>
                                    <th data-hide="all"> Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Isidra</td>
                                    <td>Boudreaux</td>
                                    <td>Traffic Court Referee</td>
                                    <td>22 Jun 1972</td>
                                    <td><span class="label label-table label-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>Shona</td>
                                    <td>Woldt</td>
                                    <td>Airline Transport Pilot</td>
                                    <td>3 Oct 1981</td>
                                    <td><span class="label label-table label-inverse">Disabled</span></td>
                                </tr>
                                <tr>
                                    <td>Granville</td>
                                    <td>Leonardo</td>
                                    <td>Business Services Sales Representative</td>
                                    <td>19 Apr 1969</td>
                                    <td><span class="label label-table label-danger">Suspended</span></td>
                                </tr>
                                <tr>
                                    <td>Easer</td>
                                    <td>Dragoo</td>
                                    <td>Drywall Stripper</td>
                                    <td>13 Dec 1977</td>
                                    <td><span class="label label-table label-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>Maple</td>
                                    <td>Halladay</td>
                                    <td>Aviation Tactical Readiness Officer</td>
                                    <td>30 Dec 1991</td>
                                    <td><span class="label label-table label-danger">Suspended</span></td>
                                </tr>
                            </tbody>
                        </table>





                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <!-- ============================================================== -->
            <!-- Fin del FORMULARIO de gestión -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Inicio de la TABLA -->
            <!-- ============================================================== -->
            <div class="col-lg-12" id="cnt-tabla">

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
    $("#formajax").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
        formData.append("dato", "valor");
        
        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/bancos/gestionar_bancos",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "exito"){
                cerrar_mantenimiento();
                if($("#band").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                tablabancos();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

$(function(){  

    $(document).ready(function(){
        $('#demo-foo-row-toggler').footable();
    });

});
</script>