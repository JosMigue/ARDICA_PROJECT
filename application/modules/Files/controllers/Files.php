<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends MY_Controller {
	public function index()
	{	
		$this->load->model("m_Files");
		$data['data'] = $this->m_Files->BringFiles();
		$this->loadView("Files/v_Files",$data);
		$this->load->view("Files/modalUploadFiles");
	}

}
