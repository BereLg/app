<?php 
	
	class Usuario extends CI_Controller{
		
		function __construct() 
		{
			parent::__construct();
			$this ->load->model('Users_Model');	
		}
		
		function index($id)
		{
			//obtengo el usuario mediante su id
			$user = $this->Users_Model->get_by_id($id);
			//asigno a $data las variables que paso a la vista
			$data['titulo'] = 'Perfil de '.$user->name; 
			$data['user'] = $user->name;
			//Cargo las vistas
			$this->load->multiple_views(['head_view','menu_view','perfil_view','footer_view'],$data);
		}
		
		function nuevo_usuario()
		{
			//Genero las reglas de validacion
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('apellido', 'Apellido', 'required');
			$this->form_validation->set_rules('email', 'Usuario', 'required|trim|valid_email|is_unique[users.username]');
			$this->form_validation->set_rules('reg_password', 'Contraseña','required|xss_clean');
			$this->form_validation->set_rules('re_password', 'Repetir contraseña', 'required|matches[reg_password]');
			//Mensaje de error si no pasan las reglas
			$this->form_validation->set_message('required','<div class="alert alert-danger">El campo %s es obligatorio</div>');
			$this->form_validation->set_message('matches','<div class="alert alert-danger">Los contraseña ingresada no coincide</div>');
			$pass = $this->input->post('re_password',true);
			//Preparo los datos para guardar en la base, en caso de que pase la validacion
			//Los datos corresponden a los nombres de mi campos de la base de datos
			$data = array(
				'name'=>$this->input->post('nombre',true),
				'last_name'=>$this->input->post('apellido',true),
				'username'=>$this->input->post('email',true),
				'password'=>md5($pass)
			);
			//Si no pasa la validacion de datos
			if ($this->form_validation->run() == FALSE)
			{
				//Muestra la página de registro con el título de error
				$data = array('titulo' => 'Error de formulario');					
				$this->load->multiple_views(['head_view','menu_view','registro_view','footer_view'],$data);
			}
			//Pasa la validacion
			else
			{
				//Envio array al metodo insert para registro de datos
				$usuario = $this->Users_Model->add_user($data);
				$data_user = $array = array('user'=> $usuario, 'logued_in' => TRUE, 'name'=>$data['name']);
				//asigno los datos a la sesion
				$this->session->set_userdata($data_user); 
				//Redirecciono a la pagina de perfil
				redirect('perfil/'.$usuario);
			}	
		}
				
	}