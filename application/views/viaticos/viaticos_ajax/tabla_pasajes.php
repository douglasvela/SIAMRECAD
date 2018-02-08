<title>ctn_pasajes</title>
<div class="table-responsive container">
    <table id="target" class="table table-hover product-overview" style="margin-bottom: 0px;">
        <thead class="bg-inverse text-white">
            <tr>
                <th>Fecha</th>
                <th>No. Expediente</th>
                <th>Empresa visitada</th>
                <th>Direccion</th>
                 <th>Monto</th>
                <th>(*)</th>
            </tr>
        </thead>
        <tbody>
            <td style="padding: 7px 5px;">
               <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d" data-date-start-date="-5d" onkeyup="FECHA('fecha')" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha" name="fecha" placeholder="dd/mm/yyyy" style="width: 120px;"> 
            </td>

            <td style="padding: 7px 5px;">
                 <input type="text" id="expediente" name="expediente" class="form-control" style="width: 130px;">
            </td>

            <td style="padding: 7px 5px;">
                <input type="text" id="empresa" name="empresa" class="form-control" required="" data-validation-required-message="Este campo es requerido"> 
            </td>
            <td style="padding: 7px 5px;">
                <input type="text"  id="direccion" name="direccion" class="form-control" required="" placeholder="Escriba la dirección" minlength="3" data-validation-required-message="Este campo es requerido" style="width: 450px;">

            </td>
            <td style="padding: 7px 5px;">
                <input type="text" id="monto" name="monto" class="form-control" required="" data-validation-required-message="Este campo es requerido" style="width: 80px;">
            </td>

            <td style="padding: 7px 5px;">
              <button type="button" class="btn waves-effect waves-light btn-rounded btn-sm btn-success2" data-toggle="tooltip" title="" data-original-title="Editar"><span class="fa fa-plus"></span></button> 
            </td>
            

        </tbody>
    </table>
    <hr style="margin-top: 0px;">
</div>