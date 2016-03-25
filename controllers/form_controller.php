<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_controller extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('LC_Model');
	}
    
    public function forming()
    {
        $this->load->view('form_view');
    }
    
    public function display_added_info()
    {
        $this->LC_Model->add_info();
    }
}

?>