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
	
	public function quienes_somos(){
		$data = array('titulo' => 'Quienes somos');
		$this->load->view('head_view',$data);
		$this->load->view('menu_view');
		$this->load->view('quienes_somos');
		$this->load->view('footer_view');

	}
	public function carrito(){
		$data = array('titulo' => 'Carrito');
		$this->load->view('head_view',$data);
		$this->load->view('menu_view');
		$this->load->view('carrito');
		$this->load->view('footer_view');
	}
	
	public function login(){
		$data = array('titulo' => 'Acceso');
		$this->load->view('head_view',$data);
		$this->load->view('menu_view');
		$this->load->view('login_views');
		$this->load->view('footer_view');
	}
	
	

}
/**
* fin de controller home.php
* ubicacion application/controllers/home.php
*/