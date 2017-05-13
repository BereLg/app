<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Se encarga de manejar la sesion de un socio, ni no estas logeado no podrás ingresar al panel
session_start();
/**
 * Socio_controller
 *
 * @package     Controller/back
 * @author      Lic. Romero, Carlos Alberto
*/ 
class Socio_controller extends CI_Controller {

	/**
	 * Constructor del Controller
	 *
	 * @package     back
	 * Cargo modelo socio
	*/ 
	function __construct() {
        parent::__construct();
        $this->load->model('socio');
    }

    /**
    * Función principal del controlador ejecuta por defecto si no nombramos el metodo.
    * @access  public
    */ 
	public function index()
	{
		$this->load->view('back/login_views');
	}
	/**
    * Función si existe usuario activo muestra la vista con todos los socios registrados
    * Si no existe sesión me redirige a la  ruta panel
    * @access  public
    */ 
	public function all()
	{
		if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $dat['usuario'] = $session_data['usuario'];
            $data = array(
		        'socios' => $this->socio->get_socios()
		    );
            $this->load->view('back/socio/socio_views', array_merge($dat, $data));
        }
        else
        {
            //If no session, redirect to login page
            redirect('panel', 'refresh');
        }
		
	}
	/**
	* Llamo a la vista inse_socio_views
	*/
	function form_insert(){
		$this->load->view('back/socio/inse_socio_views');
	}
	/**
    * Función que llama al insertar datos
    * @access  public
    */ 
	function insert_socio(){
		//Validación del formulario
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		$this->form_validation->set_rules('dias_prestamos', 'Dias Prestados', 'required|numeric');
		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');

		//Mensaje del form_validation
		$this->form_validation->set_message('required','<div class="alert alert-danger">El campo %s es obligatorio</div>');     
		$this->form_validation->set_message('numeric','<div class="alert alert-danger">El campo %s debe contener un valor numérico</div>');           

		$pass = $this->input->post('pass',true);
		$data = array(
			'nombre'=>$this->input->post('nombre',true),
			'apellido'=>$this->input->post('apellido',true),
			'dias_prestamos'=>$this->input->post('dias_prestamos',true),
			'usuario'=>$this->input->post('usuario',true),
			'pass'=>base64_encode($pass)
			);
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('back/socio/inse_socio_views');
		}
		else
		{
			//Envio array el metodo insert para registro de datos
			$datos_socios = $this->socio->create_socio($data);
			redirect('datos', 'refresh');
		}	
	}
	/**
    * Función edit que obtiene todos los datos del socio referenciado por un id
    * y lo muestra en la vista back/edit_socio_views con el parametro $data
    * @access  public
    */ 
	function edit(){
		$id = $this->uri->segment(2);
		$datos_socios = $this->socio->update_socios($id);
		if ($datos_socios != FALSE) {
			foreach ($datos_socios->result() as $row) {
				$nombre = $row->nombre;
				$apellido = $row->apellido;
				$dias_prestamos = $row->dias_prestamos;
				$usuario = $row->usuario;
				$pass = base64_decode($row->pass);


			}
			$data = array('socio' =>$datos_socios,
						  'id'=>$id,
						  'nombre'=>$nombre,
						  'apellido'=>$apellido,
						  'dias_prestamos'=>$dias_prestamos,
						  'usuario'=>$usuario,
						  'pass'=>$pass
					);
		} else {
			return FALSE;
		}		
		$this->load->view('back/socio/edit_socio_views',$data);
	}
	/**
    * Función editar_socio obtiene los datos de la vista back/edit_socio_views
    * y ejecuta el metodo para actualizar los datos del socio, si es correcto la actualización
    * Valido formulario
    * redirige a la ruta mis datos
    * @access  public
    */ 
	function editar_socio(){
		//Validación del formulario
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		$this->form_validation->set_rules('dias_prestamos', 'Dias Prestados', 'required|numeric');
		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');

		//Mensaje del form_validation
		$this->form_validation->set_message('required','<div class="alert alert-danger">El campo %s es obligatorio</div>');    
		$this->form_validation->set_message('numeric','<div class="alert alert-danger">El campo %s debe contener un valor numérico</div>');         

		$id = $this->uri->segment(2);
		$pass = $this->input->post('pass',true);
		$data = array(
			'id'=>$id,
			'nombre'=>$this->input->post('nombre',true),
			'apellido'=>$this->input->post('apellido',true),
			'dias_prestamos'=>$this->input->post('dias_prestamos',true),
			'usuario'=>$this->input->post('usuario',true)
			);
		
		if ($this->form_validation->run() == FALSE)
		{
			//Si hay error en algun campo del formulario la clave permanece legible
			$data['pass'] = $pass;

			$this->load->view('back/socio/edit_socio_views',$data);
		}
		else
		{
			//Si la validación del formulario es correcta la clave la encripta
			$data['pass']= base64_encode($pass);

			$this->socio->set_socio($id, $data);
			redirect('datos', 'refresh');
		}
		
		
	}

}
/* End of file usuario_controller.php */
/* Location: ./application/controllers/back/usuario_controller.php */