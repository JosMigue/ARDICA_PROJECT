<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once("dompdf/dompdf_config.inc.php");

class Mydompdf extends DOMPDF
{
    
    protected function ci()
    {
        return get_instance();
    }
    
    public function load_view($view, $data = array()) 
    {
        $html = $this->ci()->load->view($view, $data, TRUE);
        $this->load_html($html);
    }
}