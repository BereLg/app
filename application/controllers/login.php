<?php 
	
	class Login extends CI_Controller{
		
		function __construct() 
		{
			parent::__construct();
			$this ->load->model('Login_Model');	
		}
		
		function index()
		{  // reglas de validación
			$this->form_validation->set_rules('username', 'Usuario', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Contraseña','md5|required|xss_clean|callback__valid_login');
			
			$this->form_validation->set_message('required', 'el campo %s es requerido');
			$this->form_validation->set_message('_valid_login', 'El usuario o contraseña son incorrectos');
			
			$this -> form_validation -> set_error_delimiters('<ul><li>', '</li></ul>');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data = array('titulo' => 'Error de formulario');
				$this->load->view('head_view',$data);
				$this->load->view('menu_view');
				$this->load->view('login_views');
				$this->load->view('footer_view');
			}
			else{
				$username = $this->input->post('username');
				$data_user = $array = array('user'=> $username, 'logued_in' => TRUE);
				
				// asignamos dos datos a la sesión --> (username y logued_in)									 
				$this->session->set_userdata($data_user); 
				
				$data['title'] = 'Usuario'; 
				$data['user'] = $username;  // = $this->session->userdata('user');
				
				/* $this->load->view('admin/header_admin',$data);
					$this->load->view('admin/admin');
				$this->load->view('front/footer'); */
				redirect(base_url());
				
				
			}
		}
		
		function _valid_login($password)
		{ 
			$username = $this->input->post('username');
			return $this->Login_Model->valid_user($username,$password);
		}
		
		function valid_login_ajax(){
			//verificamos si la petición es via ajax
			if($this->input->is_ajax_request()){
				
				if($this->input->post('username')!==''){
					$username = $this->input->post('username');
					$this->Login_Model->valid_user_ajax($username);	
				}
				}else{
				redirect('login');
			}
			
		} // fin del método valid_login_ajax
		
		function logout(){
			
			$this->session->sess_destroy(); 
			redirect('login');		
		}
		
	}			