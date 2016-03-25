<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hackathers extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LC_Model');
	}

	public function index()
	{
		$data["LC"] = $this->LC_Model->get_lcs()->result();



		for($i = 0; $i < count($data["LC"]); $i++)
		{
			$data["LC"][$i]["current_board"] = $this->LC_Model->get_board_at_date($data["LC"]->lc_id, date("Y-M-D"));
		}

		$this->load->view('LC_list', $data);
        //lets see what happens
	}
}