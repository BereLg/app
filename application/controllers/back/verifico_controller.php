<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Verifico_controller
 *
 * @package     Controller/back
 * @author      Lic. Romero, Carlos Alberto
*/ 
class Verifico_controller extends CI_Controller {

    /**
     * Constructor del Controller
     *
     * @package     back
     * Cargo modelo socio
    */ 
    function __construct()
    {
        parent::__construct();
        $this->load->model('socio','',TRUE);

    }
    /**
    * Función principal del controlador ejecuta por defecto si no nombramos el metodo.
    * Ejecuta la validación del formulario y si es FALSE muestra la vista de login,
    * Si redige a la ruta panel si es correcta la verificación y logeo
    * @access  public
    */ 
    function index()
    {
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Pass', 'trim|required|xss_clean|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            $this->load->view('back/login_views');
        }
        else
        {
            //Go to private area
            redirect('panel', 'refresh');
        }

    }
    /**
    * Función que chequea los datos en la base si exiten.
    * Si es correcto creo un arreglo de session del socio
    * Si es incorrecto se muestra un mensaje de error de datos ingresados
    * @access  public
    */ 
    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('usuario');
        //query the database
        $result = $this->socio->login($username, $password);
 
        if($result)
        {
           $sess_array = array();
           foreach($result as $row)
           {
                $sess_array = array(
                    'id' => $row->id,
                    'usuario' => $row->usuario
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database', '<div class="alert alert-danger">usuario o contraseña invalido</div>');
            return false;
        }
    }
}
/* End of file verifico_controller.php */
/* Location: ./application/controllers/back/verifico_controller.php */
