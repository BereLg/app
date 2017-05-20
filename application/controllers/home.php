<?php
/**
* crear la estructura clásica de una clase
* mediante un constructor
*/
class Home extends CI_Controller {
	//creamos el constructor
	public function _construct(){
		parent::_construct();
	}
	
	//este metodo llama a la pagina principal
	public function index(){
		$data = array('titulo' => 'Aplicacion');
		$this->load->view('head_view',$data);
		$this->load->view('menu_view');
		$this->load->view('index');
		$this->load->view('footer_view');
	}
	
	
	//A partir de este método utilizo la extension propia para cargar varias vistas
	public function quienes_somos(){
		$data = array('titulo' => 'Quienes somos');
		$this->load->multiple_views(array('head_view','menu_view','quienes_somos','footer_view'), $data);

	}
	public function carrito(){
		$data = array('titulo' => 'Carrito');
		$this->load->multiple_views(array('head_view','menu_view','carrito','footer_view'), $data);
	}
	
	public function login(){
		$data = array('titulo' => 'Acceso');
		$this->load->multiple_views(array('head_view','menu_view','login_views','footer_view'), $data);
	}
	
	public function registro(){
		$data = array('titulo' => 'Acceso');
		$this->load->multiple_views(array('head_view','menu_view','registro_view','footer_view'), $data);
	}
}
/**
* fin de controller home.php
* ubicacion application/controllers/home.php
*/