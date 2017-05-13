<?php
class Articulo_model extends CI_Model{
	public function _construct(){
		parent::_construct();
		
	}
	//obtener los campos de la tabla articulos
	public function obtener_todos(){
		$this->db->select('id_articulo,nombre_articulo,contenido_articulo,fecha_articulo,id_categoria');
		$this->db->from('articulos');
		$consulta = $this->db->get();
		$resultado = $consulta->result();
		return $resultado;
	}
}	
