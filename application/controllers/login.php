<?php 
	
	class Login extends CI_Controller{
		
		function __construct() 
		{
			parent::__construct();
			$this ->load->model('Login_Model');
			$this->load->model('Users_Model');
		}
		
		function index()
		{  // reglas de validación
			$this->form_validation->set_rules('username', 'Usuario', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Contraseña','md5|required|xss_clean|callback__valid_login');
			//mensajes si falla alguna regla
			$this->form_validation->set_message('required', 'el campo %s es requerido');
			$this->form_validation->set_message('_valid_login', 'El usuario o contraseña son incorrectos');
			//forma en que se muestran los errores
			$this -> form_validation -> set_error_delimiters('<div class="alert alert-danger">', '</div>');
			
			if ($this->form_validation->run() == FALSE)
			{
				//Falla el logueo. Se muestra al usuario el problema.
				$data = array('titulo' => 'Error de formulario');					
				$this->load->multiple_views(['head_view','menu_view','login_views','footer_view'],$data);
			}
			else{
				$username = $this->input->post('username');
				//recupero el usuario mediante el nombre de usuario (en mi caso, el correo)
				$user = $this->Users_Model->get_by_username($username);
				$data_user = array('username'=> $username, 'logued_in' => TRUE);
				//asignamos a la sesión los datos (username y logued_in)
				$this->session->set_userdata($data_user);
				//redirigimos a la página de perfil --> controlador "usuario"
				redirect('perfil/'.$user->id);
			}
		}
		
		function _valid_login($password)
		{
			$username = $this->input->post('username');
			//Verifico si el usuario y la contraseñas pasados existen en la base de datos
			return $this->Login_Model->valid_user($username,$password);
		}
				
		function logout()
		{
			//destruyo la variable de sesion
			$this->session->sess_destroy();
			//direcciono a la página principal
			redirect(base_url());		
		}		
	}			