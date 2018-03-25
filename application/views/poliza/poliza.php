
<?php

$monto = number_format(100.50, 2, '.', '');

$decs = (($monto-intval($monto))*100);

if($decs == 0){
  $decs = "00";
}

//echo$formato_dinero = NumeroALetras::convertir($monto)." ".$decs."/100";
  
class NumeroALetras
{
    private static $UNIDADES = [
        '',
        'UN ',
        'DOS ',
        'TRES ',
        'CUATRO ',
        'CINCO ',
        'SEIS ',
        'SIETE ',
        'OCHO ',
        'NUEVE ',
        'DIEZ ',
        'ONCE ',
        'DOCE ',
        'TRECE ',
        'CATORCE ',
        'QUINCE ',
        'DIECISEIS ',
        'DIECISIETE ',
        'DIECIOCHO ',
        'DIECINUEVE ',
        'VEINTE '
    ];
    private static $DECENAS = [
        'VENTI',
        'TREINTA ',
        'CUARENTA ',
        'CINCUENTA ',
        'SESENTA ',
        'SETENTA ',
        'OCHENTA ',
        'NOVENTA ',
        'CIEN '
    ];
    private static $CENTENAS = [
        'CIENTO ',
        'DOSCIENTOS ',
        'TRESCIENTOS ',
        'CUATROCIENTOS ',
        'QUINIENTOS ',
        'SEISCIENTOS ',
        'SETECIENTOS ',
        'OCHOCIENTOS ',
        'NOVECIENTOS '
    ];
    public static function convertir($number, $moneda = '', $centimos = '', $forzarCentimos = false)
    {
        $converted = '';
        $decimales = '';
        if (($number < 0) || ($number > 999999999)) {
            return 'No es posible convertir el numero a letras';
        }
        $div_decimales = explode('.',$number);
        if(count($div_decimales) > 1){
            $number = $div_decimales[0];
            $decNumberStr = (string) $div_decimales[1];
            if(strlen($decNumberStr) == 2){
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT);
                $decCientos = substr($decNumberStrFill, 6);
                $decimales = self::convertGroup($decCientos);
            }
        }
        else if (count($div_decimales) == 1 && $forzarCentimos){
            $decimales = 'CERO ';
        }
        $numberStr = (string) $number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);
        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'UN MILLON ';
            } else if (intval($millones) > 0) {
                $converted .= sprintf('%sMILLONES ', self::convertGroup($millones));
            }
        }
        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'MIL ';
            } else if (intval($miles) > 0) {
                $converted .= sprintf('%sMIL ', self::convertGroup($miles));
            }
        }
        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'UN ';
            } else if (intval($cientos) > 0) {
                $converted .= sprintf('%s ', self::convertGroup($cientos));
            }
        }
        if(empty($decimales)){
            $valor_convertido = $converted . strtoupper($moneda);
        } else {
            $valor_convertido = $converted . strtoupper($moneda);//' CON ' . $decimales . ' ' . strtoupper($centimos);
        }
        return $valor_convertido;
    }
    private static function convertGroup($n)
    {
        $output = '';
        if ($n == '100') {
            $output = "CIEN ";
        } else if ($n[0] !== '0') {
            $output = self::$CENTENAS[$n[0] - 1];
        }
        $k = intval(substr($n,1));
        if ($k <= 20) {
            $output .= self::$UNIDADES[$k];
        } else {
            if(($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sY %s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            }
        }
        return $output;
    }
}

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
                <input type="text" id="nombre8" name="nombre8" class="form-control" value="<?php echo date("Y"); ?>" />
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
      <div class="table-responsive">
            <table id="" class="table table-hover product-overview"  >
                <thead class="bg-info text-white">
               
                    <tr>
                    <th width="59" rowspan="2">No. DOC</th>
                    <th width="81" rowspan="2">No. POLIZA</th>
                    <th width="60" rowspan="2">MES POLIZA</th>
                    <th width="130" rowspan="2">FECHA ELABORACION</th>
                    <th width="75" rowspan="2">No. CHEQUE/ CUENTA</th>
                    <th width="90" rowspan="2">CÓDIGO EMPLEADO</th>
                    <th width="67" rowspan="2">FECHA MISIÓN</th>
                    <th width="94" rowspan="2">NOMBRE EMPLEADO</th>
                    <th width="80" rowspan="2">DETALLE MISIÓN</th>
                    <th width="41" rowspan="2">SEDE</th>
                    <th width="96" rowspan="2">CARGO FUNCIONAL</th>
                    <th width="44"  rowspan="2">UP/LT</th>
                   <th colspan="4" ><div align="center">DETALLE DE OBJETOS ESPECIFICOS </div></th>
                   <th width="67"  rowspan="2" >TOTAL</th>
                    </tr>
                    <tr>
                      <th width="48"  >54401</th>
                      <th width="67" >VALOR</th>
                      <th width="48" >54403</th>
                      <th width="56" >VALOR</th>
                    </tr>
                </thead>
                <tbody>
               
                </tbody>
    </table>
     </div>
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