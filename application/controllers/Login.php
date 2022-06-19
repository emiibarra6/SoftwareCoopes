<?php defined('BASEPATH') or exit('No direct script access allowed');

//Controlador manejo de login
class Login extends CI_Controller
{
	//Funcion constructor
	public function __construct()
	{
		parent::__construct();
		//Carga modelo
		$this->load->model('m_usuario');
		//Si no se esta saliendo y existe session de logueo
		//es decir esta logueado --> Redirijo
		if ($this->uri->segment(2) != "out") {
			if (isset($_SESSION['login'])) {
				redirect('listar-productos');
			}
		}
	}

	//Funcion de inicial o defecto
	public function index()
	{
		$data['titulo'] = "Login";
		$data['scripts'] = array("login.js");
		//Carga de vistas de login para modulo rrhh
		$this->load->view('encabezadoLogin', $data);
		$this->load->view('login');
		$this->load->view('pie', $data);
	}

	//Funcion que hace login 
	public function login()
	{
		try {
			$data['titulo'] = "Login";
			$data['scripts'] = array("login.js");
			//Levanta del post info
			$usuario = $this->input->post("usuario");
			$pass = $this->input->post("pass");
			//Trae el usario que se loguea
			$respuesta = $this->m_usuario->login($usuario);
			//Valida que no exista error en base
			if ($respuesta['mensajeErrorDB'] == "") {
				//Valida que el usuario exista
				if ($respuesta['existeUsuario'] == true) {
					//Valida que la clave sea correcta
					$dataUsuario = $respuesta['row'];
					if ((password_verify($pass, $dataUsuario->pass)) && ($dataUsuario->activo)) {
						//Guarda datos de sesion de usuario logueado
						$data = [
							"usuario" => $dataUsuario->usuario,
							"login" => TRUE,
							"cambioclave" => $dataUsuario->blanqueo,
							"id_rol" => $dataUsuario->id_rol,
						];
						//Guarda en session datos importantes de usuario logueado
						$this->session->set_userdata($data);
						//Si esta activo el cambio de clave (blanqueo)
						if ($dataUsuario->blanqueo) {
							redirect('cambioclave');
						} else {
							//Redirige a pagina de inicio de usuarios logueados
							redirect('menu');
						}
					} else {
						//Carga de vistas de login incorrecto por pass
						$data['respuestalogin'] = "Contraseña incorrecta";
					}
				} else {
					//Carga de vistas de login usuarios no valido
					$data['respuestalogin'] = "Usuario no valido";
				}
				//Carga de vistas de login
				$this->load->view('encabezadoLogin', $data);
				$this->load->view('login', $data);
				$this->load->view('pie', $data);
			} else {
				//Lanza error de bd
				throw new Exception($respuesta['mensajeErrorDB']);
			}
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	//Funcion cierra sesion
	public function out()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
}
