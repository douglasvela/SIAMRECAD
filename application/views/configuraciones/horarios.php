<!-- ============================================================== -->
<!-- Div de inicio (envoltura) -->
<!-- ============================================================== -->
<div class="page-wrapper">
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Título de la página de sección -->
		<!-- ============================================================== -->
	    <div class="row page-titles">
            <div class="align-self-center" align="center">
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de horario de viáticos</h3>
            </div>
        </div>
        <!-- ============================================================== -->
		<!-- Fin Título de la página de sección -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Cuerpo de la página de sección -->
		<!-- ============================================================== -->
		<div class="row">
            <div class="col-lg-4">
                <div class="card">
                	<div class="card-body bg-success">
                		<h4 class="text-white card-title" style="margin-bottom: 0px;"><span class="mdi mdi-plus"></span> Nuevo viático</h4>
                	</div>
                    <div class="card-body">
                        <form class="m-t-40" style="margin-top: 0px;">
                            <div class="form-group">
                                <h5>Descripción: <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="text" class="form-control" required="" placeholder="desayuno, almuerzo, cena" data-validation-required-message="Este campo es requerido">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Hora inicio: <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="time" name="text" class="form-control" required="" placeholder="desayuno, almuerzo, cena" data-validation-required-message="Este campo es requerido">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Hora fin: <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="time" name="text" class="form-control" required="" placeholder="desayuno, almuerzo, cena" data-validation-required-message="Este campo es requerido">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">

            	<div class="ribbon-wrapper card">
                    <div class="ribbon ribbon-default">Tabla de horario de viáticos</div>
                    <button class="btn ribbon ribbon-corner ribbon-success ribbon-right"><span class="mdi mdi-plus"></span></button>
                    <div class="ribbon-content">
                    	<div class="table-responsive" style="margin-top: 0px;">
                            <table id="myTable" class="table table-bordered">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Descripción</th>
                                        <th>Inicio</th>
                                        <th>Fin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    	<td>1</td>
                                        <td>Desayuno</td>
                                        <td>8:00 am</td>
                                        <td>10:00 am</td>
                                    </tr>
                                    <tr>
                                    	<td>2</td>
                                        <td>Almerzo</td>
                                        <td>12:00 pm</td>
                                        <td>01:00 pm</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- ============================================================== -->
		<!-- Fin Cuerpo de la página de sección -->
		<!-- ============================================================== -->
    </div>

</div>
<!-- ============================================================== -->
<!-- Fin de Div de inicio (envoltura) -->
<!-- ============================================================== -->


<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>