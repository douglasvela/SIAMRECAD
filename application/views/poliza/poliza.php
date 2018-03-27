<?php

function mes($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 return strtoupper($nombre);
}


$generalidades = $this->db->query("SELECT * FROM vyp_generalidades");

$id_generalidad = ""; $pasaje = "0.00"; $alojamiento = "0.00"; $num_cuenta = ""; $id_banco = ""; $banco = ""; $num_cuenta = "";
if($generalidades->num_rows() > 0){
    foreach ($generalidades->result() as $filag) {
      $id_generalidad = $filag->id_generalidad;
      $pasaje = $filag->pasaje;
      $alojamiento = $filag->alojamiento;
      $id_banco = $filag->id_banco;
      $banco = mb_strtoupper($filag->banco);
      $num_cuenta = $filag->num_cuenta;
      $limite_poliza = $filag->limite_poliza;
    }
}

?>

<script type="text/javascript">
  function iniciar(){
    tabla_generar_poliza();
  }

  function tabla_generar_poliza(){
    var mes = $("#nombre7").val();
    var anio = $("#nombre8").val();
    var newName = 'AjaxCall', xhr = new XMLHttpRequest();

    xhr.open('GET', "<?php echo site_url(); ?>/poliza/poliza/tabla_generar_poliza?mes="+mes+"&anio="+anio);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText !== newName) {
            document.getElementById("cnt_generar_poliza").innerHTML = xhr.responseText;
            
        }else if (xhr.status !== 200) {
            swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de poliza generada no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
        }
    };
    xhr.send(encodeURI('name=' + newName));
  }


</script>

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
              <td width="326"><h5 align="justify">No. POLIZA: </h5></td>
              <td width="257"><div align="justify"><span class="controls">
                <input type="text" id="nombre1" name="nombre1" class="form-control"  />
              </span></div></td>
              <td> <h5 align="justify"> MES:</h5></td>
              <td><div align="justify"><span class="controls">
                <select class="custom-select" id="nombre7" style="width: 100%; background-color: #fff;">
                  <?php
                    $mes_actual;
                    for($i=1; $i<=12; $i++){

                      if(date("n") == $i){
                        $mes_actual = "selected";
                      }else{
                        $mes_actual = "";
                      }

                      if($i>9){
                        echo '<option value="'.$i.'" '.$mes_actual.'>'.mes($i).'</option>';
                      }else{
                        echo '<option value="0'.$i.'" '.$mes_actual.'>'.mes($i).'</option>';
                      }
                    }
                  ?>
                  </select>
              </span></div></td>
            </tr>
            <tr>
              <td><h5 align="justify">INSTITUCIÓN:</h5></td>
              <td ><div align="justify"><span class="controls">
                <input type="text" id="nombre2" name="nombre2" class="form-control" value="MINISTERIO DE TRABAJO Y PREVISION SOCIAL" disabled=""/>
              </span></div></td>
              <td> <h5 align="justify"> EJERCICIO FINANCIERO FISCAL: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre8" name="nombre8" class="form-control" onchange="tabla_generar_poliza();" value="<?php echo date("Y"); ?>" />
              </span></div></td>
            </tr>
            <tr>
              <td height="25"><h5 align="justify">CÓDIGO PRESUPUESTARIO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre3" name="nombre3" class="form-control"/>
              </span></div></td>
              <td> <h5 align="justify"> NOMBRE DEL BANCO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre9" name="nombre9" class="form-control" value="<?php echo $banco; ?>"/>
              </span></div></td>
            </tr>
            <tr>
              <td height="25"><h5 align="justify">DENOMINACIÓN DEL MONTO FIJO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre4" name="nombre4" class="form-control" value="FONDO CIRCULANTE DEL MTPS" disabled="" />
              </span></div></td>
              <td> <h5 align="justify">No. CUENTA BANCARIA: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre10" name="nombre10" class="form-control" required="required" value="<?php echo $num_cuenta; ?>" />
              </span></div></td>
            </tr>
            <tr>
              <td height="25"> <h5 align="justify"> MONTO TOTAL DEL REINTEGRO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre5" name="nombre5" class="form-control" />
              </span></div></td>
              <td><h5 align="justify">No. COMPROMISO PRESUPUESTARIO:</h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre11" name="nombre11" class="form-control" />
              </span></div></td>
            </tr>
            <tr>
              <td height="25"> <h5 align="justify">CANTIDAD EN LETRAS: </h5></td>
              <td><div align="justify"><span class="controls">
              <input type="text" id="nombre6" name="nombre6" class="form-control" required="" value="" disabled=""/>
              </span></div></td>
              <td><h5 align="justify">FECHA DE CANCELADO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre12" name="nombre12" class="form-control" />
              </span></div></td>
            </tr>
          </table>
    </div>
   

    <div class="card">
      <div class="card-body b-t"  style="padding-top: 7px; font-size: 11px;">
        <div id="cnt_generar_poliza"></div>
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