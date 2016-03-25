<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_controller extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('LC_Model');
	}
    
    public function forming()           //the controller looks here
    {
        $this->load->view('form_view');
    }
    
    public function display_added_info()
    {
        $this->LC_Model->add_info();
    }
    
    //adding board form
    
    public function board_forming()         //the controller looks here
    {
        $this->load->view('form_view_board');
    
    }
    
    public function  display_added_board_info()
    {
         $this->LC_Model->add_board_info();
    }
}
?>

