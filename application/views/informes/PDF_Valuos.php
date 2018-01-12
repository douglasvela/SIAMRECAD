<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
class Pdf extends FPDF
{
/****************************************************************************************************/
var $widths;
var $aligns;
var $cod_entidad;
var $cod_usu;
var $id_val;

function Setentidad($e)
{
    //Set the array of column widths
    $this->cod_entidad=$e;
}
function Set_id_val_valuos($e)
{
    //Set the array of column widths
    $this->id_val=$e;
}

function SetUsuario($s)
{
    //Set the array of column widths
    $this->cod_usu=$s;
}
function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}
/*
function Row($data,$dibujacelda)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=4*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        
        $this->Rect($x,$y,$w,$h);

        $this->MultiCell($w,4,$data[$i],$dibujacelda[$i],$a,'false');
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}*/
function Row($data,$dibujacelda,$fuente,$v=true,$color,$fill)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=4*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        
        //$this->Rect($x,$y,$w,$h);
        $this->SetFillColor($fill[$i][0],$fill[$i][1],$fill[$i][2]);
        $this->SetTextColor($color[$i][0],$color[$i][1],$color[$i][2]);
        $this->SetFont($fuente[$i][0],$fuente[$i][1],$fuente[$i][2]);
        $this->MultiCell($w,4,$data[$i],$dibujacelda[$i],$a,$v[$i]);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function RowCuadro($data,$dibujacelda,$fuente,$v=true,$cuadro,$fill=array(array('12','12','0')))
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=4*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
        
        $xx=$this->GetX();
        $yy=$this->GetY();
        //Draw the border
        
        $this->SetXY($xx,$yy);
         $this->RoundedRect($xx+2, $yy-17, $cuadro[0], $cuadro[1], $cuadro[2],$cuadro[3]);
         $this->SetXY($xx+2,$yy-17);

    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$xx;
        $y=$yy;
        //Draw the border
        
        

        //$this->Rect($x,$y,$w,$h);
       // $this->SetFillColor($fill[$i][0],$fill[$i][1],$fill[$i][2]);
        $this->SetFont($fuente[$i][0],$fuente[$i][1],$fuente[$i][2]);
        $this->MultiCell($w,4,$data[$i],$dibujacelda[$i],$a,$v);

        


        //Put the position to the right of the cell
        $this->SetXY($xx+$w,$yy-0.5);
    }
    //Go to the next line
    $this->Ln($h);
}

function RowPeque($data,$dibujacelda,$fuente,$v=true,$color,$fill)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=2.3*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        
        //$this->Rect($x,$y,$w,$h);
       $this->SetFillColor($fill[$i][0],$fill[$i][1],$fill[$i][2]);
        $this->SetTextColor($color[$i][0],$color[$i][1],$color[$i][2]);
        $this->SetFont($fuente[$i][0],$fuente[$i][1],$fuente[$i][2]);
        $this->MultiCell($w,2.3,$data[$i],$dibujacelda[$i],$a,$v[$i]);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}
function Row1($data,$dibujacelda,$fuente,$v=true)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5.5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        
        //$this->Rect($x,$y,$w,$h);
        $this->SetFont($fuente[$i][0],$fuente[$i][1],$fuente[$i][2]);
        $this->MultiCell($w,5.5,$data[$i],$dibujacelda[$i],$a,$v);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}
function cuadrogrande_salto($ejexx,$ejeyy,$ancho,$alto,$curva,$relleno,$misma=true){
        /*
        datos:
        1er valor: ancho de lado izquierdo
        2do valor: ancho de arriba
        3er valor: ancho del cuadro
        4to valor: alto del cuadro
        5to valor: ancho de las esquinas
        6to valor: D: dibuja borde; FD: dibuja borde y rellena
        */
          $h=2.3*$alto;
    //Issue a page break first if needed
       $this->CheckPageBreak($h);
       $ejex=$this->GetX()+$ejexx;
       
        if($misma==false){
             $ejey=$this->GetY()-4;
             $this->SetXY($ejex,$ejey);
        }else{
             $ejey=$this->GetY();
         $this->SetXY($ejex,$ejey);
        }
         $this->RoundedRect($ejex, $ejey, $ancho, $alto, $curva, $relleno);
        
        if($misma==true){
              $this->SetXY($ejex+$ejexx,$ejey);
        }
    }
function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

