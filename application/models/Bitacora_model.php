<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bitacora_model extends CI_Model {
	function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
	}
	function bitacora($data){
        $user = $this->session->userdata('id_usuario_viatico'); $fecha = date('Y-m-d H:i:s'); $ip = $this->get_real_ip(); $id_sistema = $id_sistema = $this->config->item("id_sistema");
		if($this->db->insert('glb_bitacora', array('id_sistema' => $id_sistema, 'id_usuario' => $user, 'descripcion' => $data['descripcion'], 'fecha_hora' => $fecha, 'IP' => $ip, 'id_accion' => $data['id_accion']))){
			return "exito"; }else{ return "fracaso"; }
	}
	public function get_real_ip(){
        if (isset($_SERVER["HTTP_CLIENT_IP"])){ return $_SERVER["HTTP_CLIENT_IP"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){ return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){ return $_SERVER["HTTP_X_FORWARDED"];
        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){ return $_SERVER["HTTP_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_FORWARDED"])){ return $_SERVER["HTTP_FORWARDED"];
        }else{ return $_SERVER["REMOTE_ADDR"]; }
    }
}
?>