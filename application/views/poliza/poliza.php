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
      $cod_presupuestario = $filag->codigo_presupuestario;
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
    var num_poliza = $("#nombre1").val();
    var newName = 'AjaxCall', xhr = new XMLHttpRequest();

    xhr.open('GET', "<?php echo site_url(); ?>/poliza/poliza/tabla_generar_poliza?mes="+mes+"&anio="+anio+"&num_poliza="+num_poliza);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText !== newName) {
            document.getElementById("cnt_generar_poliza").innerHTML = xhr.responseText;

            $("#nombre5").val($("#total").val());
            $("#nombre6").text($("#total_texto").val());
            
        }else if (xhr.status !== 200) {
            swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de poliza generada no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
        }
    };
    xhr.send(encodeURI('name=' + newName));
  }

  function recorrer_poliza(){
    var filas = $("#tabla_poliza>tbody").find("tr");

    if((filas.length-1) > 0){

      var script = "INSERT INTO org_departamento (no_doc, no_poliz, mes_poliza, fecha_elaboracion, no_cuenta_cheque, nr, fecha_mision, nombre_empleado, detalle_mision, sede, cargo_funcional, linea_presup1, viatico, pasaje, total, mes, anio, cuenta_bancaria, cod_presupuestario) VALUES\n";

      for(i=0; i< (filas.length-1); i++){
        var celdas = $(filas[i]).children("td");
        var ndocu = $(celdas[0]).text().trim();
        var mespo = $(celdas[2]).text().trim();
        var felab = $(celdas[3]).text().trim();
        var ncuen = $(celdas[4]).text().trim();
        var nremp = $(celdas[5]).text().trim();
        var fmisi = $(celdas[6]).text().trim();
        var nomem = $(celdas[7]).text().trim();
        var dmisi = $(celdas[8]).text().trim();
        var csede = $(celdas[9]).text().trim();
        var cargo = $(celdas[10]).text().trim();
        var linea = $(celdas[11]).text().trim();
        var viati = $(celdas[12]).text().trim();
        var pasaj = $(celdas[13]).text().trim();
        var total = $(celdas[14]).text().trim();

        var mescb = $("#nombre7").val();
        var anioc = $("#nombre8").val();
        var mtpsc = $("#nombre10").val();
        var cpres = $("#nombre3").val();
        var npoli = $("#nombre1").val();


        if(i == (filas.length-2)){
          script += "('"+ndocu+"', '"+npoli+"', '"+mespo+"', '"+felab+"', '"+ncuen+"', '"+nremp+"', '"+fmisi+"', '"+nomem+"', '"+dmisi+"', '"+csede+"', '"+cargo+"', '"+linea+"', '"+viati+"', '"+pasaj+"', '"+total+"', '"+mescb+"', '"+anioc+"', '"+mtpsc+"', '"+cpres+"');";
        }else{
          script += "('"+ndocu+"', '"+npoli+"', '"+mespo+"', '"+felab+"', '"+ncuen+"', '"+nremp+"', '"+fmisi+"', '"+nomem+"', '"+dmisi+"', '"+csede+"', '"+cargo+"', '"+linea+"', '"+viati+"', '"+pasaj+"', '"+total+"', '"+mescb+"', '"+anioc+"', '"+mtpsc+"', '"+cpres+"'),\n";
        }
      }

      $("#area").val(script)
    }else{
      swal({ title: "Póliza vacía", text: "No se puede generar una poliza sin viáticos.", type: "warning", showConfirmButton: true });
    }

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

          <?php
            $poliza = $this->db->query("SELECT no_poliz FROM vyp_poliza WHERE anio = '".date("Y")."' ORDER BY no_poliz DESC LIMIT 1");

            $ult_poliza = 1;
            if($poliza->num_rows() > 0){
                foreach ($poliza->result() as $fila2) {
                  $ult_poliza = intval($fila2->no_poliz)+1;
                }
            }
          ?>
     
          <table width="1206" height="166" border="0">
            <tr>
              <td width="326"><h5 align="justify">No. POLIZA: </h5></td>
              <td width="257"><div align="justify"><span class="controls">
                <input type="text" id="nombre1" name="nombre1" class="form-control" onchange="tabla_generar_poliza();" value="<?php echo $ult_poliza; ?>"/>
              </span></div></td>
              <td> <h5 align="justify"> MES:</h5></td>
              <td><div align="justify"><span class="controls">
                <select class="custom-select" id="nombre7" style="width: 100%; background-color: #fff;" onchange="tabla_generar_poliza();">
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
                <input type="text" id="nombre3" name="nombre3" class="form-control" value="<?php echo $cod_presupuestario; ?>" />
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
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                    <input type="number" id="nombre5" name="nombre5" class="form-control" required="">
                </div>
              </span></div></td>
              <td><h5 align="justify">No. COMPROMISO PRESUPUESTARIO:</h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre11" name="nombre11" class="form-control" />
              </span></div></td>
            </tr>
            <tr>
              <td height="25"> <h5 align="justify">CANTIDAD EN LETRAS: </h5></td>
              <td><div align="justify"><span class="controls">
              <small id="nombre6"></small>
              </span></div></td>
              <td><h5 align="justify">FECHA DE CANCELADO: </h5></td>
              <td><div align="justify"><span class="controls">
                <input type="text" id="nombre12" name="nombre12" class="form-control" />
              </span></div></td>
            </tr>
          </table>
    </div>
   

    <div id="cnt_generar_poliza"></div>

    <div align="right">
      <button type="button" onclick="" class="btn btn-info">Vista previa</button>
      <button type="button" onclick="recorrer_poliza();" class="btn btn-info">Generar póliza</button>
    </div>
    
    <br>

    <div class="form-group" style="display: block;">
        <textarea id="area" class="form-control" rows="10"></textarea>
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