function Header()
{
    include_once ("../modelo/Conexion.php");
    include_once ("../modelo/DAO.php");
    $conexions=new Conexion();
    $conexion=$conexions->conectar();
    $DAO=new DAO();
    $suc = $this->cod_entidad[0];
    
    $enti = explode("-",$suc);
    $datosValuoe = $DAO->mostrarAll($conexion,"select * from parametros where par_codigo_entidad='$enti[0]' AND par_codigo_agencia='$enti[1]'");
            foreach ($datosValuoe as $valueValuo) {}
    $this->SetFont('Arial','',10);
    $this->Image('logo.gif',13,6,30,9);
    //$this->Text(145,12,$valueValuo['par_nombre_entidad'],0,'C', 0);
    $this->SetFont('Arial','B',10);
    $this->Text(89,12,utf8_decode("INFORME DE VALUACIÓN"),0,'C', 0);
    $this->Ln(30);
}

function Footer()
{
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    
    include_once ("../modelo/Conexion.php");
    include_once ("../modelo/DAO.php");
    $conexions=new Conexion();
    $conexion=$conexions->conectar();
    $DAO=new DAO();
    $id_usu = $this->cod_usu[0];
    $datosValuo = $DAO->mostrarAll($conexion,"select cli_nombre,cli_apellido,usuario_nombre from usuarios where usuario_nombre='$id_usu'");
            foreach ($datosValuo as $valueValuo1) {}
    $suc = $this->cod_entidad[0];
    $enti = explode("-",$suc);
    $datosValuo2 = $DAO->mostrarAll($conexion,"select * from parametros where  par_codigo_agencia='$suc'");
            foreach ($datosValuo2 as $valueValuo2) {}
    $id_val_valuos=$this->id_val[0];
    $datosfecha = $DAO->mostrarAll($conexion,"select val_fecha_realizacion,firma,sello from val_valuos where id_val_valuos='$id_val_valuos'");
            foreach ($datosfecha as $valuefecha) {}
    $mifecha = explode('-',$valuefecha[0]);

    $fecha =  $mifecha[2]." de ".$meses[$mifecha[1]-1]. " del ".$mifecha[0];
    $this->SetY(-15);
    $this->SetFont('Arial','B',7);
    $this->SetTextColor(3, 3, 3);
    $this->cuadrogrande(9,269,60,4,1,D);
    $this->Text(11,272,$valueValuo2['par_depto'].", ".$fecha,0,'C', 0);
    //$this->cuadrogrande(149,265,60,4,1,D);
    $this->Text(150,268,"F.:",0,0,'L');
    $ruta="firma/";
    if (is_dir($ruta)) {
                 if ($filehandle = opendir($ruta)) {
                      while (false !== ($file = readdir($filehandle))) {
                         if ($file != "." && $file != "..") {
                            $tamanyo = getimagesize($ruta.$file);
                            $ext = $tamanyo['mime']; 
                            $ext1 = explode('/',$ext);
                            $nombre_sin_ext="";
                            $nombre_sin_ext = explode('.',$file);

                            if($valueValuo1[2]==$nombre_sin_ext[0] && $valuefecha[1]=='1'){
                                $this->Image($ruta.'/'.$file,155,262,30,9,$ext1[1]);
                            }
                }
            }
        }
    }
    
    $ruta_sello="sello/";
    if (is_dir($ruta_sello)) {
                 if ($filehandle_sello = opendir($ruta_sello)) {
                      while (false !== ($file_sello = readdir($filehandle_sello))) {
                         if ($file_sello != "." && $file_sello != "..") {
                            $tamanyo_sello = getimagesize($ruta_sello.$file_sello);
                            $ext_sello = $tamanyo_sello['mime']; 
                            $ext_sello1 = explode('/',$ext_sello);
                            $nombre_sin_ext_sello="";
                            $nombre_sin_ext_sello = explode('.',$file_sello);
                            if($valueValuo1[2]==$nombre_sin_ext_sello[0] && $valuefecha[2]=='1'){
                                $this->Image($ruta_sello.'/'.$file_sello,90,256,24,19,$ext_sello1[1]);
                            }
                }
            }
        }
    }
   
    //$this->SetTextColor(255, 255, 255);
    $this->cuadrogrande(147,269,62,4,1,D);
    $this->Text(148,272,"PERITO: ".$valueValuo1[0]." ".$valueValuo1[1],0,0,'L');

}
/**********************************************************************************************/









    function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10, 10);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        $ejeX = 10;
        foreach($cabecera as $fila)
        {
            $this->RoundedRect($ejeX, 10, 30, 7, 2, 'FD');
            $this->CellFitSpace(30,7, utf8_decode($fila),0, 0 , 'C');
            $ejeX = $ejeX + 30;
        }
    }

 
    function datosHorizontal($datos)
    {
        $this->SetXY(10,17);
        $this->SetFont('Arial','',10);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        $ejeY = 17; //Aquí se encuentra la primer CellFitSpace e irá incrementando
        $letra = 'D'; //'D' Dibuja borde de cada CellFitSpace -- 'FD' Dibuja borde y rellena
        foreach($datos as $fila)
        {
            //Por cada 3 CellFitSpace se crea un RoundedRect encimado
            //El parámetro $letra de RoundedRect cambiará en cada iteración
            //para colocar FD y D, la primera iteración es D
            //Solo la celda de enmedio llevará bordes, izquierda y derecha
            //Las celdas laterales colocarlas sin borde
            $this->RoundedRect(10, $ejeY, 90, 7, 2, $letra);
            $this->CellFitSpace(30,7, utf8_decode($fila['nombre']),0, 0 , 'L' );
            $this->CellFitSpace(30,7, utf8_decode($fila['apellido']),'LR', 0 , 'L' );
            $this->CellFitSpace(30,7, utf8_decode($fila['matricula']),0, 0 , 'L' );
 
            $this->Ln();
            //Condición ternaria que cambia el valor de $letra
            ($letra == 'D') ? $letra = 'FD' : $letra = 'D';
            //Aumenta la siguiente posición de Y (recordar que X es fijo)
            //Se suma 7 porque cada celda tiene esa altura
            $ejeY = $ejeY + 7;
        }
    }
    function cuadropequeño($ejex,$ejey,$ancho,$alto,$curva,$relleno){
         $this->SetXY($ejex,$ejey);
         $this->RoundedRect($ejex, $ejey, $ancho, $alto, $curva, $relleno);
    }
    function leyendas($x,$y,$font,$estilo,$tamaño,$ancho,$alto,$datos)
    {
        $this->SetXY($x,$y);
        $this->SetFont($font,$estilo,$tamaño);
       // $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        //$this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $this->CellFitSpace($ancho,$alto, utf8_decode($datos),0, 0 , 'L' );
        $this->Ln();
            
    }
    function leyendasColor($x,$y,$font,$estilo,$tamaño,$ancho,$alto,$datos,$color1,$color2,$color3)
    {
        $this->SetXY($x,$y);
        $this->SetFont($font,$estilo,$tamaño);
       // $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor($color1, $color2, $color3); //Color del texto: Negro
        $this->CellFitSpace($ancho,$alto, utf8_decode($datos),0, 0 , 'L' );
        $this->Ln();
            
    }
    function multicelda($x,$y,$multiAncho,$multiAlto,$font,$estilo,$tamaño,$ancho,$alto,$datos,$justi='')
    {
        $this->SetXY($x,$y);
        $this->SetFont($font,$estilo,$tamaño);
      //  $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        //$this->SetTextColor(3, 3, 3); //Color del texto: Negro
        //$this->CellFitSpace($ancho,$alto, utf8_decode($datos),0, 0 , 'L' );
        $this->MultiCell($multiAncho,$multiAlto,$datos,0, $justi);
        $this->Ln();
            
    }
    function cuadrogrande($ejex,$ejey,$ancho,$alto,$curva,$relleno){
        /*
        datos:
        1er valor: ancho de lado izquierdo
        2do valor: ancho de arriba
        3er valor: ancho del cuadro
        4to valor: alto del cuadro
        5to valor: ancho de las esquinas
        6to valor: D: dibuja borde; FD: dibuja borde y rellena
        */
         $this->SetXY($ejex,$ejey);
         $this->RoundedRect($ejex, $ejey, $ancho, $alto, $curva, $relleno);
         
    }
    
    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
 
    //**************************************************************************************************************
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);
 
        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;
 
        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }
 
        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
 
        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
 
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }
 
    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }
//**********************************************************************************************
 
 function RoundedRect($x, $y, $w, $h, $r, $style = '', $angle = '1234')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' or $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2f %.2f m', ($x+$r)*$k, ($hp-$y)*$k ));
 
        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2f %.2f l', $xc*$k, ($hp-$y)*$k ));
        if (strpos($angle, '2')===false)
            $this->_out(sprintf('%.2f %.2f l', ($x+$w)*$k, ($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
 
        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2f %.2f l', ($x+$w)*$k, ($hp-$yc)*$k));
        if (strpos($angle, '3')===false)
            $this->_out(sprintf('%.2f %.2f l', ($x+$w)*$k, ($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
 
        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2f %.2f l', $xc*$k, ($hp-($y+$h))*$k));
        if (strpos($angle, '4')===false)
            $this->_out(sprintf('%.2f %.2f l', ($x)*$k, ($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
 
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2f %.2f l', ($x)*$k, ($hp-$yc)*$k ));
        if (strpos($angle, '1')===false)
        {
            $this->_out(sprintf('%.2f %.2f l', ($x)*$k, ($hp-$y)*$k ));
            $this->_out(sprintf('%.2f %.2f l', ($x+$r)*$k, ($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }
 
    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }
} // FIN Class PDF
?>