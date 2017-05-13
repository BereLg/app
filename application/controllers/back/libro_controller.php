<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Se encarga de manejar la sesion de un socio, ni no estas logeado no podrás ingresar al panel
session_start();
/**
 * Libro_controller
 *
 * @package     Controller/back
 * @author      Lic. Romero, Carlos Alberto
*/ 
class Libro_controller extends CI_Controller {
	/**
	 * Constructor del Controller
	 *
	 * @package     back
	 * Cargo modelo libro
	*/ 
	function __construct() {
        parent::__construct();
        $this->load->model('libro');

    }
    /**
    * Función principal del controlador ejecuta por defecto si no nombramos el metodo.
    * @access  public
    */ 
	public function index()
	{
		$data = array(
		        'libros' => $this->libro->get_libros()
		);
		$this->load->view('back/libro/libro_views',$data);
	}
	/**
	* Llamo a la vista inse_libro_views
	*/
	function form_insert_l(){
		$this->load->view('back/libro/inse_libro_views');
	}
	/**
	* Valida el formulario de libro y si es correcto la validación inserta el registro en la base de datos
	*/
	function insert_libro(){
		//Validación del formulario
		$this->form_validation->set_rules('title', 'Titulo', 'required');
		$this->form_validation->set_rules('edicion', 'Edicion', 'required');
		$this->form_validation->set_rules('editorial', 'Editorial', 'required');
		$this->form_validation->set_rules('anio', 'Año', 'required|numeric');
		$this->form_validation->set_rules('stock', 'Stock', 'required|numeric');
		$this->form_validation->set_rules('stock_minimo', 'Stock Minimo', 'required|numeric');
		$this->form_validation->set_rules('filename', 'FIl', 'callback__image_upload');
		

		//Mensaje del form_validation
		$this->form_validation->set_message('required','<div class="alert alert-danger">El campo %s es obligatorio</div>');
		$this->form_validation->set_message('numeric','<div class="alert alert-danger">El campo %s debe contener un valor numérico</div>'); 
		$this->form_validation->set_message('file_selected_test', '<div class="alert alert-danger">Por favor seleccione archivo de imagen</div>');
		
		if (!$this->form_validation->run())
		{

			$this->load->view('back/libro/inse_libro_views');
		}
		else
		{
			$this->_image_upload();			
		}
	}
	/**
	* Obtiene los datos del archivo imagen.
	* Permite archivos gif, jpg, png
	* Verifica si los datos son correcto en conjunto con la imagen y lo inserta en la tabla correspondiente
	* En la tabla guarda la URL de donde se encuentra la imagen.
	*/
	function _image_upload()
	{
		  $this->load->library('upload');
 
            //Comprueba si hay un archivo cargado
            if (!empty($_FILES['filename']['name']))
            {
                // Especifica la configuración para el archivo
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';       
 
                // Inicializa la configuración para el archivo 
                $this->upload->initialize($config);
 
                
                if ($this->upload->do_upload('filename'))
                {
                	// Mueve archivo a la carpeta indicada en la variable $data
                    $data = $this->upload->data();
                    // Path donde guarda el archivo..
                    $url ="./uploads/".$_FILES['filename']['name'];
                    // Array de datos para insertar en libros 
                    $data = array(
						'titulo'=>$this->input->post('titulo',true),
						'edicion'=>$this->input->post('edicion',true),
						'editorial'=>$this->input->post('editorial',true),
						'anio'=>$this->input->post('anio',true),
						'imagen'=>$url,
						'stock'=>$this->input->post('stock',true),
						'stock_minimo'=>$this->input->post('stock_minimo',true)

					);
					$datos_libros = $this->libro->create_libro($data);
					redirect('libros', 'refresh');
					return TRUE;
                }
                else
                {
                	//Mensaje de error si no existe imagen correcta
                    $imageerrors = $this->upload->display_errors();
					$this->form_validation->set_message('_image_upload', $imageerrors);
					
					return false;
                }
 
            }
	
	}
	
}
/* End of file libro_controller.php */
/* Location: ./application/controllers/back/usuario_controller.php */