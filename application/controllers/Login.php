<?php
define("SERVER_MTPS","localhost");
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('bitacora_model');
	}

	public function index()
	{
		$this->load->view('login');
		$this->load->view('templates/footer');
	}

	public function vista_inicio()
	{
		$this->load->view('templates/header');
		$this->load->view('inicio');
		$this->load->view('templates/footer');
	}

	public function verificar_usuario(){
		$data = array(
		'usuario' => $this->input->post('usuario'),
		'password' => $this->input->post('password')
		);

		$response = "";
		
		$usuario = $this->login_model->verificar_usuario($data);// verifica si el usuario existe

		if($usuario == "existe"){
			$estado = $this->login_model->verificar_estado($data);	//verifica si la cuenta está activa
			if($estado == "activo"){
				$log = $this->login_model->verificar_usuario_password($data);	//verifica si el usuario y contraseña en la base 																   de datos es correcto
				if($log == "existe"){
					$response = "exito";
				}else{
					if(SERVER_MTPS == $_SERVER['SERVER_NAME']) {
						$active = $this->ldap_login($data['usuario'],$this->input->post('password'));
						if($active == "login"){
							$response = "exito";
						}else{
							$response = "activeDirectory";
						}
					}else{
						$response = "password";
					}
				}
			}else{
				$response = "estado";
			}
		}else{
			$response = "usuario";
		}
		
		if($response == "exito"){
			$login = $this->login_model->get_data_user($data);
			if($login->num_rows() > 0){
				foreach ($login->result() as $fila) {
				}
				$usuario_data = array(
	               'id_usuario_viatico' => $fila->id_usuario,
	               'usuario_viatico' => $fila->usuario,
	               'nombre_usuario_viatico' => $fila->nombre_completo,
	               'sesion_viatico' => TRUE
	            );
				$this->session->set_userdata($usuario_data);
				$this->bitacora_model->bitacora(array(
	               'id_sistema' => "15",
	               'descripcion' => "El usuario ".$this->input->post('usuario')." inició sesión",
	               'id_accion' => "1"
	            ));			
			}else{
				$response = "sesion";
				$this->session->sess_destroy();
			}
		}

		echo $response;
		
	}

	public function verificar_usuario2(){
		$data = array(
		'usuario' => $this->input->post('usuario'),
		'password' => $this->input->post('password')
		);

		$verificando = $this->login_model->verificar_usuario_password($data);
		if($verificando == "existe"){
			$res = $this->login_model->get_data_user($data);
			if($res->num_rows() > 0){
				foreach ($res->result() as $fila) {
				}
				$usuario_data = array(
	               'id_usuario_viatico' => $fila->id_usuario,
	               'usuario_viatico' => $fila->usuario,
	               'nombre_usuario_viatico' => $fila->nombre_completo,
	               'sesion_viatico' => TRUE
	            );
				$this->session->set_userdata($usuario_data);
				echo "exito";
			}else{
				echo "fracaso";
			}
		}else{
			echo "fracaso";
		}
	}

	public function cerrar_sesion(){
		$this->session->sess_destroy();
		$this->index();
	}

	function ldap_login($user,$pass){			
		$ldaprdn = $user.'@trabajo.local';
		$ldappass = $pass;
		$ds = 'trabajo.local';
		$dn = 'dc=trabajo,dc=local';
		$puertoldap = 389; 
		$ldapconn = ldap_connect($ds,$puertoldap)
		or die("ERROR: No se pudo conectar con el Servidor LDAP."); 
		
		if ($ldapconn){ 
			ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3); 
			ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0); 
			$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
			if ($ldapbind){ 
				return "login";
			}else{ 
				return "error";
			} 
		}else{ 
			return "error";
		}
		ldap_close($ldapconn);
	}
}
?>