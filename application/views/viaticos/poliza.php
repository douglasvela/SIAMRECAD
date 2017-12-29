
  <div class="page-wrapper">
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- TITULO de la página de sección -->
        <!-- ============================================================== -->
       <div class="table-responsive">

            <div class="align-self-center" align="center">
                 <h4 align="center" class="card-title m-b-0">MINISTERIO DE TRABAJO Y PREVISION SOCIAL <p align="center">POLIZA DE REINTEGRO DEL FONDO CIRCULANTE</p></h4>
   
        
     
          <table width="1206" height="166" border="0">
            <tr>
              <td><h5 align="justify">INSTITUCIÓN:</h5></td>
              <td ><div align="justify"><span class="controls">
                <input type="text" id="nombre2" name="nombre2" class="form-control" value="MINISTERIO DE TRABAJO Y PREVISION SOCIAL" disabled=""/>
              </span></div></td>
              <td width="326"><h5 align="justify">No. POLIZA: </h5></td>
              <td width="257"><div align="justify"><span class="controls">
                <input type="text" id="nombre7" name="nombre7" class="form-control"  />
              </span></div></td>
            </tr>
            <tr>
              <td height="25"><h5 align="justify">CÓDIGO PRESUPUESTARIO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre3" name="nombre3" class="form-control"/>
              </span></div></td>
              <td> <h5 align="justify"> MES:</h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre8" name="nombre8" class="form-control" />
              </span></div></td>
            </tr>
            <tr>
              <td height="25"><h5 align="justify">DENOMINACIÓN DEL MONTO FIJO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre4" name="nombre4" class="form-control"  />
              </span></div></td>
              <td> <h5 align="justify"> EJERCICIO FINANCIERO FISCAL: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre9" name="nombre9" class="form-control"/>
              </span></div></td>
            </tr>
            <tr>
              <td height="25"> <h5 align="justify"> MONTO TOTAL DEL REINTEGRO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre5" name="nombre5" class="form-control" />
              </span></div></td>
              <td> <h5 align="justify"> NOMBRE DEL BANCO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre10" name="nombre10" class="form-control"/>
              </span></div></td>
            </tr>
            <tr>
              <td height="25"> <h5 align="justify">DENOMINACIÓN DEL MONTO FIJO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre6" name="nombre6" class="form-control" required="" data-validation-required-message="Este campo es requerido" />
              </span></div></td>
              <td> <h5 align="justify">No. CUENTA BANCARIA: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre11" name="nombre11" class="form-control" required="required" data-validation-required-message="Este campo es requerido" />
              </span></div></td>
            </tr>
            <tr>
              <td height="25"> <h5 align="justify">CANTIDAD EN LETRAS: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre" name="nombre" class="form-control" required="" data-validation-required-message="Este campo es requerido" />
              </span></div></td>
              <td><h5 align="justify">No. COMPROMISO PRESUPUESTARIO:</h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre12" name="nombre12" class="form-control" />
              </span></div></td>
            </tr>
          </table>
    </div>
    

   
     
   

   <div class="card">
   
      <div class="card-body b-t"  style="padding-top: 7px; font-size: 14px;">
      
            <table id="myTable" class="table table-hover product-overview"  >
                <thead class="bg-info text-white">
               
                    <tr>
                    <th rowspan="2">No.DOC</th>
                    <th rowspan="2">No.POLIZA</th>
                    <th rowspan="2">MES DE LA POLIZA</th>
                    <th rowspan="2">FECHA DE ELABORACION DEL FORMULARIO</th>
                    <th rowspan="2">No. CHEQUE O CARGO CTA</th>
                    <th rowspan="2">CÓDIGO DEL EMPLEADO</th>
                    <th rowspan="2">FECHA DE MISIÓN</th>
                    <th rowspan="2">SEDE</th>
                    <th rowspan="2">CARGO FUNCIONAL</th>
                    <th  rowspan="2">UP/LT</th>
                   <th colspan="4" ><div align="center">DETALLE DE OBJETOS ESPECIFICOS </div></th>
                   <th  rowspan="2" >TOTAL</th>
                    </tr>
                    <tr>
                      <th  >54401</th>
                      <th >VALOR</th>
                      <th >54403</th>
                      <th >VALOR</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                	
                ?>
                </tbody>
    </table>
     </div>
     </div>
 </div>
  
      </div>

</div>




            <script>
$(function(){
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
});
            </script>

