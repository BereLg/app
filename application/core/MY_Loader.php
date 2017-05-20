<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class MY_Loader extends CI_Loader {
		
		public function multiple_views($views, $data)
		{
			foreach ($views as $v)
			{
				$this->view($v,$data);
			}
		}
		
	}		