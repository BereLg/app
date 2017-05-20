<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Users_model extends CI_Model{
		
		function get_users(){
			$this->db->select('id, name, last_name, username');
			$query = $this->db->get('users');
			return $query->result();
		}
		
		function get_by_id($id)
		{
			$query = $this->db->get_where('users', array('id' => $id),1);
			return $query->row();
		}
		
		function get_by_username($user)
		{
			$query = $this->db->get_where('users', array('username' => $user),1);
			return $query->row();
		}
		
		function username_check($username)
		{
			$this->db->where('username', $username);
			$query = $this->db->get('users');
			
			if($query->num_rows>0){
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		
		
		function add_user($data)
		{
			$this->db->insert('users', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		
		function edit_user($id)
		{
			$this->db->where('id', $id);
			$query = $this->db->get('users');
			return $query->result();
		}
		
		function update_user($id, $name,$last_name, $username,$password)
		{
			$data = array(
				'name' => $name,
				'last_name' => $last_name,
				'username' => $username,
				'password'=>$password
			);
			$this->db->where('id', $id);
			return $this->db->update('users', $data);
		}
		
		function user_check($username, $id)
		{	
			$this->db->where('id !=', $id);
			$this->db->where('username', $username);
			$query = $this->db->get('users');
			if($query->num_rows()>0)
			{	
				return false;
			}
			else
			{	
				return true;
			}
		}
		
		function delete_user($id)
		{			
			$this->db->where('id', $id);
			$query = $this->db->delete('users'); 
			return true;	
		}
	} 