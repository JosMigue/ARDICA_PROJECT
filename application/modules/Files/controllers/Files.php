<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends MY_Controller {
	public function index()
	{	
		$this->loadView("Files/v_Files",false);
	}

}
