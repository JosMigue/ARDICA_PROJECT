<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
class blockerSessio extends CI_Controller {
    private $ci;
public function __construct(){
    $CI =& get_instance();
    !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
    !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
}

public function checkLogIn()  
    {  
        if($this->ci->uri->segment(1) != "Login"){
            if($this->ci->session->userdata('logueado') == FALSE){
                redirect(base_url('Login'));
            }
        }
}

}

?>