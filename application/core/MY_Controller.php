<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller
{	

	function __construct() 
	{
		parent::__construct();
		$this->_hmvc_fixes();
	}
	
	function _hmvc_fixes()
	{		
		//fix callback form_validation		
		//https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

	function loadView($view, $data, $header){
		$this->load->view("templates/Header",$header);
		$this->load->view($view, $data);
		$this->load->view("templates/Footer");

	}

	function loadLogin($view,$data){
		$this->load->view($view,$data);
	}

	function loadHome($view,$data){
		$this->load->view($view,$data);
	}


}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
