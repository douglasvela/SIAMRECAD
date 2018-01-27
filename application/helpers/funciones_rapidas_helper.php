<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/***********************************
	CREAR TABLA:	
	Genera el body de una tabla, solicitando solamente los datos que conformaran la tabla 
	y las conlumnas que se desean presentar (genera el botón para modificaciones automaticamente).
************************************/
	function generar_boton($opciones,$funcion,$color,$icono,$title){
		$var = ""; $boton = "";
		foreach ($opciones as $otro) {
			$var .= '"'.$otro.'",';
		}
		$var = substr($var, 0, -1);
		$boton .= "<button type='button' class='btn waves-effect waves-light btn-rounded btn-sm ".$color."' onClick='".$funcion."(".$var.");' data-toggle='tooltip' title='".$title."'><span class='".$icono."'></span></button>&nbsp;";
		return $boton;
	}

	function saltos_sql($cadena){
		return str_replace(array("\r\n", "\r", "\n"), " ", $cadena);
	}

	function endKey($array){
		end($array);
		return key($array);
	}


/***********************************
	CREAR NOTIFICACIONES:
	Genera el codigo para mostrar una notificación, solicitando solamente la descripción del mensaje.
************************************/
	function crear_notificacion($descripcion){
		$notificacion = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
		  $notificacion .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
		    $notificacion .= '<span aria-hidden="true">&times;</span>';
		  $notificacion .= '</button>';
		  $notificacion .= $descripcion;
		$notificacion .= '</div>';

		return $notificacion;
	}


	function crear_combo($titulo,$id, $lista,$datos,$funcion){
		$combo = '<label for="'.$id.'">'.$titulo.':</label>';
		$combo .= '<div class="input-group-btn">';
		$combo .= '<select class="form-control" id="'.$id.'" name="'.$id.'" onChange="cambiarBtnCombo('."'".$id."'".');">';
		$combo .= '<option value="">[Seleccione una opción]</option>';
		
		if(!empty($lista)){
			foreach ($lista->result() as $fila) {
				$combo .= "<option value='".$fila->$datos[0]."'>".$fila->$datos[1]."</option>";
			}
		}

		$combo .= '</select>';
		if(!empty($funcion)){
			$combo .= '<span class="input-group-btn">';
	        $combo .= '<button class="btn btn-success" id="btncb1" onClick="'.$funcion."('"."guardar"."')".'" type="button"><span class="fa fa-plus" style="padding: 2px;"></span></button>';
	        $combo .= '<button class="btn btn-info" style="display: none;" id="btncb2" onClick="'.$funcion."('"."modificar"."')".'" type="button"><span class="fa fa-cog" style="padding: 2px;"></span></button>';
	      	$combo .= '</span>';
	    }
		$combo .= '</div><br>';

		return $combo;
	}

	function parrafo($cadena){
        $cadena = ucfirst(mb_strtolower($cadena));
        return ($cadena);
    }

    function nombres($cadena){
        $cadena = ucwords(mb_strtolower($cadena));
        return ($cadena);
    }
?>