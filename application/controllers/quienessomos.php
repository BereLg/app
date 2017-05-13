<?php
/*crear la estructura clásica de una clase
*mediante un constructor
*/
class Quienessomos extends CI_Controller {
	//creamos el constructor
	public function _construct(){
		parent::_construct();
		
		}
	
	//este metodo llama al controlador quienessomos
public function index(){
		$this->load->view('head_view');
		$this->load->view('menu_view');
		$this->load->view('quienes_somos');
		$this->load->view('footer_view');

	}}