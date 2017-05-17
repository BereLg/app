<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Model extends CI_Model{
	
function valid_user($username, $password)
{
  $this->db->where('username', $username);
  $this->db->where('password', $password);
  
  $query = $this->db->get('users');
   
   if($query->num_rows() >0){

 	return TRUE;
	
    }else{
    	
		return FALSE;
    }
}

function valid_user_ajax($username){ 
			
	$this->db->where('username', $username);
    $query = $this->db->get('users');
		  
		 if($query->num_rows() >0){
                
			 echo $query->num_rows();
			 
		     }
  }

} 
